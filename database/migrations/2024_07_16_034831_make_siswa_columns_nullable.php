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
        Schema::table('siswas', function (Blueprint $table) {
            $table->date('tgl_lahir')->nullable()->change();
            $table->string('tmpt_lahir')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
            $table->string('foto_siswa')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->date('tgl_lahir')->nullable(false)->change();
            $table->string('tmpt_lahir')->nullable(false)->change();
            $table->string('no_hp')->nullable(false)->change();
            $table->string('foto_siswa')->nullable(false)->change();
        });
    }
};
