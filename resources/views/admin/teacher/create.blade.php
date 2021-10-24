@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > teacher > create')

@section('admin_content')

@if(session('message'))
     <div class="alert alert-primary mt-1 p-1" role="alert">{{ session('message') }}</div>
     @endif
<form id="form_create_teacher" action="{{url('admin/teacher')}}" method="post" enctype='multipart/form-data'>
    @csrf
  <div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-4">
      <input type="text" name="name" class="form-control"  placeholder="Name">
      @error('name')
      <p class="text-danger mb-0"> {{ $message }} </p>
      @enderror
    </div>
    <p class="form-message"></p>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
      <input type="email" name="email" class="form-control"  placeholder="Email">
       @error('email')
       <p class="text-danger mb-0"> {{ $message }} </p>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">phone</label>
    <div class="col-sm-4">
      <input type="text" name="phone" class="form-control" placeholder="phone">
       @error('phone')
       <p class="text-danger mb-0"> {{ $message }} </p>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Gender</label>
    <div class="col-sm-4">
      <select name="gender" class="form-select h-100" aria-label="Default select example">
              <option selected value="0">---Gender---</option>
              <option value="0">Male</option>
              <option value="1">Female</option>         
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-4">
       <textarea name="address" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"></textarea>
        @error('address')
       <p class="text-danger mb-0"> {{ $message }} </p>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-4">
      <input type="file" name="img">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
      <input type="password" name="password" class="form-control" placeholder="Password">
       @error('password')
       <p class="text-danger mb-0"> {{ $message }} </p>
       @enderror
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password again</label>
    <div class="col-sm-4">
      <input type="password" name="passwordAgain" class="form-control" placeholder="Password">
      @error('passwordAgain')
     <p class="text-danger mb-0"> {{ $message }} </p>
     @enderror
     @if(session('errPw'))
     <div class="alert alert-danger mt-1 p-1" role="alert">{{ session('message') }}</div>
     @endif
    </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
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