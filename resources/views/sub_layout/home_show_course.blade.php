<div wire:loading.delay >
<div class="row">
    @if(!$result->isEmpty())
        @foreach($result as $item)
        @if(!in_array($item->id_course, $myIdCourses ))
        <div class="col-lg-4 col-sm-12">
          <div class="card card_costom">
                 <div class="card-fit-img">
                 <a href="{{asset('admin/course_detail/'. $item->id_course)}}">    
                 <img 
                     src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
                     class="card-img-top card-img-height" alt="..."></a>
                 </div>
                 <div class="card-content">
                     <a href="{{asset('admin/course_detail/'. $item->id_course)}}">
                         <h3 class="card-title card-body_title">{{$item->name}}</h3>
                     </a>
                     <i class="far fa-money-bill-alt"><span class="price">: {{$item->price}}$</span></i>
                     <i class="fas fa-users card-body__icon"><span class="member-count">: {{$item->member}}</span></i>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-4 col-sm-12">
          <div class="card card_costom">
                <div class="card_notify">Bought</div>
                
                <div class="card-fit-img">
                 <img 
                 src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
                 class="card-img-top card-img-height" alt="...">
                 </div>
                 <div class="card-content">
                     <a onclick="return false" href="{{asset('admin/course_detail/'. $item->id_course)}}">
                         <h3 class="card-title card-body_title">{{$item->name}}</h3>
                     </a>
                     <i class="far fa-money-bill-alt"><span class="price">: {{$item->price}}$</span></i>
                     <i class="fas fa-users card-body__icon"><span class="member-count">: {{$item->member}}</span></i>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    @else
     <div class="alert alert-notify" role="alert">
        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
         There are currently no courses available
     </div>
    @endif
</div>
</div>