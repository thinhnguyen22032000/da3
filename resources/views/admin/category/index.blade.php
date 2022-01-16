@extends('dashboard_layout')

@section('title', 'Home')

@section('path', ' List Categories')

@section('admin_content')
<p class="font-weight-bold"><i class="fas fa-bars"></i> List Categories</p>
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>  
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
      <tr>
        <td>{{$item->id_cat}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->desc}}</td>
        <td >
            <a href="{{url('admin/category/'.$item->id_cat.'/edit')}}">
                <p class="btn btn-warning p-1"><i class="fas fa-edit text-white"></i></p>
            </a>
            <a href="{{url('admin/category/'.$item->id_cat.'/course')}}">
                <p class="btn btn-primary p-0 pl-1 pr-1">more</i></p>
            </a>
        </td>
      </tr>
    @endforeach  
    </tbody>
</table>

<hr>

<div>
    {{ $result->links() }} 
</div> 
@endsection