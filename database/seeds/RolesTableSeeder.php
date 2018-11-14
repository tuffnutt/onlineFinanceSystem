<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(DB::table('users')->get()->count() == 0){

      DB::table('roles')->insert([
          ['role_name' => 'super admin',],
          ['role_name' => 'admin',],
          ['role_name' => 'branch admin',],
          ['role_name' => 'user',],
          ['role_name' => 'guest',]
      ]);

     } else { echo "\e[Table is not empty, therefore NOT "; }
   }
}
