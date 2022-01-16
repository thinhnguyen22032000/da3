<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class APIController extends Controller
{
    public function index() {
        $id = Auth::user()->id;

        if(Auth::check()) {
            if($id == 1)
            return redirect()->route('dashboard');
        }
    }
}