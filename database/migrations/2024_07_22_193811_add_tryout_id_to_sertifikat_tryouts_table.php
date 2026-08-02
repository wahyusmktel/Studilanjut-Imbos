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
        Schema::table('sertifikat_tryouts', function (Blueprint $table) {
            $table->uuid('tryout_id')->nullable(); // Menambahkan kolom tryout_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikat_tryouts', function (Blueprint $table) {
            $table->dropColumn('tryout_id'); // Menghapus kolom tryout_id jika rollback
        });
    }
};
