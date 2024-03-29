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
        Schema::create('penggunaan_material_buffer', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('nama_material');
            $table->string('spesifikasi');
            $table->string('kode_material');
            $table->string('satuan');
            $table->string('jumlah_akan_digunakan');
            $table->string('nomor_bpm')->nullable();
            $table->string('project')->nullable();
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
        Schema::dropIfExists('penggunaan_material_buffer');
    }
};
