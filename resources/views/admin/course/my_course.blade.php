@extends('dashboard_layout');

@section('title', 'home')

@section('path', 'home > my course')

@section('admin_content')
<link rel="stylesheet" href="{{asset('public/backend/dist/css/mycss.css')}}">

<div class="row">
    @foreach($result as $item)
    <div class="col-4">
      <div class="card card_costom">
             <div class="card-fit-img">
             <img 
             src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
             class="card-img-top card-img-height" alt="...">
             </div>
             <div class="card-content">
                 
                 <h3 class="card-title card-body_title">{{$item->name}}</h3>
                 
                 <i class="fas fa-users card-body__icon"><span class="member-count">: 2000</span></i>
                 <!-- == o la chua nhap code -->
                 @if($item->code_confirm != 0)
                 <a href="{{url('admin/my_course/'.$item->id_course.'/learning')}}" class="btn btn-primary btn-learn">learn now</a>
                 @else
                 <form action="{{url('admin/my_course/check_code/'.$item->id_course)}}" method="post" class="mt-2">
                 @csrf
                     <input type="text" name="code" placeholder="code...">
                     <button type="submit">confirm</button>
                 </form>
                 @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection