<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customers', function (Blueprint $table) {
             $table->increments('customer_id');
             $table->string('customer_name');
             $table->string('customer_name_with_initials');
             $table->string('customer_address');
             $table->string('customer_nic');
             $table->string('customer_occupancy')->nullable();
             $table->string('customer_mobile')->nullable();
             $table->string('customer_landline')->nullable();
             $table->string('customer_business_phone')->nullable();
             $table->float('customer_savings',7,2)->default(0.00);
             $table->float('customer_insuarance',8,2)->default(0.00);
             $table->date('customer_birthday')->nullable();
             $table->boolean('customer_grouped')->default(false);
             $table->string('customer_marital_status')->nullable();
             $table->boolean('customer_status')->default(false);
             $table->float('customer_income',9,2)->default(0.00);
             $table->longtext('customer_other_bonds')->nullable();


             $table->string('customer_business')->nullable();
             $table->string('customer_employer_name')->nullable();
             $table->string('customer_designation')->nullable();
             $table->string('customer_special_abilities')->nullable();


             $table->string('customer_spouse_name');
             $table->string('customer_spouse_address');
             $table->string('customer_spouse_nic');
             $table->string('customer_spouse_telephone')->nullable();
             $table->string('customer_spouse_relationship')->nullable();
             $table->date('customer_spouse_birthday')->nullable();

             $table->string('customer_spouse_business')->nullable();
             $table->string('customer_spouse_employer_name')->nullable();
             $table->string('customer_spouse_designation')->nullable();
             $table->string('customer_spouse_special_abilities')->nullable();

             $table->integer('customer_center_id')->unsigned();
             $table->integer('customer_branch_id')->unsigned();
             $table->integer('customer_group_id')->unsigned()->nullable();

             $table->foreign('customer_center_id')->references('center_id')->on('centers');
             $table->foreign('customer_branch_id')->references('branch_id')->on('branches');
             $table->foreign('customer_group_id')->references('group_id')->on('groups');





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
          Schema::dropIfExists('customers');
    }
}
