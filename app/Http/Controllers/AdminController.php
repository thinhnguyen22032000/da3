<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\stdClass;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Course;
use DB;
use Toastr;
use Mail;


class AdminController extends Controller
{

    public function dashboard(){


        $data = array();

        $numTeacher = count(User::where('level', 1)->get());
        $obj = (object) array('info' => 'teacher',
                              'num' => $numTeacher,
                              'style' => 'small-box bg-info',
                              'content' => 'Teacher',
                              'icon' => 'fas fa-chalkboard-teacher'
                             );
        array_push($data, $obj);
       
        $numStudent = count(User::where('level', 2)->get());
        $obj = (object) array('info' => 'student',
                              'num' => $numStudent,
                              'style' => 'small-box bg-success',
                              'content' => 'Student',
                              'icon' => 'fas fa-user-graduate'
                             );

        array_push($data, $obj);

        $numCourse = count(Course::all());
        $obj = (object) array('info' => 'course',
                              'num' => $numCourse,
                              'style' => 'small-box bg-warning',
                              'content' => 'Course',
                              'icon' => 'fas fa-book'
                             );
        array_push($data, $obj);

        $sumPrice = DB::table('course')->select( DB::raw('SUM(price * member) as total'))
                           ->groupBy('id_course')->get();
        $total = 0;
        foreach( $sumPrice as $item ) {

          $total += $item->total;
        }

        $obj = (object) array('info' => '$ Total',
                              'num' => $total,
                              'style' => 'small-box bg-danger',
                              'content' => 'Total $',
                              'icon' => 'fas fa-shopping-cart'
                             );
        array_push($data, $obj);
        
        return view('auth.dashboard', compact('data'));
    }

    public function welcome() {
        return view('auth.teacher_welcome');
    }

    
    public function getRegister(){

         return view('auth.admin_register');

    }

    public function checkRegister(Request $request){
        
         $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
          'phone' => 'required|max:10',
          'gender' => 'required',
          'passwordAgain' => 'required|min:6',
        ]);
        
        $user = 'student';
        if($request->password === $request->passwordAgain){
            $user = new User();
            $result = $user->addUser($request, $user);
            if($result){
                Toastr::success('User register successfully!!!','Success');
                return redirect()->route('login');
            }else{
                Toastr::error('Register user failed!!!','Error');
                return redirect('admin/register'); 
            }

        }else{
             return redirect('admin/register')->with('errPw', 'Password is not match'); 
        }

    }

    public function getLogin(){

         if(Auth::check()) {
                $level = Auth::user()->level;
                 switch ($level) {
                 case 0:
                     return redirect('admin/dashboard');
                 case 1:
                     return redirect('admin/welcome');
                 default:
                     return redirect('home');
             }
         }
         return view('auth.admin_login');

    }

    public function logout(){
        $user = User::find(Auth::user()->id);
        $user->active = 0;
        $user->save();
        Auth::logout();
        return redirect()->route('login');
    }

    public function checkLogin(Request $req){
         
         $req->validate([
           'email' => 'required',
           'password' => 'required|min:6',
         ]);
         
         $arr = [
            'email' => $req->email,
            'password' =>$req->password,
         ];
          $remember = $req->has('remember') ? true : false;
         if(Auth::attempt($arr, $remember)){
               $user = User::find(Auth::user()->id);
               $user->active = 1;
               $user->save();
            if(Auth::user()->level == 0 || Auth::user()->level == 1){
    
               return redirect('admin/dashboard');
            }
            else {
               return redirect('home'); 
            }
            
         }else{
            return redirect('/')->with('message', 'Email or Password is not correct');
         }
    }

    public function forgotPassword() {
        return view('auth.forgot_password');
    }
    
    // forgot password.
    public function recoverPassword(Request $request) {

         $request->validate([
           'email' => 'required',
           
         ]);

        $user = DB::table('users')->where('email', $request->email)->get();
        if(count($user) > 0) {

           // $encryptPassword = $user[0]->password;
           
           // $password = Crypt::decryptString($encryptPassword);
           $token = Str::random(14);
           $user = User::find($user[0]->id);
           $user->remember_token = $token;
           $user->save();

           $reset_password_link = url('update_password?email='.$request->email.'&token='.$token);
            
            $sendFrom = 'thinhDEV';
            $to_name = "thinhDEV";
                    $to_email = $request->email;//send to this email
            
                    $data = array("name" => $sendFrom,
                                  "link" => $reset_password_link
                                  ); //body of mail.blade.php
                
                    Mail::send('email.forgot_password',$data,function($message) use ($to_name,$to_email){
                        $message->to($to_email)->subject('forgot password');//send this mail with subject
                        $message->from($to_email,$to_name);//send from this mail
            });

        return redirect()->back()->with('msg', 'Email send success. Please check your mail!');
        }else{
           return redirect()->back()->with('msg', "Email is not correct!!");
        }
        
    }


    public function getUpdatePassword() {
        return view('auth.update_password');
    }

    public function updatePassword(Request $request) {
        $request->validate([
           'password' => 'required|min:6'
        ]);
        
        $user = DB::table('users')->where('email', $request->email)->where('remember_token', $request->token)->get();

        if(count($user) > 0) {
            
            $random_token = Str::random(14);

            $user = User::find($user[0]->id);
            $user->password = bcrypt($request->password);
            $user->remember_token = $random_token; 
            $user->save(); 
            
            return redirect()->route('login')->with('msg', 'Reset password success! :)).');   
        }else {
            return redirect()->back()->with('msg', 'Token invalid');
        }
    }


}
