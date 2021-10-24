<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Toastr;
class AdminController extends Controller
{

    public function dashboard(){
        return view('admin.dashboard');
    }
    
    public function getRegister(){

         return view('admin.admin_register');

    }

    public function checkRegister(Request $request){
        
         $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
          'phone' => 'required',
          'passwordAgain' => 'required|min:6',
        ]);
        
        $user = 'student';
        if($request->password === $request->passwordAgain){
            $user = new User();
            $result = $user->addUser($request, $user);
            if($result){
                Toastr::success('User register successfully!!!','Success');
                return redirect('admin/register');
            }else{
                Toastr::error('Register user failed!!!','Error');
                return redirect('admin/register'); 
            }

        }else{
             return redirect('admin/register')->with('errPw', 'Password is not match'); 
        }

    }

    public function getLogin(){

         return view('admin.admin_login');

    }

    public function logout(){
        Auth::logout();
        return redirect('admin');
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
          
         if(Auth::attempt($arr)){
            if(Auth::user()->level == 0 || Auth::user()->level == 1){
               return redirect('admin/dashboard');
            }
            else {
               return redirect('admin/home'); 
            }
            
         }else{
            return redirect('admin')->with('message', 'email or password is correct');
         }
    }


}
