@extends('dashboard_layout')

@section('title', 'Home')
@section('code', 'home')
@section('path', '> Notify')
@section('test', ($position))
@section('name',('admin/course_detail/'.$id_course))
@section('admin_content')

<style>
    .body_notify {
       margin-top: 70px;
    }
</style>

<center>
    <span class="alert alert-success" role="alert">
         You have successfully purchased the course
    </span>

    <div class="body_notify">
        <p>The code has been sent to your mail account {{$email_student}}</p>
        <p>Please check your email and see the instructions</p>
        <div class="mb-2"><span>come to the course now </span><a href="{{url('/my_course')}}">here</a></div>
        <img src="{{asset('public/backend/uploads/img/tryhard.jpg')}}" alt="">
        <p>We hope the courses will help you, thank you very much</p>

    </div>
</center>
    
    
@endsection