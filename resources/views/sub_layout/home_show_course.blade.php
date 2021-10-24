<div class="row">
    @foreach($result as $item)
    @if(!in_array($item->id_course, $myIdCourses ))
    <div class="col-4">
      <div class="card card_costom">
             <div class="card-fit-img">
                 <img 
                 src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
                 class="card-img-top card-img-height" alt="...">
             </div>
             <div class="card-content">
                 <a href="{{asset('admin/course_detail/'. $item->id_course)}}">
                     <h3 class="card-title card-body_title">{{$item->name}}</h3>
                 </a>
                 <i class="fas fa-users card-body__icon"><span class="member-count">: {{$item->member}}</span></i>
            </div>
        </div>
    </div>
    @else
    <div class="col-4">
      <div class="card card_costom">
            <div class="card_notify">bought</div>
            <div class="card-fit-img">
             <img 
             src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
             class="card-img-top card-img-height" alt="...">
             </div>
             <div class="card-content">
                 <a onclick="return false" href="{{asset('admin/course_detail/'. $item->id_course)}}">
                     <h3 class="card-title card-body_title">{{$item->name}}</h3>
                 </a>
                 <i class="fas fa-users card-body__icon"><span class="member-count">: {{$item->member}}</span></i>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>