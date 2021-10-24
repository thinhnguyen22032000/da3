<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use Auth;


class HomeController extends Controller
{
    private $course;
    private $category;

    public function __construct() {
         $this->course = new Course();
         $this->category = new Category();
    }

    public function showCourseL3($id = null)
    {
         
        $id_student = Auth::user()->id;
        $data = $this->course->showIdMyCourse($id_student);
        $myIdCourses = Array();
        $length = count($data);
        for($i = 0; $i < $length; $i++ ) {
             $myIdCourses[$i] =  $data[$i]->id_course;
        }

        $categoryNames = $this->category->showCategoryById();
       
        // -----------------------------
        
        // if isset q
        
        if(isset($_GET['q'])) {
            $key = $_GET['q'];
            $result = $this->course->searchCoursesByKey($key);
            return view('admin.student.list_courseL3', compact(['result', 'categoryNames', 'myIdCourses']));     
           
        }
        
        
        $result = $this->course->showCourseById();
        //------------------
        if($id == null) {
           return view('admin.student.list_courseL3', compact(['result', 'categoryNames', 'myIdCourses']));
        }
        elseif($id == 1) {
            $length = count($result);
           for($i = 0; $i <  $length; $i++) {
              if(!in_array($result[$i]->id_course, $myIdCourses)) {
                  unset($result[$i]);
              } 
            
           }
           return view('admin.student.list_courseL3', compact(['result', 'categoryNames', 'myIdCourses']));
        }
        else {
            $length = count($result);
             for($i = 0; $i < $length; $i++) {
              if(in_array($result[$i]->id_course, $myIdCourses)) {
                  unset($result[$i]);
              }    
           }
           return view('admin.student.list_courseL3', compact(['result', 'categoryNames', 'myIdCourses']));
        } 
     }

     public function showCourseByCat($id) {

        if($id) {
            $id_student = Auth::user()->id;
            $data = $this->course->showIdMyCourse($id_student);
            $myIdCourses = Array();
            
            for($i = 0; $i < count($data); $i++ ) {
                 $myIdCourses[$i] =  $data[$i]->id_course;
            }
            $result = $this->course->showCourseByCat($id);
            $categoryNames = $this->category->showCategoryById();
            return view('admin.student.course_for_category', compact(['result', 'categoryNames','myIdCourses']));
        }
       
        dd("ko ton tai id");
        
     }

     
}
