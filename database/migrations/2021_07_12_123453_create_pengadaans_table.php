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
            $table->string('kode_perangkat');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('merk_barang');
            $table->string('model_barang');
            $table->string('nomer_seri_produk');
            $table->integer('harga_barang');
            $table->date('tanggal_pengadaan');
            $table->text('keterangan');
            $table->boolean('confirmed')->nullable()->default(false);
            $table->boolean('confirmed_kepala_sumber_daya')->default(false);
            $table->text('keterangan_sumber_daya')->nullable();
            $table->boolean('confirmed_keuangan')->default(false);
            $table->text('keterangan_keuangan')->nullable();
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
