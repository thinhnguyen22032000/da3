<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Toastr;

class SliderController extends Controller
{
    public function index() {

        $result = Slider::all();
        return view('admin.extension.slider.slider', compact('result'));
    }

    public function store(Request $req) {
        $req->validate([
            'title' => 'required',
            'status' => 'required',
            'order' => 'required',
            'author' => 'required'
        ]);
        $slider = new Slider();
        
        $slider->title = $req->title;
        $slider->status = $req->status;
        $slider->order = $req->order;
        $slider->author = $req->author;
         
        $slider->save();
        Toastr::success('Slider created successfully!!!','Success');
        return redirect()->back();
    }

    public function edit($id) {
       $result =  Slider::find($id);
       return view('admin.extension.slider.edit', compact('result'));
    }

    public function update(Request $req, $id) {
        $req->validate([
            'title' => 'required',
            'status' => 'required',
            'order' => 'required',
            'author' => 'required'
        ]);
        $slider = Slider::where('id_slider', $id)->update([
            'title' => $req->title,
            'author' => $req->author,
            'status' => $req->status,
            'order' => $req->order,

        ]);
        Toastr::success('Slider updated successfully!!!','Success');
        return redirect()->route('slider.manager');
    }
}
