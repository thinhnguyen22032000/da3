@extends('dashboard_layout')

@section('title', 'Home')

@section('path', 'Submited List')

@section('admin_content')

<style type="text/css">
    .btn_style {
        width: 100%;
        text-align: start;
        color: #4a4848 !important;
        background-color: #fff;
        border-color: #e2e7ec !important;
        box-shadow: none
        }

    .btn_style:hover {
        color: #fff !important;
    }
    .btn_style:focus {
        color: #fff !important;
    }
</style>

<p class="font-weight-bold"><i class="fas fa-bars"></i> Submited List</p>

@foreach($data as $item)
<p>

  <button class="btn btn-primary btn_style" type="button" data-toggle="collapse" data-target="#collap{{$item->id_course}}" aria-expanded="false" aria-controls="collap{{$item->id_course}}">
   <i class="far fa-arrow-alt-circle-right"></i> {{$item->name}}
  </button>
</p>
<div class="collapse" id="collap{{$item->id_course}}">
  <div class="card card-body">
    <ul class="list-group">
      @if(!$item->lesson->isEmpty())
      @foreach($item->lesson as $lesson)
      <li class="list-group-item"><i class="far fa-circle"></i><a href="{{url('admin/lab/'.$lesson->title.'/'.$lesson->id_lesson)}}"> {{$lesson->title}}</a></li>
      @endforeach
      @else
       <div class="alert alert-notify" role="alert">
        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
         You don't have any lesson yet, please add them
    </div>
      @endif
    </ul>
  </div>
</div>

@endforeach

@endsection

