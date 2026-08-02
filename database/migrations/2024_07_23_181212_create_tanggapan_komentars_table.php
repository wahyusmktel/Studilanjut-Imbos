<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapan_komentars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('komentar_id');
            $table->uuid('author_id');
            $table->text('isi_tanggapan');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('komentar_id')->references('id')->on('komentars')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapan_komentars');
    }
};
