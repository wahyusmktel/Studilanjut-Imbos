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
            $table->boolean('status_bimbel_kedinasan')->default(false)->after('icon_program');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('program_bimbels', function (Blueprint $table) {
            $table->dropColumn('status_bimbel_kedinasan');
        });
    }
};
