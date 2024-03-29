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
        Schema::create('penggunaan_gudang_kecil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_material');
            $table->integer('status');
            $table->string('spesifikasi');
            $table->string('kode_material');
            $table->string('satuan');
            $table->string('jumlah_yang_dipinjam');
            $table->string('project');
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
        Schema::dropIfExists('penggunaan_gudang_kecil');
    }
};
