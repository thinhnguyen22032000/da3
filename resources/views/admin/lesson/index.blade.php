@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', ($position))

@section('admin_content')
@include('sub_layout.sub_nav_lesson')

<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date open</th>
        <th>Question</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
      <tr>
        <td>{{$item->id_lesson}}</td>
        <td>{{$item->title}}</td>
        <td>{{$item->desc}}</td>
        <td>{{ date('d-m-Y',strtotime($item->date_open)) }}</td>
        <td>{{$item->question}}</td>

        <td >
            <a href="{{url('admin/course/'.$id.'/lesson/'. $item->id_lesson .'/edit')}}">
                <i class="fas fa-edit text-success"></i>
            </a>
             <a href="{{url('admin/course/'.$id.'/lesson/'. $item->id_lesson .'/question/create')}}">
                question
            </a>
        </td>
      </tr>
    @endforeach  
    </tbody>
</table>

<hr>

<div>
   
</div> 
@endsection