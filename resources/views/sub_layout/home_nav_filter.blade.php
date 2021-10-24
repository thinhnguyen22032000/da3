<div>
    <form action="{{url('admin/home')}}" method="get" class="md-form active-pink active-pink-2 mb-3 mt-0">
          <input class="form-control" name="q" type="text" placeholder="Enter name course ..." aria-label="Search">
    </form>

    <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort"></i>
            courses filter
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{url('admin/home/2')}}">Don't buy</a>
                <a class="dropdown-item" href="{{url('admin/home/1')}}">Bought</a>
                <a class="dropdown-item" href="{{url('admin/home')}}">All</a>
          </div>
    </div>
</div>