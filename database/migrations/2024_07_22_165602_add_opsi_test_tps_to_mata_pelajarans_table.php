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
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->boolean('opsi_test_tps')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->dropColumn('opsi_test_tps');
        });
    }
};
