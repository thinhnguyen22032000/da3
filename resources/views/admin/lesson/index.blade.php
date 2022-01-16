@extends('dashboard_layout')

@section('title', 'Home')

@section('path', ('>'.$position))
@section('name', 'admin/course')
@section('test', 'List Course')
@section('admin_content')

<style type="text/css">
    .toggle-lesson {
        font-size: 26px;
        text-decoration: none;
        color: #0060B6;
    }
    .toggle-lesson:hover {
        
        opacity: 0.8;
    }
    .toggle-lesson__open {
        color: green;
    }
    .toggle-lesson__close {
        color: #333;
    }
</style>

<p><i class="fas fa-bars"></i> List lessons</p>
@include('sub_layout.sub_nav_lesson')

<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date open</th>
        <th>Question</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

    @if(!$result->isEmpty())
    @foreach($result as $item)
      <tr>
        <td>{{$item->id_lesson}}</td>
        <td>{{$item->title}}</td>
        <td>{{$item->desc}}</td>
        <td>{{ date('d-m-Y',strtotime($item->date_open)) }}</td>
        <td>{{$item->question}}</td>
        <td>
            <?php 
                 if($item->status == 1) { ?>
                    <a class="toggle-lesson toggle-lesson__open"
                     href="{{url('admin/lesson/'.$item->id_lesson.'/status/0')}}"><i class="fas fa-toggle-on"></i></a>
            <?php
                 }else{ ?>
                    <a class="toggle-lesson toggle-lesson__close"
                     href="{{url('admin/lesson/'.$item->id_lesson.'/status/1')}}"><i class="fas fa-toggle-off"></i></a>
            <?php
                 }
            ?>
        </td>

        <td >
            <a href="{{url('admin/course/'.$id.'/lesson/'. $item->id_lesson .'/edit')}}" style="margin-right: 12px;">
                <button class="btn btn-warning p-1"><i class="fas fa-edit text-white"></i></button>
            </a>
             <a href="{{url('admin/course/'.$id.'/lesson/'. $item->id_lesson .'/question/create')}}">
                <button class="btn btn-primary p-1"><i class="fas fa-question-circle"></i></button>
            </a>
        </td>
      </tr>
    @endforeach
    @else
    <div class="alert alert-notify" role="alert">
        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
         You don't have any lessons yet, please add them
         <a href="{{url('admin/course/'.$id.'/lesson/create')}}" class="alert-notify__link">here</a>
    </div>
    @endif
    </tbody>
</table>

<hr>

<div>
   
</div> 
@endsection