@extends('auth_layout')
@section('title', 'Forgot Password')
@section('auth_name', 'Forgot Password')
@section('auth_content')
      <p class="login-box-msg">Please enter your Email correctly to recover your Password</p>
      @if(Session::has('msg'))
            <p class="alert alert-notify"><i class="fas fa-exclamation-circle alert-notify__icon"></i>{{ Session::get('msg') }}</p>
            @endif
      <form action="{{url('admin/forgotpassword/auth')}}" method="post">
        @csrf
         <!--================= email===================<i class="fas fa-exclamation-circle"></i>-->
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
        
        <div class="row">
        <div class="col-5">
             <a class="btn btn-primary btn-block" href="{{asset('/')}}">Back</a>
          </div>
          <!-- /.col -->
          <div class="col-7">
            <button type="submit" class="btn btn-primary btn-block"><i class="far fa-check-circle"></i> Confirm</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
@endsection 
