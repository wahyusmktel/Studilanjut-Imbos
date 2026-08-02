<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('guru_id');
            $table->uuid('kelas_id');
            $table->date('tanggal');
            $table->string('materi');
            $table->text('catatan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });

        Schema::create('absensi_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('absensi_id');
            $table->uuid('siswa_id');
            $table->integer('kehadiran'); // 1: hadir, 0: tidak hadir, 2: sakit

            $table->foreign('absensi_id')->references('id')->on('absensis')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('absensi_details');
        Schema::dropIfExists('absensis');
    }
};
