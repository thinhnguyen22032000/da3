@extends('dashboard_layout')

@section('title', 'Home')
@section('path', '> Course of Category')
@section('name', 'admin/category')
@section('test', 'List Categories')
@section('admin_content')

<p class="font-weight-bold"><i class="fas fa-bars"></i> Category: {{$catName->name}}</p>
<div class="row">

    @if(!$courses->isEmpty())
    @foreach($courses as $item)
    <div class="col-4">
        <div class="card">
          <div class="card-header">
            {{$item->name}}
          </div>
          <div class="card-body">
            <p class="card-text">{{$item->desc}}</p>
            <a href="{{url('admin/course/'.$item->id_course.'/edit')}}" class="btn btn-primary"><i class="fas fa-arrow-right"></i> Modify</a>
          </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="alert alert-notify" role="alert">
        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
         You don't have any course yet, please add them
         <a href="{{url('admin/course/create')}}" class="alert-notify__link">here</a>
    </div>
    @endif
</div>

@endsection