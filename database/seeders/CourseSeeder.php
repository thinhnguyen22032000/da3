<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
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
           'name' => 'JavaScript',
           'price' => '100',
           'code' => 'DJSHSUIEO',
           'img' => 'avatar.png',
           'date_start' => '2021-01-01',
           'date_end' => '2021-01-01',
           'step' => 2,
           'desc' => 'this is javascript course!!'
           ],
         ];

         foreach($data as $item){
            DB::table('course')->insert($item);
         }
    }
}
