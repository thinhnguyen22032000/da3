<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d');
        $data = [
           [
           'id_course' => 1,
           'title' => 'syntax javascript base',
           'video' => 'syntaxjsbase.mp4',
           'date_open' => $date,
           'date_end' => $date,
           'desc' => 'this is javascript course!!'
           ],
         ];

         foreach($data as $item){
            DB::table('lesson')->insert($item);
         }
    }
}
