@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > category > list')

@section('admin_content')
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>  
        <th>Name</th>
        <th>Description</th>
        <th>action</th>
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
                <i class="fas fa-edit text-success"></i>
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