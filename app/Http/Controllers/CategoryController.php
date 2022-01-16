<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;

use Auth;
use Toastr;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $category;

    public function __construct() {
        return $this->category = new Category();
    }

    public function index()
    {
        $category = new Category();
        $id_teacher = Auth::user()->id;
        $result = $category->showCategory($id_teacher);

        return view('admin.category.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
          'name'=> 'required|unique:category',
          'desc'=> 'required',    
        ]);
       
        $category = new Category();
        $id_teacher = Auth::user()->id;
        $result = $category->addCategory($request, $id_teacher);

        if($result){
           Toastr::success('Successfully!!!','Success');
           return redirect('admin/category');
        }else{
           Toastr::error('Failed!!!','Error');
           return redirect('admin/category/create');  
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = new Category();
        $result = $category->showCategoryById($id);
        return view('admin.category.edit', compact('result'));
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
          'desc' => 'required',
        ]);

        $category = new Category();
        $result = $category->updateCategory($request, $id);
        if($result){
            Toastr::success('Successfully!!!','Success'); 
            return redirect('admin/category');
        }else{
             Toastr::error('Category name already exists','Error');
             return redirect('admin/category/'.$id.'/edit');
        }
    }

    public function getCourseByCat($id_cat) {
        $catName = Category::where('id_cat', $id_cat)->first();
        $courses = Course::where('id_cat', $id_cat)->where('id', Auth::user()->id)->get();
        return view('admin.category.course_of_cat', compact(['courses', 'catName']));

    }
}
