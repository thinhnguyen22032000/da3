
<style>
    .sub_nav {

        display: inherit;
        padding-left: 0;
    }
</style>
<div class="col-sm-6 sub_nav">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/course/'.$id.'/lesson/create')}}">Add lesson</a></li>
              <li class="breadcrumb-item"><a href="{{url('admin/course/'.$id.'/lesson')}}">All lesson</a></li>
            </ol>
            <nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Title lesson..." aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  
</nav>
</div>
