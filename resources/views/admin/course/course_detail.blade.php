@extends('dashboard_layout');

@section('title', 'dasboard')

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
    }
    .detail-course__icon {
        min-width: 30px;
    }
</style>

<div class="row">
    
    <div class="col-9">
        @foreach($result as $item)
            <input type="hidden" name="id_course" value="{{$item->id_course}}">
            <h1 class="detail-course__title">{{ $item->name }}</h1>
            <img style="width: 350px" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="img">
            <p class="m-text mt-2"><i class="fas fa-book-open detail-course__icon"></i>lesson num: 20</p>
            <p class="m-text"><i class="fas fa-users detail-course__icon"></i>member: 89</p>
            <p class="m-text"><i class="fas fa-money-check-alt detail-course__icon"></i>price: {{$item->price}}$</p>
            <a href="" id="show_confirm" class="btn btn-primary mt-2">Buy now</a>
            <hr>
            <p class="text-left text-desc">Với CSS, bạn có thể kiểm soát màu sắc, phông chữ, kích thước của văn bản, khoảng cách giữa các phần tử, cách các phần tử được định vị và bố trí, hình ảnh nền hoặc màu nền sẽ được sử dụng, các màn hình khác nhau cho các thiết bị và kích thước màn hình khác nhau, và nhiều hơn nữa!</p>
        @endforeach
    </div>

    <div class="col-3">
        <h3>nomination category</h3>
        <ul class="list-group">
            @foreach($categoryNames as $category)
           <li class="list-group-item">
               <a href="{{url('admin/home/category/'.$category->id_cat)}}">{{$category->name}}</a>
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
              buttons: true,
              dangerMode: true,
            })
             .then(confirm => {
                 window.location.href = 'http://localhost:88/da3/admin/buy_course_success/'+id_course;
             }) 
            }
          })

      });
  
</script>

@endsection