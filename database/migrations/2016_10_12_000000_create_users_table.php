<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('level');
            $table->string('fotoprofil', 255);
            $table->string('email')->unique();
            $table->string('phone', 13);
            $table->text('alamat');
            $table->unsignedInteger('provinsi');
            $table->unsignedInteger('kota');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // $table->foreign('provinsi')->references('province_id')->on('provinces')->onUpdate('cascade')->onDelete('restrict');
            // $table->foreign('kota')->references('city_id')->on('cities')->onUpdate('cascade')->onDelete('restrict');
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
