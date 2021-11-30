<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi', 7);
            $table->unsignedBigInteger('id_product');
            $table->integer('jumlah');
            $table->text('catatan')->nullable();
            $table->integer('total_berat');
            $table->integer('total');
            // $table->foreign('id_transaksi')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('product_transactions');
    }
}
