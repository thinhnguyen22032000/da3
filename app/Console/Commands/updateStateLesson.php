<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lesson;
use DB;

class updateStateLesson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update state of lesson affter every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         $get_courses = DB::table('lesson')->distinct()->get('id_course');
         $current_date = date('Y-m-d');
         $lesson = new \stdClass();
         if($get_courses){
            foreach($get_courses as $item){
                
              $lesson = Lesson::where('status', 0)->where('id_course', $item->id_course)
                                           ->where('date_open', $current_date)
                                           ->first(); 
              if($lesson) {
                 $lesson->status = 1;
                 $lesson->save(); 
              }        
            }
            
         }else{
            echo "course not found";
         }
        return Command::SUCCESS;
    }
}
