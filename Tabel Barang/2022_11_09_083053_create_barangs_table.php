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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_barang');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->string('gambar');
            $table->integer('lebar_kain');
            $table->integer('stok');
            $table->timestamps();
            $table->foreign('id_jenis_barang')->references('id')->on('jenis_barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
