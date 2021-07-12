<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('merk_barang');
            $table->string('model_barang');
            $table->integer('harga_barang');
            $table->date('tanggal_pengadaan');
            // $table->integer('jumlah_sekarang')->default(0);
            $table->integer('jumlah_pengadaan');
            $table->text('keterangan');
            $table->boolean('confirmed')->default(false);
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
        Schema::dropIfExists('pengadaans');
    }
}
