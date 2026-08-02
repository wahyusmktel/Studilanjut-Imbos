<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Tambahkan kolom UUID dan izinkan NULL untuk data lama
            // Kita letakkan setelah 'status_kedinasan' agar rapi
            $table->uuid('tahun_pelajaran_id')->nullable()->after('status_kedinasan');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('tahun_pelajaran_id');
        });
    }
};
