<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->increments('id_perangkat');
            $table->string('nama_perangakat')->nullable();
            $table->string('kategori')->nullable();
            $table->string('tipe')->nullable();
            $table->string('merek')->nullable();
            $table->string('model')->nullable();
            $table->enum('kondisi', ['baik', 'buruk'])->nullable();
            $table->integer('harga')->nullable();
            $table->date('tgl_pembelian')->nullable();
            $table->integer('jumlah')->nullable();
            $table->text('kelengkapan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('photo')->nullable();
            $table->string('qr_code')->nullable();
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
        Schema::dropIfExists('asets');
    }
}
