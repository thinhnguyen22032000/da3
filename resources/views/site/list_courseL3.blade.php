@extends('dashboard_layout')

@section('title', 'Home')

@section('path', (parse_str($path)))

@section('admin_content')
<link rel="stylesheet" href="{{asset('public/backend/dist/css/mycss.css')}}">

<div class="category__list">
    @foreach($categoryNames as $row) 
    <a href="{{url('category/'.$row->id_cat)}}" class="btn btn-primary catagory__item-link">{{$row->name}}</a>
     @endforeach
</div>
<hr>
<!-- nav filter -->
@include('sub_layout.home_nav_filter')
<hr>
<!-- list course -->
<?php 
     if(isset($_GET['q'])){
        echo '<h4>Search key: '.$_GET['q'].'</h4>';
     }
?>
<br>
@include('sub_layout.home_show_course')
@endsection