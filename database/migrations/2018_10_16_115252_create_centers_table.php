<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('centers', function (Blueprint $table) {
             $table->increments('center_id');
             $table->string('center_name');
             $table->string('center_address')->nullable();
             $table->string('center_collect_day');
             $table->integer('center_user_id')->unsigned();
             $table->integer('center_branch_id')->unsigned();

             $table->foreign('center_user_id')->references('id')->on('users');
             $table->foreign('center_branch_id')->references('branch_id')->on('branches');
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
        Schema::dropIfExists('centers');
    }
}
