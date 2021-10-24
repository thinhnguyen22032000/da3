<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class APIController extends Controller
{
    public function index($id_course) {
        $lesson = new Lesson();
        $data = $lesson->showLesson($id_course); // lesson first
        return response()->json($data);
    }
}
