<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('berita_id');
            $table->string('nama_komentator');
            $table->text('isi_komentar');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('berita_id')->references('id')->on('beritas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentars');
    }
};
