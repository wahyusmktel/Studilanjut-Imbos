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
        Schema::create('nilais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tryout_id');
            $table->uuid('mata_pelajaran_id');
            $table->uuid('siswa_id');
            $table->integer('nilai')->unsigned()->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('tryout_id')->references('id')->on('tryouts')->onDelete('cascade');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }

};
