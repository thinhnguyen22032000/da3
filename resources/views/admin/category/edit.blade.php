@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > category > edit')

@section('admin_content')

@foreach($result as $item)
<form action="{{url('admin/category')}}/{{$item->id_cat}}" method="post" enctype='multipart/form-data'>
@csrf
{{ method_field('PUT') }}

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Category name</label>
    <div class="col-sm-4">
      <input type="text" value="{{$item->name}}" name="name" class="form-control"  placeholder="Name">
      @error('name')
      <p class="text-danger mb-0"> {{ $message }} </p>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-4">
      <textarea id="summernote" name="desc" class="form-control rounded-0" rows="3">{{$item->desc}}</textarea>
       @error('desc')
      <p class="text-danger mb-0"> {{ $message }} </p>
       @enderror
    </div>
  </div>
  
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
  
</form>
@endforeach
@endsection