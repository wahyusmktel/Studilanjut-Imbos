<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul_berita');
            $table->text('isi_berita');
            $table->string('foto');
            $table->uuid('kategori_id');
            $table->uuid('author_id');
            $table->boolean('status')->default(true);
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategori_beritas')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beritas');
    }
};
