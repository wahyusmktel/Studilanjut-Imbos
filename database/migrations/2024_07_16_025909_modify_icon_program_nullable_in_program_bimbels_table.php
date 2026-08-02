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
        Schema::table('program_bimbels', function (Blueprint $table) {
            $table->string('icon_program')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('program_bimbels', function (Blueprint $table) {
            $table->string('icon_program')->nullable(false)->change();
        });
    }
};
