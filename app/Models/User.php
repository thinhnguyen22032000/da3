<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
    
        'email',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function showUser($level, $id=null){
       if($id){
           $data = DB::table('users')->where('level', $level)->where('id',$id)->get();
           if($data){
               return $data;
           }else{
              return false;
           }
       }
       $data = DB::table('users')->where('level', $level)->paginate(4);
       if($data){
        return $data;
       }else{
        return false;
       }
    }
    // update user(teacher, student)
    public function updateUser($req, $id){

        $flag = false;
        if($req->img){

            $data = array();
            $data['name'] = $req->name;
            $data['email'] = $req->email;
            $data['phone'] = $req->phone;
            $data['gender'] = $req->gender;
            $data['address'] = $req->address;

            $image = $req->file('img');
            $img_name = time().'.'.$image->getClientOriginalExtension();
            $data['img'] = $img_name;

            $imgCurrent = DB::table('users')->where('id', $id)->get();
            $imgCurrent = $imgCurrent[0]->img;
            $linkImg = 'public/backend/uploads/img/'.$imgCurrent;

            unlink($linkImg);

            DB::table('users')->where('id',$id)
                             ->update($data);



            
            $image->move('public/backend/uploads/img', $img_name);

            $flag = true;

            }else{

            $data = array();
            $data['name'] = $req->name;
            $data['email'] = $req->email;
            $data['phone'] = $req->phone;
            $data['gender'] = $req->gender;
            $data['address'] = $req->address;

            DB::table('users')->where('id',$id)
                             ->update($data);

            $flag = true; 
            }
        return $flag;

    }

    // add user (teacher, student)
    public function addUser($req, $user = null)
    {
        $flag = false;

        if($user === 'teacher'){

           if($req->img){

            $image = $req->file('img');
            $img_name = time().'.'.$image->getClientOriginalExtension();

            DB::table('users')->insert([
              'name' => $req->name,
              'email' =>$req->email,
              'password' =>bcrypt($req->password),
              'gender' =>$req->gender,
              'address' =>$req->address,
              'phone' =>$req->phone,
              'img' =>$img_name,
              'level' => 1,

            ]);
            $image->move('public/backend/uploads/img', $img_name);

            $flag = true;

            }else{

            DB::table('users')->insert([
              'name' => $req->name,
              'email' =>$req->email,
              'password' =>bcrypt($req->password),
              'gender' =>$req->gender,
              'address' =>$req->address,
              'phone' =>$req->phone,
              'img' =>'avatar.png',
              'level' => 1,
            ]);
            $flag = true; 
            }
            
        }else{

            if($req->img){

            $image = $req->file('img');
            $img_name = time().'.'.$image->getClientOriginalExtension();

            DB::table('users')->insert([
              'name' => $req->name,
              'email' =>$req->email,
              'password' =>bcrypt($req->password),
              'gender' =>$req->gender || '',
              'address' =>$req->address || '',
              'phone' =>$req->phone,
              'img' =>$img_name,
              'level' => 2,

            ]);
            $image->move('public/backend/uploads/img', $img_name);

            $flag = true;

            }else{

            DB::table('users')->insert([
              'name' => $req->name,
              'email' =>$req->email,
              'password' =>bcrypt($req->password),
              'address' => "",
              'phone' =>$req->phone,
              'img' =>'avatar.png',
              'level' => 2,
            ]);

            $flag = true; 
            }
        }
        
        return $flag;
    }
}
