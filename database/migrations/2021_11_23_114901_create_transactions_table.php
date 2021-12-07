<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi', 7);
            $table->unsignedBigInteger('id_customer');
            $table->integer('berat');
            $table->integer('ongkir');
            $table->integer('total_bayar');
            $table->string('status', 10);
            $table->string('resi', 100)->nullable();
            $table->timestamps();
            $table->foreign('id_customer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
