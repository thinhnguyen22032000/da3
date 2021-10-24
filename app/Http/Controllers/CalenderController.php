<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Lesson;
use Auth;


class CalenderController extends Controller
{
    public function index() {

         return view('admin.student.calender');
    }
    
    public function api_calender() {
         // $data = Event::all();
         // $events = [];
         $lesson = new Lesson();
         $id_student = Auth::user()->id;
         $data = $lesson->showMyCalender($id_student);
         foreach($data as $event) {
           $event->start = $event->date_open;
         }
         return response()->json($data);
    }
}
