@extends('auth_layout')
@section('title', 'Login')
@section('auth_name', 'Login')
@section('auth_content')

      <p class="login-box-msg">Sign in to start your session</p>
            @if(Session::has('message'))
            <p class="alert alert-notify"><i class="fas fa-exclamation-circle alert-notify__icon"></i>{{ Session::get('message') }}</p>
            @endif
             @if(Session::has('msg'))
            <p class="alert alert-notify"><i class="fas fa-exclamation-circle alert-notify__icon"></i>{{ Session::get('msg') }}</p>
            @endif
      <form action="{{url('admin/auth')}}" method="post">
        @csrf
         <!--================= email===================-->
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
        <div class="row">
              
          <div class="col-7">
             <a href="{{asset('admin/register')}}"><i class="fas fa-registered"></i> Register</a>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-key"></i> Sign In</button>
          </div>
          <a class="ml-2" href="{{asset('admin/forgotpassword')}}"><i class="far fa-question-circle"></i> Forgot password?</a>
          <!-- /.col -->
        </div>
      </form>
@endsection    