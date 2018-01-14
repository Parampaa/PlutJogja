<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsultasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idUser');
            $table->unsignedInteger('idMasalah');
            $table->text('diagnosa');
            $table->text('solusi');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idMasalah')->references('id')->on('masalah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultasis');
    }
}
