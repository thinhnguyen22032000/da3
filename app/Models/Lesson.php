<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use DB;
use Carbon\Carbon;
use Validator;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';

    protected $primaryKey = 'id_lesson';

    protected $fillable = ['id_lesson', 'id_course', 'title', 'video', 'desc'];

    public function question() {
        return $this->hasMany(Question::class, 'id_question', 'id_lesson');
    }

    public function course(){

        return $this->hasOne(Course::class, 'id_lesson', 'id_course');
    }

    //update lesson

    public function updateLesson($req, $id) {
        $flag = false;
        if($req->video){

            $data = array();
            $data['title'] = $req->title;
            $data['desc'] = $req->desc;


            $videoCurrent = DB::table('lesson')->where('id_lesson', $id)->get();
            $videoCurrent = $videoCurrent[0]->video;
            $linkVideo = 'public/backend/uploads/video/'.$videoCurrent;
            
            if(file_exists($linkVideo))
                unlink($linkVideo);

            $video = $req->file('video');
            $video_name = time().'.'.$video->getClientOriginalExtension();
            $video->move('public/backend/uploads/video/', $video_name);

            $data['video'] = $video_name;

            DB::table('lesson')->where('id_lesson',$id)
                             ->update($data);

            $flag = true;

        }else{

            $data = array();
            $data['title'] = $req->title;
            $data['desc'] = $req->desc;

            DB::table('lesson')->where('id_lesson',$id)
                             ->update($data);

            $flag = true; 
        }
        return $flag;
    }

    // add lesson
    public function addLesson($req, $id_course) {        
        //insert into table lesson
        $flag = false;
        //get date_start and step of course
        $data = DB::table('course')->select('date_end', 'step')->where('id_course', $id_course)->first();
        $date = $data->date_end;
        $carbon = Carbon::create($date);
        $carbon->addDays($data->step);

        if($req && $id_course) {
 
            $video = $req->file('video');
            $video_name = time().'.'.$video->getClientOriginalExtension();
            $video->move('public/backend/uploads/video', $video_name);
            
            DB::table('lesson')->insert([

              'id_course' => $id_course,
              'title' => $req->title,
              'video' =>  $video_name,
              'date_open' => $carbon,
              'date_end' =>$carbon,
              'desc' =>$req->desc,

            ]);

            // update date_end on course table
            DB::table('course')->where('id_course', $id_course)->update(['date_end'=> $carbon]);

            $flag = true; 
        }
        return $flag;
    }
    
    //show name course of lessons

    public function showNameOfLesson($id_course) {

        $data = DB::table('course')->where('id_course', $id_course)->get();
        return $data;
    } 
    
    public function getLessonById($id) {

           if($id) {

            $data = DB::table('lesson')->where('id_lesson', $id)->get();

               if($data){
                   return $data;
               }else{
                  return false;
               }
        }
    }

    public function getLessonByIdCourse($id) {

           if($id) {
            $data = DB::table('lesson')->where('id_course', $id)->first();
           if($data){
               return $data;
           }else{
              return false;
           }
        }
    }

    public function showLesson($id) {

           if($id) {
            $data = DB::table('lesson')
            ->select('lesson.*', DB::raw('count(question.id_lesson) as question'))
            ->leftjoin('question', 'lesson.id_lesson' ,'=', 'question.id_lesson')
            ->where('lesson.id_course', $id)
            ->groupBy('lesson.id_lesson')
            ->get();
           if($data){
               return $data;
           }else{
              return false;
           }
        }
    }

    /**
      *question
          
    */

    public function addQuestion($id_lesson, $data) {
        
        $flag = false;
        if($id_lesson && $data) {
            foreach($data as $item){
                DB::table('question')->insert([
                     'id_lesson' => $id_lesson,
                     'content' => $item,
                ]);
            }
            $flag = true;
        }
        return $flag;

    }

    //get question of lesson

    public function getQuestionOfLesson($id_lesson) {
        return DB::table('question')->where('id_lesson', $id_lesson)->get();
    }

    public function checkLabSubmited($id_lesson, $id) {
        
        //$flag = true;
        $result = DB::table('lab')->where('id_lesson', $id_lesson)->where('id', $id)->get();
        // if($result === []) {
        //     $flag = false;
        // }
        return $result;
    }

    //upload lab for lesson

    public function uploadLab($req, $id, $id_lesson) {
        $lab_file = $req->file('lab_file');
        $lab_file_name = time().'.'.$lab_file->getClientOriginalExtension();
        $lab_file->move('public/backend/uploads/labs', $lab_file_name);
        
        DB::table('lab')->insert([
          'id' => $id,
          'id_lesson' => $id_lesson,
          'lab_file' => $lab_file_name
        ]);
    }

    public function showMyCalender($id) {
        $data = DB::table('mycourse')->select('lesson.*')
                                     ->join('course', 'mycourse.id_course', '=', 'course.id_course')
                                     ->join('lesson', 'mycourse.id_course', '=', 'lesson.id_course')
                                     ->where('mycourse.id', $id)
                                     ->get();
        if($data) return $data;
        
        return false;
    }

    
   //show question 
   public function showQuestions($id_lesson) {
    return DB::table('question')->where('id_lesson', $id_lesson)->get();
   }

   // update question
   public function questionUpdate($question, $questionId) {
    DB::table('question')->where('id_question', $questionId)->update(['content' => $question]);
   }



}
