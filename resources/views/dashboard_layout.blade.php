
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('public/backend/favicon.png')}}" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist/css/adminlte.min.css">
  <!-- toastr -->
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
  <!-- editer form -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/summernote/summernote-bs4.min.css">
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!-- my css -->
  <link rel="stylesheet" href="{{asset('public/backend')}}/dist/css/mycss.css">
  
  @yield('link')
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;700&display=swap" rel="stylesheet">
 <style>

    body {
         font-family: "Montserrat",Arial,Helvetica,sans-serif;
    }

    .image-wrap {
       position: relative;
    }
    .point-online::after {
        content: "";
        background-color: rgba(0, 189, 31, 0.85);
        width: 12px;
        height: 12px;
        font-weight: bold;
        position: absolute;
        top: 27px;
        left: 38px;
        border-radius: 50%;

    }
 </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a> -->
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <!-- <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button> -->
              </div>
            </div>
          </form>
        </div>
      </li>
      <li>
        <a href="{{url('/logout')}}" onclick="return confirm('Are you sure want logout?')">Logout
            <i class="fas fa-sign-out-alt" style="padding: 8px 16px; cursor: pointer;"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php 
        if(Auth::user()->level == 2) { ?>
            <a href="{{asset('/home')}}" class="brand-link">
              <img src="{{asset('public/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">E-learning</span>
            </a>
    <?php
        }else{ ?>
        <a href="{{asset('admin/dashboard')}}" class="brand-link">
          <img src="{{asset('public/backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Manager</span>
        </a>
    <?php
        }
    ?>
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image image-wrap">
          <img src="
          {{asset('public/backend')}}/uploads/img/{{Auth::user()->img}}
          "  class="img-circle elevation-2 point-online" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @if(isset(Auth::user()->name))
               {{Auth::user()->name}}
            @endif
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            if(Auth::user()->level == 0) { ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                   <i class="nav-icon fas fa-user"></i>
                      <p>
                      Teacher Manager
                    <i class="right fas fa-angle-left"></i>
                     </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{url('admin/teacher/create')}}" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Add teacher</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{url('admin/teacher')}}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List teacher</p>
                        </a>
                      </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                   <i class="nav-icon fas fa-cog"></i>
                      <p>
                      System
                    <i class="right fas fa-angle-left"></i>
                     </p>
                </a>
                <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{url('admin/slider')}}" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Sider</p>
                        </a>
                      </li>
                </ul>
            </li>
          <?php
             }
          ?>

          <!-- level == 1 -->
           <?php 
              if(Auth::user()->level == 1) { ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                    Course Manager
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/course/create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/course')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List course</p>
                </a>
              </li>
            </ul>
          </li>

           <!-- -----------------category----------------------------------- -->
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                Category Manager
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/category/create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/category')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List category</p>
                </a>
              </li>
            </ul>
           </li>

            <li class="nav-item">
                <a href="{{url('admin/lab')}}" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                    Submited List
                    </p>
                </a>
            </li>
               
            <?php
              }
           ?>

          
           <!-- level == 2 -->
           <?php 
            if(Auth::user()->level == 2) { ?>
            <li class="nav-item">
                <a href="{{url('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Home</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('home/me/calender')}}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>Calender</p>
                </a>
            </li>
            

           <!-- ------------------mycourse ------------ -->

           @include('sub_layout.list_course')



            <?php
              }
           ?>
           <li class="nav-item">
                <a href="{{url('profile')}}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>Profile</p>
                </a>
            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
           <div class="col-sm-6">
           <a href="http://localhost:88/da3/@yield('code')/">@yield('title')</a><span> ></span>
             <a href="http://localhost:88/da3/@yield('name')/">@yield('test')</a>
             <a href="http://localhost:88/da3/@yield('lcv')/">@yield('lcvtest')</a>@yield('path')
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
       
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card p-4">
              @yield('sub_nav')
              @yield('admin_content')
              </div>
              
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

</body>

<!-- jQuery -->
<script src="{{asset('public/backend')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/backend')}}/dist/js/demo.js"></script>
<script src="{{asset('public/backend')}}/dist/js/helper/validate.js"></script>
<!-- editer form -->
<script src="{{asset('public/backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote(
        {
          height: 150
        }
    );
  })
</script>
<!-- end editer -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@yield('script')
<!-- lazy load -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
