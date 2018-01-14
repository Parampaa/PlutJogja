<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('email',100)->unique();
            $table->string('image',100)->nullable();
            $table->unsignedInteger('privilege')->nullable();
            $table->string('password',200);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('privilege')->references('id')->on('privileges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
