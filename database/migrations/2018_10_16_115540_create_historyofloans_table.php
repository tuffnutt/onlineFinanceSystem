<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryofloansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('historyofloans', function (Blueprint $table) {
             $table->increments('historyofloan_id');
             $table->float('historyofloan_amount',5,2);
             $table->integer('historyofloan_payment_id')->unsigned();
             $table->integer('historyofloan_loan_id')->unsigned();

             $table->foreign('historyofloan_payment_id')->references('payment_id')->on('payments');
             $table->foreign('historyofloan_loan_id')->references('loan_id')->on('loans');


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
          Schema::dropIfExists('historyofloans');
    }
}
