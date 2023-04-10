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
        Schema::create('export_bpg', function (Blueprint $table) {
            $table->id();
            $table->string('material');
            $table->string('spesifikasi');
            $table->string('jumlah');
            $table->string('kode_barang');
            $table->string('nomor_bpm');
            $table->string('qty_penyerahan');
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
        Schema::dropIfExists('bpg');
    }
};
