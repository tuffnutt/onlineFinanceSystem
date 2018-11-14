<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('loans', function (Blueprint $table) {
             $table->increments('loan_id');
             $table->float('loan_amount',8,2);
             $table->date('loan_start_date');
             $table->string('loan_type')->default('Normal');
             $table->longtext('loan_description')->nullable();
             $table->boolean('loan_finished')->default(false);
             $table->boolean('loan_deactivated')->default(false);
             $table->date('loan_end_date')->nullable();
             $table->float('loan_documentcharges',8,2);


             $table->integer('loan_customer_id')->unsigned();
             $table->integer('loan_center_id')->unsigned();
              $table->integer('loan_branch_id')->unsigned();

             $table->foreign('loan_customer_id')->references('customer_id')->on('customers');
             $table->foreign('loan_center_id')->references('center_id')->on('centers');
             $table->foreign('loan_branch_id')->references('branch_id')->on('branches');
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
          Schema::dropIfExists('loans');
    }
}
