<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminFilesController extends Controller
{
    private const ALLOWED_EXTENSIONS = 'jpg,jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z';

    private const EXTRACT_BATCH_SIZE = 15;

    private const MAX_ARCHIVE_ENTRIES = 10000;

    private const MAX_ARCHIVE_SIZE = 5368709120;

    private const MAX_UPLOAD_SIZE = 5368709120;

    public function index(Request $request)
    {
        $path = $this->normalizePath($request->query('path', ''));

        abort_if($path === null, 404);

        $disk = Storage::disk('public');
        $directories = collect($disk->directories($path))
            ->sortBy(fn (string $directory) => strtolower(basename($directory)))
            ->values();
        $files = collect($disk->files($path))
            ->sortBy(fn (string $file) => strtolower(basename($file)))
            ->map(function (string $file) use ($disk) {
                return [
                    'path' => $file,
                    'name' => basename($file),
                    'size' => $this->formatBytes($disk->size($file)),
                    'modified' => date('d M Y H:i', $disk->lastModified($file)),
                    'url' => asset('storage/'.$file),
                    'is_image' => Str::contains($disk->mimeType($file) ?: '', 'image/'),
                    'is_zip' => strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'zip',
                ];
            })
            ->values();

        $breadcrumbs = $this->breadcrumbs($path);

        return view('admin.files.index', compact('path', 'directories', 'files', 'breadcrumbs'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'path' => ['nullable', 'string', 'max:1000'],
            'files' => ['required', 'array', 'min:1'],
            'files.*' => ['required', 'file', 'max:51200', 'extensions:'.self::ALLOWED_EXTENSIONS],
        ]);

        $path = $this->normalizePath($request->input('path', ''));
        abort_if($path === null, 404);

        $disk = Storage::disk('public');
        abort_unless($path === '' || $disk->directoryExists($path), 404);

        foreach ($request->file('files', []) as $file) {
            $filename = $this->safeFilename($file->getClientOriginalName());
            $target = trim($path.'/'.$filename, '/');

            if ($disk->exists($target)) {
                $filename = pathinfo($filename, PATHINFO_FILENAME)
                    .'-'.now()->format('YmdHis')
                    .'.'.strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            }

            $disk->putFileAs($path, $file, $filename);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'File berhasil diupload.',
                'redirect' => route('admin.files.index', ['path' => $path]),
            ]);
        }

        return redirect()->route('admin.files.index', ['path' => $path])
            ->with('success', 'File berhasil diupload.');
    }

    public function uploadChunk(Request $request)
    {
        $validated = $request->validate([
            'path' => ['nullable', 'string', 'max:1000'],
            'chunk' => ['required', 'file', 'max:16384'],
            'upload_id' => ['required', 'string', 'alpha_dash', 'max:80'],
            'chunk_index' => ['required', 'integer', 'min:0', 'max:999'],
            'total_chunks' => ['required', 'integer', 'min:1', 'max:1000'],
            'total_size' => ['required', 'integer', 'min:1', 'max:'.self::MAX_UPLOAD_SIZE],
            'filename' => ['required', 'string', 'max:255'],
            'stored_name' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['chunk_index'] >= $validated['total_chunks']) {
            return response()->json(['message' => 'Nomor chunk tidak valid.'], 422);
        }

        $path = $this->normalizePath($validated['path'] ?? '');
        abort_if($path === null, 404);

        $disk = Storage::disk('public');
        abort_unless($path === '' || $disk->directoryExists($path), 404);

        $storedName = $this->safeFilename($validated['stored_name'] ?? $validated['filename']);
        if ($validated['chunk_index'] === 0 && $disk->exists(trim($path.'/'.$storedName, '/'))) {
            $storedName = pathinfo($storedName, PATHINFO_FILENAME)
                .'-'.now()->format('YmdHis')
                .'.'.strtolower(pathinfo($storedName, PATHINFO_EXTENSION));
        }

        $local = Storage::disk('local');
        $local->makeDirectory('file-uploads');
        $temporaryPath = 'file-uploads/'.$validated['upload_id'].'.part';

        if ($validated['chunk_index'] === 0) {
            $local->delete($temporaryPath);
        } elseif (! $local->exists($temporaryPath)) {
            return response()->json(['message' => 'Chunk pertama belum diterima. Silakan ulangi upload.'], 422);
        }

        $source = fopen($request->file('chunk')->getRealPath(), 'rb');
        $destination = fopen($local->path($temporaryPath), $validated['chunk_index'] === 0 ? 'wb' : 'ab');
        stream_copy_to_stream($source, $destination);
        fclose($source);
        fclose($destination);

        $isLastChunk = $validated['total_chunks'] === $validated['chunk_index'] + 1;
        if (! $isLastChunk) {
            return response()->json(['complete' => false, 'stored_name' => $storedName]);
        }

        if ($local->size($temporaryPath) !== (int) $validated['total_size']) {
            $local->delete($temporaryPath);

            return response()->json(['message' => 'Ukuran upload tidak sesuai. Silakan ulangi upload.'], 422);
        }

        $target = trim($path.'/'.$storedName, '/');
        $stream = fopen($local->path($temporaryPath), 'rb');
        $disk->put($target, $stream);
        fclose($stream);
        $local->delete($temporaryPath);

        return response()->json(['complete' => true, 'stored_name' => $storedName, 'path' => $target]);
    }

    public function extractZip(Request $request)
    {
        $validated = $request->validate([
            'path' => ['required', 'string', 'max:1000'],
            'index' => ['nullable', 'integer', 'min:0'],
        ]);

        $zipPath = $this->normalizePath($validated['path']);
        abort_if($zipPath === null || ! Str::endsWith(strtolower($zipPath), '.zip'), 404);

        $disk = Storage::disk('public');
        abort_unless($disk->exists($zipPath), 404);

        if (! class_exists(\ZipArchive::class)) {
            return response()->json(['message' => 'PHP ZipArchive belum terpasang di server.'], 422);
        }

        $archive = new \ZipArchive;
        if ($archive->open($disk->path($zipPath)) !== true) {
            return response()->json(['message' => 'File ZIP tidak valid atau rusak.'], 422);
        }

        if ($archive->numFiles > self::MAX_ARCHIVE_ENTRIES || $this->archiveSize($archive) > self::MAX_ARCHIVE_SIZE) {
            $archive->close();

            return response()->json(['message' => 'ZIP terlalu besar atau berisi terlalu banyak file.'], 422);
        }

        $total = $archive->numFiles;
        $index = (int) ($validated['index'] ?? 0);
        $zipFilename = pathinfo(basename($zipPath), PATHINFO_FILENAME);
        $extractFolder = trim(dirname($zipPath).'/'.$this->safeFilename($zipFilename), '/');
        $processed = $index;
        $skipped = 0;

        try {
            for ($current = $index; $current < min($index + self::EXTRACT_BATCH_SIZE, $total); $current++) {
                $entry = $archive->statIndex($current);
                $entryName = (string) ($entry['name'] ?? '');
                $relativePath = $this->safeArchivePath($entryName);
                $externalMode = ((int) ($entry['external_attributes'] ?? 0) >> 16) & 0xF000;

                if ($relativePath === null || $this->isUnsafePublicFile($relativePath) || $externalMode === 0xA000) {
                    throw new \RuntimeException('ZIP berisi nama file yang tidak diizinkan: '.$entryName);
                }

                $target = trim($extractFolder.'/'.$relativePath, '/');
                if (Str::endsWith(str_replace('\\', '/', $entryName), '/')) {
                    $disk->makeDirectory($target);
                    $processed = $current + 1;

                    continue;
                }

                $disk->makeDirectory(dirname($target) === '.' ? $extractFolder : dirname($target));
                $stream = $archive->getStream($current);
                if ($stream === false) {
                    throw new \RuntimeException('Tidak dapat membaca file ZIP: '.$entryName);
                }

                $disk->writeStream($target, $stream);
                fclose($stream);
                $processed = $current + 1;
            }
        } catch (\Throwable $exception) {
            $archive->close();

            return response()->json(['message' => $exception->getMessage()], 422);
        }

        $archive->close();
        $complete = $processed >= $total;

        return response()->json([
            'complete' => $complete,
            'index' => $processed,
            'total' => $total,
            'percent' => $total === 0 ? 100 : (int) floor(($processed / $total) * 100),
            'folder' => $extractFolder,
            'skipped' => $skipped,
            'message' => $complete ? 'Ekstraksi ZIP selesai.' : 'Ekstraksi sedang berjalan.',
        ]);
    }

    public function createFolder(Request $request)
    {
        $validated = $request->validate([
            'path' => ['nullable', 'string', 'max:1000'],
            'name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9][A-Za-z0-9 _.-]*$/'],
        ]);

        $path = $this->normalizePath($validated['path'] ?? '');
        abort_if($path === null, 404);

        $disk = Storage::disk('public');
        abort_unless($path === '' || $disk->directoryExists($path), 404);

        $folder = trim($path.'/'.trim($validated['name']), '/');
        if ($disk->exists($folder) || $disk->directoryExists($folder)) {
            return back()->withInput()->with('error', 'Folder tersebut sudah ada.');
        }

        $disk->makeDirectory($folder);

        return redirect()->route('admin.files.index', ['path' => $path])
            ->with('success', 'Folder berhasil dibuat.');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'path' => ['required', 'string', 'max:1000'],
            'type' => ['required', 'in:file,folder'],
        ]);

        $target = $this->normalizePath($validated['path']);
        abort_if($target === null || $target === '', 404);

        $disk = Storage::disk('public');

        if ($validated['type'] === 'file' && $disk->exists($target)) {
            $disk->delete($target);
        } elseif ($validated['type'] === 'folder' && $disk->directoryExists($target)) {
            if ($disk->files($target) !== [] || $disk->directories($target) !== []) {
                return back()->with('error', 'Folder tidak kosong. Hapus isinya terlebih dahulu.');
            }

            $disk->deleteDirectory($target);
        } else {
            return back()->with('error', 'File atau folder tidak ditemukan.');
        }

        return back()->with('success', 'Item berhasil dihapus.');
    }

    private function normalizePath(?string $path): ?string
    {
        $path = trim(str_replace('\\', '/', (string) $path), '/');

        if ($path === '') {
            return '';
        }

        foreach (explode('/', $path) as $part) {
            if ($part === '' || $part === '.' || $part === '..' || preg_match('/[\x00-\x1F]/', $part)) {
                return null;
            }
        }

        return $path;
    }

    private function safeFilename(string $filename): string
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $basename = pathinfo($filename, PATHINFO_FILENAME);
        $basename = Str::of($basename)->ascii()->replaceMatches('/[^A-Za-z0-9_-]+/', '-')->trim('-')->value();

        return ($basename !== '' ? $basename : 'file').($extension !== '' ? '.'.$extension : '');
    }

    private function safeArchivePath(string $path): ?string
    {
        $path = str_replace('\\', '/', $path);
        if ($path === '' || Str::startsWith($path, '/') || preg_match('/^[A-Za-z]:[\\\/]/', $path)) {
            return null;
        }

        return $this->normalizePath(trim($path, '/'));
    }

    private function isUnsafePublicFile(string $path): bool
    {
        return in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), [
            'php', 'php3', 'php4', 'php5', 'phtml', 'phar', 'cgi', 'pl', 'py', 'sh', 'bash', 'exe', 'dll', 'so', 'env',
        ], true);
    }

    private function archiveSize(\ZipArchive $archive): int
    {
        $size = 0;
        for ($index = 0; $index < $archive->numFiles; $index++) {
            $stat = $archive->statIndex($index);
            $size += (int) ($stat['size'] ?? 0);
            if ($size > self::MAX_ARCHIVE_SIZE) {
                return $size;
            }
        }

        return $size;
    }

    private function breadcrumbs(string $path): array
    {
        $breadcrumbs = [['name' => 'Root', 'path' => '']];
        $current = '';

        foreach ($path === '' ? [] : explode('/', $path) as $part) {
            $current = trim($current.'/'.$part, '/');
            $breadcrumbs[] = ['name' => $part, 'path' => $current];
        }

        return $breadcrumbs;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return $bytes.' B';
        }

        $units = ['KB', 'MB', 'GB'];
        $size = $bytes / 1024;

        foreach ($units as $unit) {
            if ($size < 1024 || $unit === 'GB') {
                return number_format($size, 1).' '.$unit;
            }

            $size /= 1024;
        }

        return $bytes.' B';
    }
}
