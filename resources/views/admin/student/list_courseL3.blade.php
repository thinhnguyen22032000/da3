@extends('dashboard_layout');

@section('title', 'home')

@section('path', 'home')

@section('admin_content')
<link rel="stylesheet" href="{{asset('public/backend/dist/css/mycss.css')}}">

<div class="category__list">
    @foreach($categoryNames as $row) 
    <a href="{{url('admin/home/category/'.$row->id_cat)}}" class="btn btn-primary catagory__item-link">{{$row->name}}</a>
     @endforeach
</div>
<hr>
<!-- nav filter -->
@include('sub_layout.home_nav_filter')
<hr>
<!-- list course -->
@include('sub_layout.home_show_course')

@endsection