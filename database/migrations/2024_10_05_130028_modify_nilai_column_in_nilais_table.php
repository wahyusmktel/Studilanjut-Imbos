<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNilaiColumnInNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilais', function (Blueprint $table) {
            // Mengubah kolom 'nilai' menjadi decimal dengan presisi 10 dan skala 2
            $table->decimal('nilai', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilais', function (Blueprint $table) {
            // Mengembalikan kolom 'nilai' menjadi integer
            $table->unsignedInteger('nilai')->change();
        });
    }
}
