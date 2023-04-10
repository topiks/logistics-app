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
        Schema::create('export_bpm', function (Blueprint $table) {
            $table->id();
            $table->string('order_masuk_no');
            $table->string('acc_notice_pqc');
            $table->string('op_no');
            $table->string('bpm_no');
            $table->string('uraian_material');
            $table->string('no_kode');
            $table->string('satuan');
            $table->string('qty');
            $table->string('nama_supplier');
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
        Schema::dropIfExists('bpm');
    }
};
