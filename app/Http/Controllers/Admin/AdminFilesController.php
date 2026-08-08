<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminFilesController extends Controller
{
    private const ALLOWED_EXTENSIONS = 'jpg,jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z';

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

        return redirect()->route('admin.files.index', ['path' => $path])
            ->with('success', 'File berhasil diupload.');
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
