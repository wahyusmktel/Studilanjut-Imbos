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
            $table->uuid('jenis_perguruan_tinggi_id')->nullable()->after('nama_alumni');

            // Jika ingin menghapus kolom lama, hapus baris di bawah ini
            $table->dropColumn('jenis_perguruan_tinggi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn('jenis_perguruan_tinggi_id');

            // Jika ingin mengembalikan kolom lama, tambahkan baris di bawah ini
            $table->string('jenis_perguruan_tinggi')->nullable();
        });
    }
};
