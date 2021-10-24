@extends('dashboard_layout');

@section('title', 'home')

@section('path', 'home')

@section('admin_content')
<style>
    .card_costom {
        max-height: 300px;
        position: relative;
    }
    
    .card_notify {
               position: absolute;
                color: #fff;
                top: 8;
                left: -4px;
                width: auto;
                background-color: chartreuse;
                padding: 4px;
                font-size: 12px;
                border-bottom-right-radius: 2px;
                border-top-right-radius: 2px;
    }

    .card_notify::after {
            content: "";
            position: absolute;
            border-top: 4px solid green;
            border-left: 4px solid transparent;
            left: 0;
            top: 25px;
    }

    .card-img-height {
        height: 240px;
    }
    .card-body_title {
        cursor: pointer;
        color: #000;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
        font-size: 20px;
        font-weight: 600;
    }
    .card-body__icon {
        margin-top: 4px;
        color: #8e9596;
    }
    .card-content {
           display: flex;
            flex-direction: column;
            padding: 8px;
    }
    .member-count{
            font-weight: 300;
            color: #8e9596;
    }
   
    .category__list {

        display: flex;
        overflow-x: auto;
    }
    .catagory__item-link:nth-of-type(3n + 1) {
        background-color: #87AFD8;
    }
    .catagory__item-link:nth-of-type(3n + 2) {
        background-color: #76C9BD;
    }
    .catagory__item-link:nth-of-type(3n + 3) {
        background-color: #88CF81;
    }
    .catagory__item-link {
        margin-right: 15px;
        border: none;
        padding: 8px 20px;
        min-width: 200px;
    }
    ::-webkit-scrollbar {
      height: 8px;              /* height of horizontal scrollbar ← You're missing this */
           /* width of vertical scrollbar */
      border: 1px solid #d5d5d5;
    }
     ::-webkit-scrollbar-thumb:horizontal{
        background: rgba(0,0,0,.4);
        border-radius: 20px;
    }
</style>

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