@extends('dashboard_layout')

@section('title', 'Home')
@section('name', 'my_course')
@section('path','My Course')
@section('test','')
@section('admin_content')
<style>
    .sliders {
        background-color: #eee;
    }
    .slider-item {
            color: #333;
            padding: 10px;
            margin: 0;
    }
    .slider-wrap {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
    }
    .slider-title {
        background: #4c4747;
        color: #fff;
        padding: 10px;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>

<div class="carousel slide slider-wrap" data-ride="carousel">
      <div class="slider-title">Notify</div>
      <div class="carousel-inner sliders">
        <?php $i = 0; 
        ?>
        
        @foreach( $sliders as $item )
        <?php
               $i++; 
               if($item->status == 1) { ?>
                <div class="carousel-item {{ $i==1?'active':'' }}">
                  <p class="slider-item">"{{ $item->title }}." <span>{{ $item->author }}</span></p>
                </div>
        <?php         
            }
        ?>
        @endforeach
      </div>
</div>
<p><i class="fas fa-bars"></i> My courses</p>
<div class="row">
    @if($result->isEmpty())
       <h4 class="text-green">You have not purchased any courses yet</h4><a href="./home">Buy now</a>
       <img src="{{asset('public/backend/dist/img/learn1.png')}}" alt="">
    @else
    @foreach($result as $item)
    <div class="col-lg-4 col-sm-12">
      <div class="card card_costom">
             <div class="card-fit-img">
             <img 
             src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" 
             class="card-img-top card-img-height" alt="...">
             </div>
             <div class="card-content">
                 
                 <h3 class="card-title card-body_title">{{$item->name}}</h3>
                 
                 <!-- == o la chua nhap code -->
                 @if($item->code_confirm != 0)
                 <div class="progress mb-1">
                  <div class="progress-bar bg-success" role="progressbar" style="width:<?php echo $item->countLabSubmited.'%'  ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$item->countLabSubmited}}%</div>
                </div>
                 <a href="{{url('my_course/'.$item->id_course.'/learning')}}" class="btn btn-primary btn-learn">learn now</a>
                 @else
                 <form action="{{url('admin/my_course/check_code/'.$item->id_course)}}" method="post" class="mt-2">
                 @csrf
                     <input class="form-control" style="width: 50%; display: inline-block;" type="text" name="code" placeholder="code...">
                     <button class="btn btn-secondary mb-1" type="submit">confirm</button>
                 </form>
                 @endif
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
<script>
   
  
 
</script>

@endsection