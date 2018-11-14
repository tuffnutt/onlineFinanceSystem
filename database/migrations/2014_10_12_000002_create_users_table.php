<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('user_first_name')->nullable();
            $table->string('user_address')->nullable();
            $table->string('user_nic')->nullable();
            $table->string('user_mobile')->nullable();
            $table->string('user_landline')->nullable();
            $table->date('user_birthday')->nullable();
            $table->boolean('user_marital_status')->nullable();
            $table->integer('user_role_id')->unsigned()->default(5);
            $table->integer('user_branch_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_role_id')->references('role_id')->on('roles');
              $table->foreign('user_branch_id')->references('branch_id')->on('branches');
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
