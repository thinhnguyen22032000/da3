@extends('dashboard_layout')

@section('title', 'Home')
@section('path', '> Edit Course')
@section('name', 'admin/course')
@section('test', 'List Course')
@section('admin_content')

<p><i class="fas fa-bars"></i> Edit course</p>
<a href="{{url('/admin/course')}}" class="btn btn-primary btn-icon mb-2"><i class="fas fa-redo"></i></a>
@foreach($result as $item)
<form id="" action="{{url('admin/course')}}/{{$item->id_course}}" method="post" enctype='multipart/form-data'>
@csrf
{{ method_field('PUT') }}  

    <div class="row">
        <div class="col-md-8">

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Course category</label>
            <div class="col-sm-6">
               <select name='id_cat' class="form-select" aria-label="Default select example">
                  <option selected>Choose category name</option>
                  @foreach($categoryData as $catName)
                  @if($item->id_cat == $catName->id_cat)
                  <option selected value="{{$catName->id_cat}}">{{$catName->name}}</option>
                  @else
                  <option value="{{$catName->id_cat}}">{{$catName->name}}</option>
                  @endif
                  @endforeach
              </select>
              @error('id_cat')
              <p class="text-danger mb-0"> {{ $message }} </p>
              @enderror
            </div>
            <p class="form-message"></p>
          </div>

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
              <input type="text" value="{{$item->name}}" name="name" class="form-control"  placeholder="Name">
              @error('name')
              <p class="text-danger mb-0"> {{ $message }} </p>
              @enderror
            </div>
            <p class="form-message"></p>
          </div>

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-4">
              <input type="number" value="{{$item->price}}" name="price" class="form-control"  placeholder="Price">
               @error('price')
               <p class="text-danger mb-0"> {{ $message }} </p>
               @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-8">
               <textarea id="summernote" name="desc" class="form-control rounded-0" rows="3">
                   {{$item->desc}}
               </textarea>
               @error('desc')
               <p class="text-danger mb-0"> {{ $message }} </p>
               @enderror
            </div>
          </div>

         </div>
        <div class="col-md-4">
            
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="img">
                    @error('img')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                    @enderror
                </div>
                <img style="width: 100px" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="">
            </div>

           <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Date start</label>
                <div class="col-sm-9">
                  <input type="date"
                         value="{{ date('Y-m-d',strtotime($item->date_start)) }}" disabled  class="form-control" name="date_start">
                  @error('date_start')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                  @enderror
                </div>
           </div>

           <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Step</label>
                <div class="col-sm-9">
                  <input type="number" value="{{$item->step}}" disabled class="form-control" name="step">
                  @error('step')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                  @enderror
                </div>
           </div>
        </div>
    </div>
  
    
     <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
    </div>
  </div>
</form>
@endforeach
@endsection
<script>
       
    
    //  Validator({
    //     form: '#form_create_teacher',
    //     errorSelector: '.error-message',
    //     rules: [
    //         Validator.isRequired('#name'),
    //         // Validator.isEmail('#email'),
    //         // Validator.isMin('#password', 6),
    //         // Validator.isConfirm('#password_confirmation', function(){
    //         //     return document.querySelector('#form-1 #password').value;
    //         // }),
    //     ]
    // });
</script>