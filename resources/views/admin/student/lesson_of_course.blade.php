@extends('dashboard_layout')

@section('title', 'Home')
@section('code', 'home')
@section('name', 'my_course')
@section('path', ('>'.$courseCurrent[0]->name))
@section('test','My Course')
@section('admin_content')

<style>
.wrap-learning {

}
 .lesson-wrap {
    border: 1px solid rgba(0, 0, 0, 0.1);
 }

 .lesson-list {
    max-height: 400px;   
    padding: 8px 16px;
    overflow-y: scroll;
    min-height: 384px;
 }

 .lesson-item__link {
       display: block;
       padding: 8px 16px;
       cursor: pointer;
       border: none;
       background-color: unset;
       color: #000;
       white-space: nowrap;
       width: 100%;
       text-align: left;
       
 }
 .current-forcus {
     background-color: rgba(0, 0, 0, 0.05);;
 }
 .desc-video {
        padding: 8px;
 }
 .desc-video__title {
    font-weight: 700;
 }
 .lock-none {
     margin-left: 23px;
 }
 .icon_lock {
    margin-right: 10px;
 }
 .wrap-homework__desc {
    font-weight: 700;
 }
 .load_submit {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.4);
    z-index: 3000;



 }

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-9">
        <div class="video_render">
                <video id="video" class="col-12" height="400px" controls>
                    <source src="{{asset('public/backend/uploads/video/'.$lessonPlay->video)}}" type="video/mp4">
                </video>
                <div class="desc-video">
                    <h3 class="desc-video__title">{{$lessonPlay->title}}</h3>
                    <p>{{$lessonPlay->desc}}</p> 
                </div>

                <hr>
                <div class="wrap-homework">
                    <p class="wrap-homework__desc">HomeWork: Submit assignments as .pdf files</p>
                    <ol>
                        @foreach($questions as $item)
                        <li>{{$item->content}}</li>
                        @endforeach
                    </ol>
                    @if($lessonPlay->status !== 0)
                    <!-- check submited -->
                    @if($checkLabSubmited->isEmpty())
                    <form method="post" id="upload_form" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" id="id_lesson" value="{{ $lessonPlay->id_lesson }}">
                        <input type="file" id="lab_file" name="lab_file">
                        <button type="submit" class="submit_lab btn btn-primary">send</button>
                    </form>
                    <p id="txt_submit" ></p>
                    @else
                    
                    <div class="alert alert-success" role="alert">
                      Submitted the assignment
                    </div>
                    @endif
                    @endif
                    <div id="alert__success"></div>

                </div>
        </div>    
    </div>

    <div class="col-3">
        <div class="lesson-wrap">
            <ol class="lesson-list">
                 <?php $i=0  ?>
                 @foreach($lessons as $lesson)
                 <button class="lesson-item__link
                    <?php echo $lesson->status!=0?'lock-none':''?>"
                    <?php 
                    echo $lesson->status===0?'titile="plase waiting" disabled="disabled"':''
                    ?> 
    
                    data="{{$lesson->id_lesson}}">
                    <?php echo $lesson->status===0?'<i class="fas fa-lock icon_lock"></i>':''?>
                    {{$lesson->title}}
                 </button>
                 @endforeach
            </ol>
        </div> 
    </div>
</div>
<div class="modal_load">
    <div class="load_submit-spiner"></div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="{{asset('public/backend/dist/js/myjs.js')}}"></script>
<script>
    //forcus video first of course
$(document).ready(function() {

 const firstEle = document.querySelector('.lesson-item__link')
 const checkDis = firstEle.getAttribute('disabled')
 if(checkDis) {
    // $('.submit_lab').setAttribute("disabled", "disabled");
    //var _test = document.querySelector('.submit_lab').setAttribute("disabled", "disabled")
 }else{
   firstEle.classList.add('current-forcus');
 }


})



</script>

<script>
        const loader = document.querySelector('.video_render')
        const lessons = document.querySelectorAll('.lesson-item__link');
        for(const lesson of lessons){
            lesson.onclick = function(e){
                if(lessons) {
                   for(const item of lessons){
                       item.classList.remove('current-forcus')
                   }
                }
  
                e.target.classList.add('current-forcus')
                //console.log(e.target.getAttribute('data'))
                var _csrf = '{{csrf_token()}}'
                var id_lesson = e.target.getAttribute('data')
                var _url = `{{url('admin/my_course/learning/${id_lesson}')}}`
                //console.log(_url)
                $.ajax({

                    url: _url,
                    type: 'POST',
                    data: {
                        _token: _csrf
                    },
                    success:function(data) {
                        $('.video_render').html("");
                        loader.classList.add('loader')
                        setTimeout(()=> {
                           loader.classList.remove('loader')
                           $('.video_render').html(data);
                        }, 1000)
                    }
                })
            }
        }     
</script>
<script>

    
</script>

@endsection