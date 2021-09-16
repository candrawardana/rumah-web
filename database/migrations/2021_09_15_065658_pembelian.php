<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_koperasi', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('user_id',32)->nullable();
            $table->date('tanggal');
            $table->string('faktur',20)->nullable();
            $table->string('kode',20)->nullable();
            $table->string('nama',100)->nullable();
            $table->bigInteger('modal');
            $table->integer('jumlah');
            $table->integer('terjual');
            $table->bigInteger('jual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_koperasi');
    }
}
