<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
             $table->increments('transaction_id');
             $table->float('transaction_amount',8,2);
             $table->date('transaction_date');
             $table->boolean('transaction_lend');

             $table->integer('transaction_user_id')->unsigned();
              $table->integer('transaction_center_id')->unsigned()->nullable();;

             $table->foreign('transaction_user_id')->references('id')->on('users');
              $table->foreign('transaction_center_id')->references('center_id')->on('centers');

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
        Schema::dropIfExists('transactions');
    }
}
