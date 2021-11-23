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
            $table->unsignedBigInteger('provinsi');
            $table->unsignedBigInteger('kota_kabupaten');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('provinsi')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix').'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kota_kabupaten')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix').'cities')
                ->onUpdate('cascade')->onDelete('restrict');
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
