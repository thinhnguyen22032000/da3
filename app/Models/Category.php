<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    public function updateCategory($req, $id) {
        
        $flag = false;
        $nameCat = $req->name;
        // nếu dữ dữ liệu không thay đỗi tên danh mục
        $checkItem = DB::table('category')->where('name', $nameCat)->where('id_cat', $id)->first();
        if($checkItem) {

            $data = array();
            $data['name'] = $req->name;
            $data['desc'] = $req->desc;

            DB::table('category')->where('id_cat',$id)
                             ->update($data);
        $flag = true;
        return $flag;
        }else{
             
             // nếu thay đỗi tên danh mục mà trung với tên danh mục khác.
             $checkItem = DB::table('category')->where('name', $nameCat)->first();

             if($checkItem){
                return $flag;
             }else{
                 $data = array();
                 $data['name'] = $req->name;
                 $data['desc'] = $req->desc;

                 DB::table('category')->where('id_cat',$id)
                                     ->update($data);
                 $flag = true;
                 return $flag;
             }
        }
        
    }
    
    // show category by teacher
    public function showCategory($id) {

         if($id) {
           $data = DB::table('category')->where('id', $id)->paginate(10);
           if($data){
               return $data;
           }else{
              return false;
           }
        }
    }
    
    public function showCategoryById($id = null) {
        if($id) {
           $data = DB::table('category')->where('id_cat', $id)->get();
           if($data){
               return $data;
           }else{
              return false;
           }

        }else{
           
           $data = DB::table('category')->get();
           if($data){
               return $data;
           }else{
              return false;
           }
        }
    }

    public function addCategory($req, $id) {
     
        $flag = false;

        if($req && $id) {

            DB::table('category')->insert([
              'id' => $id,
              'name' => $req->name,
              'desc' => $req->desc,
            ]);
        $flag = true;
        }
        return $flag;
    }
   
}
