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
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kelas_id');
            $table->uuid('program_bimbel_id');
            $table->string('nama_siswa');
            $table->date('tgl_lahir')->nullable();
            $table->string('tmpt_lahir')->nullable();
            $table->string('no_hp')->nullable();
            $table->integer('nis');
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('program_bimbel_id')->references('id')->on('program_bimbels')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
