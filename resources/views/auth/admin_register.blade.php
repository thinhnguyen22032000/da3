@extends('auth_layout')
@section('title', 'Register')
@section('auth_name', 'Register')
@section('auth_content')
      <p class="login-box-msg">Register to start your session</p>
      @if(session('message'))  
          <div class="alert alert-warning" role="alert"> {{ session('message') }} </div>
      @endif
      <form action="{{url('admin/register/auth')}}" method="post" enctype='multipart/form-data'>
        @csrf

         <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('name')
          <p class="text-danger"> {{ $message }} </p>
        @enderror

         <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
          <p class="text-danger"> {{ $message }} </p>
        @enderror
         <!--================= email===================-->
        <div class="input-group mb-3">
          <input type="number" maxlength="10" name="phone"  class="form-control" placeholder="Phone" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        @error('phone')
          <p class="text-danger"> {{ $message }} </p>
        @enderror
           <!--================= phone===================-->
           <div class="input-group mb-3">
          <input type="" name="gender" class="form-control" placeholder="Gender" readonly>
          <select class="form-control" name="gender">
                <option></option>
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
           </select>
          <div class="input-group-append">
            <div class="input-group-text">
            <span class="fas fa-venus-mars"></span>
            </div>
          </div>
        </div>
        @error('gender')
          <p class="text-danger"> {{ $message }} </p>
        @enderror
         <!--================= image===================-->
         <div class="input-group mb-3">
          <span style="margin-right: 5px;color: #999999;">Avatar</span>
          <input type="file" name="img">
        </div>
        <!--================= password===================-->
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
          <p class="text-danger"> {{ $message }} </p>
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="passwordAgain" class="form-control" placeholder="Password again">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('passwordAgain')
          <p class="text-danger"> {{ $message }} </p>
        @enderror
        @if(session('errPw'))  
          <div class="alert alert-warning" role="alert"> {{ session('errPw') }} </div>
        @endif

        <div class="row">
        <div class="col-5">
             <a class="btn btn-primary btn-block" href="{{asset('/')}}">Back</a>
          </div>
          <!-- /.col -->
          
          <div class="col-7">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-registered"></i> Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

@endsection 