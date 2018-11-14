<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('installments', function (Blueprint $table) {
             $table->increments('installment_id');
             $table->float('installment_total',8,2)->default(0);
             $table->float('installment_per_week',8,2);
             $table->float('installment_balance',8,2)->default(0);
             $table->float('installment_last_payment',8,2)->default(0);
             $table->float('installment_add',8,2)->default(0);
             $table->float('installment_areas',8,2)->default(0);
             $table->integer('installment_count')->default(0);
             $table->date('installment_last_payment_date')->nullable();
             $table->date('d1')->nullable();
             $table->date('d2')->nullable();
             $table->date('d3')->nullable();
             $table->date('d4')->nullable();
             $table->date('d5')->nullable();
             $table->date('d6')->nullable();
             $table->date('d7')->nullable();
             $table->date('d8')->nullable();
             $table->date('d9')->nullable();
             $table->date('d10')->nullable();
             $table->date('d11')->nullable();
             $table->date('d12')->nullable();
             $table->date('d13')->nullable();
             $table->date('d14')->nullable();
             $table->date('d15')->nullable();
             $table->float('a1',8,2)->nullable();
             $table->float('a2',8,2)->nullable();
             $table->float('a3',8,2)->nullable();
             $table->float('a4',8,2)->nullable();
             $table->float('a5',8,2)->nullable();
             $table->float('a6',8,2)->nullable();
             $table->float('a7',8,2)->nullable();
             $table->float('a8',8,2)->nullable();
             $table->float('a9',8,2)->nullable();
             $table->float('a10',8,2)->nullable();
             $table->float('a11',8,2)->nullable();
             $table->float('a12',8,2)->nullable();
             $table->float('a13',8,2)->nullable();




             $table->integer('installment_loan_id')->unsigned();




             $table->foreign('installment_loan_id')->references('loan_id')->on('loans');


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
        Schema::dropIfExists('installments');
    }
}
