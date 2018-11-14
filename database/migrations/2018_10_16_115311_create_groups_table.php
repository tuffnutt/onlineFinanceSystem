<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('groups', function (Blueprint $table) {
             $table->increments('group_id');


             $table->integer('group_center_id')->unsigned();

             
             $table->foreign('group_center_id')->references('center_id')->on('centers');



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
          Schema::dropIfExists('groups');
    }
}
