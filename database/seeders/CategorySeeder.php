<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
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
           'id' => 2,
           'id_cat' => 1,
           'name' => 'system information',
           'desc' => 'this is system information category!!'
           ],
           [
           'id' => 2,
           'id_cat' => 2,
           'name' => 'machine learn',
           'desc' => 'this is machine learn category!!'
           ]
         ];

         foreach($data as $item){
            DB::table('category')->insert($item);
         }
    }
}
