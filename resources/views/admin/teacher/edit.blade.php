@extends('dashboard_layout')

@section('title', 'Home')

@section('path', '> Edit Teacher')
@section('name', 'admin/teacher')
@section('test', 'List Teacher')
@section('admin_content')

<p><i class="fas fa-bars"></i> Edit Teacher</p>
<a href="{{url('/admin/teacher')}}" class="btn btn-primary btn-icon mb-2"><i class="fas fa-redo"></i></a>

@if(session('message'))
<div class="alert alert-primary mt-1 p-1" role="alert">{{ session('message') }}</div>
@endif
@foreach($result as $item)
<form action="{{url('admin/teacher')}}/{{$item->id}}" method="post" enctype='multipart/form-data'>
    @csrf
    {{ method_field('PUT') }}
  <div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-4">
      <input type="text" value="{{$item->name}}" name="name" class="form-control"  placeholder="Name">
      @error('name')
      <div class="alert alert-danger mt-1 p-1" role="alert">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
      <input type="email" value="{{$item->email}}" name="email" class="form-control"  placeholder="Email">
       @error('email')
       <div class="alert alert-danger mt-1 p-1" role="alert">{{ $message }}</div>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-4">
      <input type="text" value="{{$item->phone}}" name="phone" class="form-control" placeholder="phone">
       @error('phone')
       <div class="alert alert-danger mt-1 p-1" role="alert">{{ $message }}</div>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Gender</label>
    <div class="col-sm-4">
      <select name="gender" class="form-control" aria-label="Default select example">
              <option selected value="0">---Gender---</option>
              @if($item->gender === 0)
                  <option selected value="0">Male</option>
                  <option value="1">Female</option>   
              @else
                  <option value="0">Male</option>
                  <option selected value="1">Female</option>   
              @endif    
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-4">
       <textarea name="address"  class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3">{{$item->address}}</textarea>
        @error('address')
       <div class="alert alert-danger mt-1 p-1" role="alert">{{ $message }}</div>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Avatar</label>
    <div class="col-sm-4">
      <input type="file" name="img">
      <img style="width: 100px" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="">
    </div>
  </div>


  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
    </div>
  </div>
  
  </div>
</form>
@endforeach
@endsection