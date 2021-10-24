<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data = [
           [
           'name' => 'thinh nh',
           'email' => 'thinh@email.com',
           'gender' => '0',
           'address' => '999, Dong Hai, Bac Lieu',
           'phone' => '0938667241',
           'img' => 'avatar.png',
           'password' => bcrypt(123456),
           'level' => 0,
           ],
            [
           'name' => 'k thinh',
           'email' => 'kthinh@email.com',
           'gender' => '0',
           'address' => '999, Dong Hai, Bac Lieu',
           'phone' => '0938667241',
           'img' => 'avatar3.png',
           'password' => bcrypt(123456),
           'level' => 1,
           ],

         ];

         foreach($data as $item){
            DB::table('users')->insert($item);
         }
    }
}
