@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > teacher > list')

@section('admin_content')
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>image</th>
        <th>name</th>
        <th>email</th>
        <th>gender</th>
        <th>phone</th>
        <th>address</th>
        <th >action</th>
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
        <td>{{$item->gender===0?'male':'female'}}</td>
        <td>{{$item->phone}}</td>
        <td>{{$item->address}}</td>
        <td >
            <a href="{{url('admin/teacher/'.$item->id.'/edit')}}">
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