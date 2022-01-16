<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use DB;
use Toastr;
use Carbon\Carbon;
use Auth;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $lesson;
    private $course;

    public function __construct() {
         $this->lesson = new lesson();
         $this->course = new Course();
    }

    public function index($id)
    {


        $result = $this->lesson->showLesson($id);
        $nameCourse = $this->lesson->showNameOfLesson($id);
        //return response()->json($result);
        $position = ' List Lessons: '.$nameCourse[0]->name;
        return view('admin.lesson.index', compact(['result', 'id', 'position']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $nameCourse = $this->lesson->showNameOfLesson($id);
        //return response()->json($result);
        $position = ' List Lessons: '.$nameCourse[0]->name.'';
       return view('admin.lesson.create', compact(['id', 'position']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
           'title' => 'required',
           'desc' => 'required',
           'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        $result = $this->lesson->addLesson($request, $id); 
        if($result) {
            Toastr::success('Add lesson successfully!!!','Success');
            return redirect('admin/course/'.$id.'/lesson');
        } else {
            Toastr::Error('Add lesson failure!!!','Error');
        }   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_lesson)
    {
        
        $result = $this->lesson->getLessonById($id_lesson);
        $nameCourse = $this->lesson->showNameOfLesson($id);
        $position = ' List Lessons: '.$nameCourse[0]->name.'';
        return view('admin.lesson.edit', compact(['result', 'id', 'id_lesson','position']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, $id_lesson)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            
         ]);

       $result = $this->lesson->updateLesson($request, $id_lesson);

        if($result) {
            Toastr::success('Update lesson successfully!!!','Success');

            return redirect('admin/course/'.$id.'/lesson');
        } else {
            Toastr::Error('Update lesson failure!!!','Error');
            return redirect('admin/course/'.$id.'/lesson');
        }   
    }


    // process question
    public function getAddFromQuestion($id, $id_lesson) {
        $listQuestions = $this->lesson->showQuestions($id_lesson);
        $nameLesson = $this->lesson->getLessonById($id_lesson);
        $nameCourse = $this->course->showCourseById($id);
        $position = ' List Lessons: '.$nameCourse[0]->name;
        $path = '> '. $nameLesson[0]->title;
        
        return view('admin.lesson.create_question', compact(['path','id', 'id_lesson','listQuestions','position']));
    }

    public function questionCreate(Request $request, $id, $id_lesson) {

        $question = $request->question[0];
        if(!isset($question)) {
            Toastr::Warning('Please enter at least one data field!!!','Warning');
            return redirect()->back();
        }

        //process question data
        $data = Array();
        $arr = $request->question;
        $length = count($arr);
        for($i=0;$i<$length;$i++){
           if($arr[$i] != null){
             $data[$i] = $arr[$i];
           }
        }

        // add question into question table
        
        $result = $this->lesson->addQuestion($id_lesson, $data);
        if($result) {

            Toastr::Success('update lesson successfully!!!','Success');
            return redirect('admin/course/'.$id.'/lesson'); 
        }else {
            Toastr::Error('update lesson successfully!!!','Error');
            return redirect('admin/course/'.$id.'/lesson/'.$id_lesson.'/question/create'); 
        }

    }

    // update question
    public function questionUpdate(Request $request) {
        $this->lesson->questionUpdate($request->question,$request->questionId);
        return redirect()->back()->with("notify","Update question successfully!");
    }

    // submit lab for lesson

    public function uploadLab(Request $request) {
        
          if ($request->file('lab_file')) {

            // $file = $request->file->store('public/backend/uploads/labs');
             
            $id_student = Auth::user()->id;
            $id_lesson = $request->id_lesson;
            $this->lesson->uploadLab($request, $id_student, $id_lesson); 
            return $request->lab_file;
  
        }
  
        return 2;


    }

    public function updateStatus($id_lesson, $status) {

        Lesson::where('id_lesson', $id_lesson)->update([
           'status' => $status  
        ]);

        Toastr::success('Updated status success','Success');
        return redirect()->back();


    }
}
