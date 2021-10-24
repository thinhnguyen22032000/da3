@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > category > create')

@section('admin_content')

<form id="form_create_category" action="{{url('admin/category')}}" method="post">
@csrf
 
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Category name</label>
    <div class="col-sm-4">
      <input type="text" name="name" class="form-control"  placeholder="category name">
      @error('name')
      <p class="text-danger mb-0"> {{ $message }} </p>
      @enderror
    </div>
    <p class="form-message"></p>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-6">
       <textarea id="summernote" name="desc" class="form-control rounded-0 " style="min-height: 100px;" rows="3"></textarea>
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