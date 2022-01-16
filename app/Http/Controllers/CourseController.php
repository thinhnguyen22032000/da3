<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Slider;
use App\Models\Lab;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use Auth;
use Toastr;
use Mail;
use DB;

class CourseController extends Controller
{
    
    private $course;

    public function __construct() {

         $this->course = new Course();
         $this->lesson = new Lesson();
         $this->category = new Category();

    }

    public function index()
    {
        $course = new Course();
        $id_teacher = Auth::user()->id;

        if(isset($_GET['q'])){
           $key = $_GET['q'];
           $actor = 'admin';
           $result = $course->searchCoursesByKey($id_teacher, $key, $actor);
           $numRow = count($result);
           return view('admin.course.index', compact(['result', 'numRow'])); 
        }

        $result = $course->showCourse($id_teacher);
        $numRow = count($result);

       return view('admin.course.index', compact(['result', 'numRow'])); 

    }


    public function create()
    {
        $category = new Category();
        $categoryData = $category->showCategoryById();
        return view('admin.course.create', compact('categoryData'));
    }

   
    public function store(Request $request)
    {
         $request->validate([
          'name' => 'required',
          'price' => 'required',
          'desc' => 'required',
          'date_start' => 'required',
          'step' => 'required',
          'img' => 'required',
          'id_cat' => 'required',
        ]);
        //return response()->json($request);
        $id_teacher = Auth::user()->id;
        $course = new Course();
        $course->addCourse($request, $id_teacher);
        Toastr::success('course created successfully!!!','Success');

        return redirect('admin/course');
    }

   
    
    public function edit($id)
    {
        $course = new Course();
        $category = new Category();

        $categoryData = $category->showCategoryById();
         $result = $course->showCourseByIdEdit($id);
        return view('admin.course.edit', compact('result'),compact('categoryData'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
          'name' => 'required',
          'price' => 'required',
          'desc' => 'required',
          'id_cat' => 'required',
        ]);

        $course = new Course();
        $result = $course->updateCourse($request, $id);
        if($result){
            Toastr::success('Course updated successfully!!!','Success'); 
            return redirect('admin/course');
        }else{
             Toastr::error('Course updated false!!!','Error');
             return redirect('admin/course');
        }
    }

    
    public function courseDetail($id_course)
    {
        $result = $this->course->showCourseById($id_course);
        $categoryNames = $this->category->showCategoryById();
        $position = ' '.$result[0]->name. ' detail';
        return view('admin.course.course_detail', compact(['result', 'position', 'categoryNames']));
    }
    

    public function toturialGetCourse($id_course)
    {
        $id = Auth::user()->id;

        $course = DB::table('mycourse')->where('id_course', $id_course)->where('id', $id)->get();

        if(!$course->isEmpty()) {
           Toastr::error('The course already exists');
           return redirect('/my_course');
        }
        $result = $this->course->showCourseById($id_course);
        $course = $this->course->showCourseById($id_course);
        $code = $course[0]->code;
        $courseName = $course[0]->name;
        $email_student = Auth::user()->email;
        $sendFrom = 'ThinhDEV';
        $to_name = "ThinhDEV";
                $to_email = $email_student;//send to this email
        
                $data = array("name" => $sendFrom,
                              "body" => $code,
                              "courseName" => $courseName
                              ); //body of mail.blade.php
            
                Mail::send('email.send_code',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Congratulations on your successful purchase of the course');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
        });

        
        $this->course->addMyCourse($id_course, $id); // add course to table mycourse
        //update member sau khi mua 
        $this->course->updateMember($id_course);
        $position = ' '.$result[0]->name. ' detail';
        return view('notify.buy_success', compact(['result','id_course', 'email_student', 'position']));
    }

    public function getMyCourse() {

        $id = Auth::user()->id;
        $countLabSubmited = $this->course->countLabSubmited($id);

        $result = $this->course->showMyCourse($id);

        $length = count($result);
        $process_line;

        // sliders
        $sliders = Slider::all();
        
        if($countLabSubmited->isEmpty()) {

                $process_line = 0;
                for($i=0; $i < $length; $i++){
                $result[$i]->countLabSubmited = $process_line;
            }
            return view('admin.course.my_course', compact(['result', 'sliders']));
        }

        for($i=0; $i < $length; $i++){

           if(!isset($countLabSubmited[$i]->countLabSubmited)) {
               $process_line = 0;
           }else{
           $process_line = round(($countLabSubmited[$i]->countLabSubmited / $result[$i]->countLesson) * 100); 
           }
           $result[$i]->countLabSubmited = $process_line;
        }

        return view('admin.course.my_course', compact(['result', 'sliders']));
    }

    public function checkCodeMyCourse(Request $request, $id_course) {
          $request->validate([
            'code' => 'required',
          ]);

          $course = $this->course->showCourseById($id_course);
          $code = $course[0]->code;

          if($code === $request->code) {

             $result = $this->course->updateSateCode($request, $id_course);
             if($result) {
                Toastr::success('Confirm successfully!!!','Success'); 
                return redirect()->back();
             }
          }
         Toastr::Error('Invalid code','Error'); 
         return redirect()->back();

    }

    public function handlePublicCourse(Request $request) {
        $this->course->handlePublicCourse($request);
        //return response()->json($request);
        return redirect()->back();

    }


    public function getLessonOfCourse($id_course) {

           $id_user = Auth::user()->id;
           $checkCourse = DB::table('mycourse')->where('id', $id_user)->where('id_course', $id_course)->get();

           if(!$checkCourse->isEmpty()) {

              $lessonPlay = $this->lesson->getLessonByIdCourse($id_course);
              $id_lesson =  $lessonPlay->id_lesson;
              $questions = $this->lesson->getQuestionOfLesson($id_lesson);
              $lessons = $this->lesson->showLesson($id_course); // lesson first
              $courseCurrent = $this->course->showCourseById($id_course);
 
              $id_student = Auth::user()->id;
              $checkLabSubmited = $this->lesson->checkLabSubmited($id_lesson, $id_student);
        
              return view('site.lesson_of_course', compact(['courseCurrent', 'lessonPlay', 'lessons', 'questions','checkLabSubmited']));

           } else {
            
            Toastr::error('Parameter is invalid');
            return redirect()->back(); 

           }

          
    }

    public function getLessonCurrent(Request $request, $id_lesson) { //ajax
           if(isset($id_lesson)) {
              $lesson = $this->lesson->getLessonById($id_lesson);
              $questions = $this->lesson->getQuestionOfLesson($id_lesson);

              $id_student = Auth::user()->id;
              $checkLabSubmited = $this->lesson->checkLabSubmited($id_lesson, $id_student);
               
                $output = '
                        <style>.desc_video{padding:8px}.desc_video__title{font-weight: 700}</style> 
                        <video id="video" class="col-12" height="400px" controls>
                        <source src="'.asset('public/backend/uploads/video/'.$lesson[0]->video).'" type="video/mp4">
                        </video>
                        <div class="desc_video">
                        <h3 class="desc_video__title">'.$lesson[0]->title.'</h3>
                        <p>'.$lesson[0]->desc.'</p>
                        </div>
                        <hr>
                        <div class="wrap-homework">
                            <p class="wrap-homework__desc">HomeWork: Submit assignments as .pdf files</p>
                            <ol>
              ';
               
               foreach($questions as $item) {
                 $output.='
                    <li>'.$item->content.'</li>
                 ';
               }
               $output .= '</ol>';


               if($checkLabSubmited->isEmpty()){
                    $output.= ' 
                        <form  method="post" id="upload_form" enctype="multipart/form-data">
                        '.csrf_field().'
                                <input type="hidden" id="id_lesson" value="'.$lesson[0]->id_lesson.'">
                                <input type="file" id="lab_file" name="lab_file">
                                <button type="submit" class="submit_lab btn btn-primary" >send</button>
                        </form>
                        <p id="txt_submit" ></p>
                  ';
               }
               else {
                   $output.= '
                            
                           <p class="alert alert-notify__success"><i class="far fa-check-circle alert-notify__icon"></i>Submitted the assignment</p>
                            ';
               }
               $output .= '</div><div id="alert__success"></div>';
               $output .='<script src="'.asset('public/backend/dist/js/myjs.js').'"></script>';
               return $output;
           }    
    }


    public function courseToggleData() {
        $id = Auth::user()->id;
        $data = $this->course->getCourseToggle($id);
        $count = count($data);

        for ($i=0; $i < $count ; $i++) { 
            // code...
            $getLesson = Lesson::where('id_course', $data[$i]->id_course)->get();
            $data[$i]->lesson = $getLesson;

        }
        
        return view('admin.lab.index', compact('data'));

    }

    public function showLab($lessonTitle, $id) {

         $data = Lab::where('id_lesson', $id)->get(); 

         $count = count($data);
         for ($i=0; $i < $count ; $i++) { 
             // code...
             $data[$i]->student = User::where('id', $data[$i]->id)->get();
         }
         
         
         return view('admin.lab.listLab',compact(['data', 'lessonTitle'])); 
    }

    public function downloadLab($file) {
        $filePath = public_path('backend/uploads/labs/') . $file;

        $headers = ['Content-Type: application/pdf'];
        $fileName = time().'.pdf';

        return response()->download($filePath, $fileName, $headers);
        
    }





}

