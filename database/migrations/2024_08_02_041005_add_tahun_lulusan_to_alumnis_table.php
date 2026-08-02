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
        Schema::table('alumnis', function (Blueprint $table) {
            $table->year('tahun_lulusan')->nullable()->after('foto'); // Sesuaikan 'some_existing_column' dengan kolom yang sudah ada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn('tahun_lulusan');
        });
    }
};
