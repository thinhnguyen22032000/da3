@extends('auth_layout')
@section('title', 'forgot password')
@section('auth_name', 'forgot password')
@section('auth_content')
      <p class="login-box-msg"><i class="far fa-question-circle"></i> Enter new password</p>
      @if(Session::has('msg'))
            <p class="alert alert-notify"><i class="fas fa-exclamation-circle alert-notify__icon"></i>{{ Session::get('msg') }}</p>
            @endif
      <form action="{{url('admin/update_password/auth')}}" method="post">
        @csrf
         
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Enter new password">
          <input type="hidden" name="email" class="form-control" value="<?php echo $_GET['email'] ?>" >
          <input type="hidden" name="token" class="form-control" value="<?php echo $_GET['token'] ?>">
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
             <a href="{{asset('admin/register')}}">Register</a>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block"><i class="far fa-check-circle"></i> Confirm</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
@endsection 
