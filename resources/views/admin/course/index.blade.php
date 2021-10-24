@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > course > list')

@section('admin_content')
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Code</th>
        <th>Date start</th>
        <th>Step</th>
        <th>Status</th>
        <th >action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($result as $item)
      <tr>
        <td>{{$item->id_course}}</td>
        <td>{{$item->categoryName}}</td>
        <td style="width: 200px;">
            <img class="w-25" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="">
        </td>
        <td>{{$item->name}}</td>
        <td>${{$item->price}}</td>
        <td>{{$item->code}}</td>
        <td>{{ date('d-m-Y',strtotime($item->date_start)) }}</td>
        <td>{{$item->step}}</td>
        <td>
            @if($item->status == 0)
              <span class="badge badge-danger">private</span>
            @else
              <span class="badge badge-success">public</span> 
            @endif
        </td>
        <td >
            <a href="{{url('admin/course/'.$item->id_course.'/edit')}}">
                <i class="fas fa-edit text-success"></i>
            </a>
            <a href="{{url('admin/course/'.$item->id_course.'/lesson')}}">
               <span class="badge badge-primary">view</span>
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