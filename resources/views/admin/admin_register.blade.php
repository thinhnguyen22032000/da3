@if(isset(Auth::user()->id))
  <script>window.location = "admin/dashboard";</script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register User</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;700&display=swap" rel="stylesheet">
  <style>

    body {
         font-family: "Montserrat",Arial,Helvetica,sans-serif;
    }

   
 </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{asset('public/backend')}}/index2.html"><b>Register</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
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
          <input type="number" name="phone" class="form-control" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        @error('phone')
          <p class="text-danger"> {{ $message }} </p>
        @enderror

         <div class="input-group mb-3">
          <span style="margin-right: 5px;color: #bcc2c9;">image</span>
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
          <div class="col-8">
             <a href="{{asset('admin')}}">Login</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('public/backend')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend')}}/dist/js/adminlte.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
