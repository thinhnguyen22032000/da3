@extends('dashboard_layout')

@section('title', 'dasboard')

@section('path', 'dashboard > course > lesson > question > create')

@section('admin_content')

@include('sub_layout.sub_nav_lesson')
<style>
    .ml_qt {
        margin-left: 134px;
    }
</style>
<hr>
<form id="" action="{{url('admin/course/'.$id.'/lesson/'. $id_lesson .'/question')}}" method="post" enctype='multipart/form-data'>
@csrf
    
    <div class="row">
        <div class="col-md-8">

          <div id="group_questions">

              <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Question</label>
                    <button type="button" class="btn btn-primary" onclick="addQuestion()">Add question</button>
                    <div class="col-sm-6">
                       <input type="text" class="form-control" name="question[]">
                        @error('question')
                             <p class="text-danger mb-0"> {{ $message }} </p>
                         @enderror
                    </div>
             </div>
             <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Question</label>
                    <div class="col-sm-6 ml_qt">
                       <input type="text" class="form-control" name="question[]">
                    </div>
             </div>
        </div>
           
           
        </div>
    </div>
  
    
     <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
@endsection
<script>
       
   function addQuestion() {
    
     const qtElement = document.querySelector('#group_questions');

     const divElement = document.createElement('div');
     divElement.classList.add('form-group', 'row');
     var text = `<label class="col-sm-3 col-form-label">Question</label><div class="col-sm-6"><input type="text" name="question[]" class="form-control ml_qt"></div>`

     divElement.innerHTML = text;
     qtElement.appendChild(divElement);
   }


 
</script>