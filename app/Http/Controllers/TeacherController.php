<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // protected $user;

    // public function __construct()
    // {
    //     $user = new User();
    // }

    public function index()
    {
        $user = new User();
        $level_teacher = 1;
        $result = $user->showUser($level_teacher);
        return view('admin.teacher.index', compact('result'));
    }
    public function toastr(){
        Toastr::success('User added successfully!!!','Success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6',
          'phone' => 'required',
          'address' => 'required',
          'passwordAgain' => 'required|min:6',
        ]);
        if($request->password === $request->passwordAgain){
            $user = new User();
            $level = 'teacher';
            $result = $user->addUser($request,  $level);
            if($result){
                Toastr::success('User added successfully!!!','Success');
                return redirect('admin/teacher');
            }else{
                Toastr::error('Add user failed!!!','Error');
                return redirect('admin/teacher/create'); 
            }

        }else{
            return redirect('admin/teacher/create')->with('errPw', 'Password is not match'); 
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
    public function edit($id)
    {
         $user = new User();
         $result = $user->showUser(1, $id);
         return view('admin.teacher.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'name' => 'required',
          'email' => 'required|email',      
          'phone' => 'required',
          'address' => 'required',
        ]);

        $user = new User();
        $result = $user->updateUser($request, $id);
        if($result){
            Toastr::success('User added successfully!!!','Success'); 
            return redirect('admin/teacher');
        }else{
             Toastr::error('User added successfully!!!','Success');
             return redirect('admin/teacher');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
