@extends('dashboard_layout')

@section('title', 'Home')

@section('path', 'List Teacher')

@section('admin_content')
<?php 
     if(isset($_GET['q'])){
        echo '<h4>Search key: '.$_GET['q'].'</h4>';
     }
?>
<p><i class="fas fa-bars"></i> List Teacher</p>
<form action="{{url('admin/teacher')}}" id="form-search"  method="GET" style="margin-left: 70%;">
            @csrf
           <input type="text" class="" placeholder="Enter teacher name..." name="q">
           <button id="btnSearch" class="btn btn-success mb-1"><i class="fas fa-search" title="search"></i></button>
           <a href="{{url('/admin/teacher')}}" class="btn btn-primary btn-icon mb-1" title="resfest"><i class="fas fa-sync-alt"></i></a>
</form>
<div>Total data: {{ $numRow }}</div>
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Avatar</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td>
            <img class="w-25" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="">
        </td>
        <td>{{$item->name}}</td>
        <td>{{$item->email}}</td>
        <td>
            <?php 
            if($item->gender == 0) { ?>
               <p class="btn btn-primary btn-status"><i class="fas fa-male"></i></p>
            <?php
            }else { ?>
              <p class="btn btn-danger btn-status"><i class="fas fa-female"></i><p>
            <?php        
            }
            ?>
        </td>
        <td>{{$item->phone}}</td>
        <td>
            <?php 
                 if($item->active == 0) { ?>
                    <p class="btn btn-danger btn-status p-1">offline</p>
            <?php
                 }else{ ?>
                <p class="btn btn-success btn-status p-1">online</p>
            <?php  
                 }
            ?>
        </td>
        <td >
            <a href="{{url('admin/teacher/'.$item->id.'/edit')}}">
               <p class="btn btn-warning p-1"><i class="fas fa-edit text-white"></i></p>
            </a>
        </td>
      </tr>
    @endforeach  
    </tbody>
</table>

<hr>


@endsection