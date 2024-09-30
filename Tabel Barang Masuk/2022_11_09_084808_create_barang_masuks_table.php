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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_admin');
            $table->date('tgl_masuk');
            $table->integer('jml_brg_masuk');
            $table->timestamps();
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->foreign('id_admin')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
};
