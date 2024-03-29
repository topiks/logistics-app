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
        Schema::create('export_lpb', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('qty');
            $table->string('sat');
            $table->string('no_spbb_nota');
            $table->string('pemasok');
            $table->string('no_order');
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
        Schema::dropIfExists('_l_p_b');
    }
};
