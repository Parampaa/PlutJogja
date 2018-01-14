<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->string('id',50);
            $table->string('namaPemilik',200)->nullable();
            $table->string('namaBadan',200)->nullable();
            $table->unsignedInteger('jenis')->nullable();
            $table->string('tahun',4)->nullable();
            $table->string('alamat',200)->nullable();
            $table->string('kecamatan',200)->nullable();
            $table->string('kabupaten',200)->nullable();
            $table->string('kontak',200)->nullable();
            $table->string('status',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('npwp',200)->nullable();
            $table->string('legalitas',200)->nullable();
            $table->string('sentra',200)->nullable();
            $table->string('modal',200)->nullable();
            $table->string('omset',200)->nullable();
            $table->string('asset',200)->nullable();
            $table->string('volume',200)->nullable();
            $table->string('karyawan_l',200)->nullable();
            $table->string('karyawan_p',200)->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('jenis')->references('id')->on('jenis_usaha')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mitras');
    }
}
