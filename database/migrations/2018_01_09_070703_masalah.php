<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Masalah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masalah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idMitra',50);
            $table->string('masalahPemasaran');
            $table->string('masalahSDM');
            $table->string('masalahProduksi');
            $table->string('masalahKeuangan');
            $table->timestamps();

            $table->foreign('idMitra')->references('id')->on('mitra')->onDelete('cascade');         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masalah');
    }
}
