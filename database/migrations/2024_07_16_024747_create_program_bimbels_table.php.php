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
        Schema::create('program_bimbels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_program');
            $table->text('deskripsi_program');
            $table->string('icon_program');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('program_bimbels');
    }
};
