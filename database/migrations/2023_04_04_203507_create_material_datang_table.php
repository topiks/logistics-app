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
        Schema::create('material_datang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_material');
            $table->string('nomor_po');
            $table->string('nomor_order');
            $table->string('nomor_pr');
            $table->string('jumlah');
            $table->string('satuan');
            $table->string('kode_material');
            $table->string('nomor_spbb_nota');
            $table->string('pemasok');
            $table->string('eda');
            $table->string('dokumen_material');
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
        Schema::dropIfExists('material_datang');
    }
};
