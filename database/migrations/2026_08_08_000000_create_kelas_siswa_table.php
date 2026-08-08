<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_siswa', function (Blueprint $table) {
            $table->uuid('kelas_id');
            $table->uuid('siswa_id');
            $table->uuid('program_bimbel_id')->nullable();
            $table->timestamps();

            $table->unique(['kelas_id', 'siswa_id']);
            $table->unique(['siswa_id', 'program_bimbel_id']);
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('program_bimbel_id')->references('id')->on('program_bimbels')->nullOnDelete();
        });

        DB::table('siswas')
            ->whereNotNull('kelas_id')
            ->select(['kelas_id', 'id as siswa_id', 'program_bimbel_id'])
            ->orderBy('id')
            ->each(function (object $siswa): void {
                DB::table('kelas_siswa')->insertOrIgnore([
                    'kelas_id' => $siswa->kelas_id,
                    'siswa_id' => $siswa->siswa_id,
                    'program_bimbel_id' => $siswa->program_bimbel_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_siswa');
    }
};
