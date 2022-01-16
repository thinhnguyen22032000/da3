@extends('dashboard_layout')

@section('title', 'Home')
@section('path', ' > Edit Lesson')
@section('name', 'admin/course')
@section('test', 'List Course')
@section('lcv', 'admin/course/'.$id.'/lesson')
@section('lcvtest', ('>'.$position))
@section('admin_content')
<p><i class="fas fa-bars"></i> Edit lesson</p>
@include('sub_layout.sub_nav_lesson')

@foreach($result as $item) 
<form id="" action="{{url('admin/course/'.$id.'/lesson/'.$id_lesson)}}" method="post" enctype='multipart/form-data'>
@csrf
{{ method_field('PUT') }} 

    <div class="row">
        <div class="col-md-8">

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-6">

              <input type="text" value="{{$item->title}}"  name="title" class="form-control"  placeholder="Title">
              
              @error('title')
              <p class="text-danger mb-0"> {{ $message }} </p>
              @enderror
            </div>
            <p class="form-message"></p>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-8">
               <textarea id="summernote" name="desc" class="form-control rounded-0" rows="3">
                 {{$item->desc}}
               </textarea>
               @error('desc')
               <p class="text-danger mb-0"> {{ $message }} </p>
               @enderror
            </div>
          </div>
           
        </div>
        <div class="col-md-4">
            
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">Video</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="video">
                    @error('video')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
              <video id="video" width="320" height="240" controls>
                   <source src="{{asset('public/backend/uploads/video')}}/{{$item->video}}" type="video/mp4">
              </video>

        </div>
    </div>
  
    
     <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
    </div>
  </div>
</form>
@endforeach
@endsection


<script>
       
   function addQuestion() {
    
     const qtElement = document.querySelector('#group_questions');

     const divElement = document.createElement('div');
     divElement.classList.add('form-group', 'row');
     var text = `<label class="col-sm-3 col-form-label">Question</label><div class="col-sm-4"><input type="text" name="question[]" class="form-control ml_qt"></div>`

     divElement.innerHTML = text;
     qtElement.appendChild(divElement);
   }


 
</script>