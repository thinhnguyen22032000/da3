<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DB;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';
    
    //show cat by id teacher
    public function showCourse($id = null){
        // show cat for teacher
        if($id) {
           $data = DB::table('course')
           ->select('course.*', 'category.name as categoryName')
           ->join('category', 'course.id_cat', '=', 'category.id_cat')
           ->where('course.id', $id)->paginate(10);
           if($data){
               return $data;
           }else{
              return false;
           }
        }
        // show all for student (note)
        $data = DB::table('course')->paginate(10);
        if($data) {

           return $data;

        }else {

           return false;
        }
    }

    public function showCourseById($id = null) {
        
         if($id) {
            $data = DB::table('course')->where('id_course', $id)->get();

            if($data){
               return $data;
            }else{
              return false;
            }
        }
        return $data = DB::table('course')->get();

    }

    public function updateCourse($req, $id) {
        $flag = false;
        if($req->img){

            $data = array();
            $data['name'] = $req->name;
            $data['price'] = $req->price;
            $data['desc'] = $req->desc;
            $data['id_cat'] = $req->id_cat;

            $image = $req->file('img');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $image->move('public/backend/uploads/img', $img_name);
            
            $imgCurrent = DB::table('course')->where('id_course', $id)->get();
            $imgCurrent = $imgCurrent[0]->img;
            $linkImg = 'public/backend/uploads/img/'.$imgCurrent;

            if(file_exists($linkImg)) {
              unlink($linkImg);  
            }

            $data['img'] = $img_name;

            DB::table('course')->where('id_course',$id)
                             ->update($data);

            $flag = true;

        }else{

            $data = array();
            $data['name'] = $req->name;
            $data['price'] = $req->price;
            $data['desc'] = $req->desc;
            $data['id_cat'] = $req->id_cat;

            DB::table('course')->where('id_course',$id)
                             ->update($data);

            $flag = true; 
        }
        return $flag;
    }

    public function updateMember($id_course) {
        $getMemberCurrent = DB::table('course')->where('id_course', $id_course)->get();
        $getMemberCurrent = $getMemberCurrent[0]->member + 1;
        DB::table('course')->where('id_course', $id_course)->update(['member' => $getMemberCurrent]);
    }

    public function addCourse($req, $id) {
        $image = $req->file('img');
        $img_name = time().'.'.$image->getClientOriginalExtension();
        $image->move('public/backend/uploads/img', $img_name);

        $code = Str::random(8);
        
        DB::table('course')->insert([
          'id' => $id,
          'id_cat' => $req->id_cat,
          'name' => $req->name,
          'price' => $req->price,
          'desc' => $req->desc,
          'date_start' =>$req->date_start,
          'date_end' =>$req->date_start,
          'step' =>$req->step,
          'img' => $img_name,
          'code' => $code,
        ]);
    }

    public function addMyCourse($id_course, $id) {

        DB::table('mycourse')->insert([
              'id_course' => $id_course,
              'id' => $id,
        ]);
    }

    public function showMyCourse($id) {
        $data = DB::table('mycourse')->select('course.*', 'mycourse.code_confirm')
                                     ->join('course', 'mycourse.id_course', '=', 'course.id_course')
                                     ->where('mycourse.id', $id)
                                     ->get();
        if($data) return $data;
        
        return false;
    }

     public function showIdMyCourse($id) {
        $data = DB::table('mycourse')->select('mycourse.id_course')
                                     ->join('course', 'mycourse.id_course', '=', 'course.id_course')
                                     ->where('mycourse.id', $id)
                                     ->get();
        if($data) return $data;
        
        return false;
    }

    public function updateSateCode($req, $id_course) {
        if($req && $id_course) {

            DB::table('mycourse')->where('id_course', $id_course)->update([
             'code_confirm' => 1,
            ]);
            return true;
        }else {
            return false;
        }
    }

    public function showCourseByCat($id_cat) {
        if($id_cat) {

            return DB::table('course')->where('id_cat', $id_cat)->get();
        }
    }
    // func search by key
    public function searchCoursesByKey($key) {
        return DB::table('course')->where('name', 'LIKE', '%'.$key.'%')->get();
    }
    
}
