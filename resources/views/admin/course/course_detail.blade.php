@extends('dashboard_layout')

@section('title', 'Home')
@section('code', 'home')
@section('path', ($position))

@section('admin_content')

<style>
    .detail-course__title {
        font-weight: 700;
    }
    .text-desc {
      color: rgba(0,0,0,.8);
      font-size: 16px;
      /*font-family: "Montserrat",Arial,Helvetica,sans-serif;*/
    }
    .m-text {
        margin-bottom: 0px;
        margin: 10px;
    }
    .detail-course__icon {
        min-width: 30px;
    }
    .list-group-item__content {
        transition: 0.3s all ease;
    }
    .list-group-item__link:hover .list-group-item__content {
      padding-left: 20px;
    }
</style>

<div class="row">
    
    <div class="col-lg-9 col-sm-12">
        @foreach($result as $item)
            <input type="hidden" name="id_course" value="{{$item->id_course}}">
            <h1 class="detail-course__title">{{ $item->name }}</h1>
            <img style="width: 100%" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="img">
            <br>
            <p class="m-text mt-4"><i class="fas fa-book-open detail-course__icon"></i>Current lessons: {{$item->countLesson}}</p>
            <p class="m-text"><i class="fas fa-users detail-course__icon"></i>Member: {{$item->member}}</p>
            <p class="m-text"><i class="fas fa-money-check-alt detail-course__icon"></i>Price: {{$item->price}}$</p>
            <p class="m-text"><i class="fas fa-user-tie detail-course__icon"></i>Author: {{$item->authName}}</p>
            <p class="m-text"><i class="far fa-calendar-alt"></i> Date Start: {{$item->date_start}}</p>
            <a href="" id="show_confirm" class="btn btn-primary mt-2"><i class="fas fa-dollar-sign"></i> Buy now</a>
            <br>
            <hr>
            <h2>Description:</h2>
            <p class="text-left text-desc">{{$item->desc}}</p>
        @endforeach
    </div>

    <div class="col-lg-3">
        <h2>Categories</h2>
        <ul class="list-group list-group-flush">
            @foreach($categoryNames as $category)
           <li class="list-group-item">
               <a class="list-group-item__link" href="{{url('category/'.$category->id_cat)}}">
                 <i class="fas fa-arrow-right text-dark" style="margin-right: 8px"></i> <span class="list-group-item__content">{{$category->name}}</span></a>
           </li>
            @endforeach
        </ul>
    </div>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('#show_confirm').click(function(event) {
          var id_course = $("input[name='id_course']").val()
          event.preventDefault();
          swal({
              title: `Are you sure you want to buy this course?`,
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((confirm) => {
            if (confirm) {

              swal({
              title: `Click ok to see the tutorial`,
              icon: "success",
              
            })
             .then(confirm => {
                 window.location.href = 'http://localhost:88/da3/admin/buy_course_success/'+id_course;
             }) 
            }
          })

      });
  
</script>

@endsection