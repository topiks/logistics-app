<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_material');
            $table->string('spesifikasi');
            $table->string('kode_material');
            $table->string('satuan');
            $table->string('jumlah_yang_dipinjam');
            $table->string('no_bpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
