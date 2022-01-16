@extends('dashboard_layout')

@section('title', 'Home')

<!-- @section('path', (strip_tags($path, '<i>'))) -->
@section('path', '')   
@section('name', 'admin/course')
@section('test', 'List Course')
@section('lcv', 'admin/course/'.$id.'/lesson')
@section('lcvtest', ('>'.$position))
@section('admin_content')


<style>
    .ml_qt {
        margin-left: 242px;
        display: flex;
        align-items: center;
    }
    .item-content {
        cursor: pointer;
    }
    .btn-custom {
        width: 10%;
    }
</style>
<button class="btn btn-warning btn-custom"><a href="{{url('admin/course/'.$id.'/lesson')}}" style="color: white;"><i class="fas fa-undo-alt"></i> back</a></button>
<hr>
    
    <div class="row">
        <div class="col-md-6">
              <form id="" action="{{url('admin/course/'.$id.'/lesson/'. $id_lesson .'/question')}}" method="post" enctype='multipart/form-data'>
              @csrf
              <div id="group_questions">
                  <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question</label>
                        <button type="button" class="btn btn-primary" onclick="addQuestion()" id="addQt"><i class="fas fa-plus"></i> Add</button>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" name="question[]">
                            @error('question')
                                 <p class="text-danger mb-0"> {{ $message }} </p>
                            @enderror
                        </div>
                 </div>
                 <!--  -->
                 <div class="form-group row">
                        <div class="col-sm-6 ml_qt">
                           <i class="fas fa-minus-circle minusQt"></i>
                           <input type="text" class="form-control ml-2" name="question[]">
                        </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-6 ml_qt">
                           <i class="fas fa-minus-circle minusQt"></i>
                           <input type="text" class="form-control ml-2" name="question[]">
                        </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-6 ml_qt">
                           <i class="fas fa-minus-circle minusQt"></i>
                           <input type="text" class="form-control ml-2" name="question[]">
                        </div>
                 </div>
                 <!--  -->
            </div> 
           <div class="form-group row">
                <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                </div>
          </div>
            </form>  
        </div>
        
        <div class="col-md-6">
            @if(Session::has('notify'))
            <p class="alert alert-notify__success"><i class="far fa-check-circle .alert-notify__icon mr-2"></i>{{ Session::get('notify') }}</p>
            @endif
            <form action="{{url('admin/question/update')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question"><i class="fas fa-question"></i></label>
                <input type="text" name="question" class="form-control" style="width: 50%;display: inline-block">
                <input type="hidden" name="questionId">
                <button type="submit" id="btnSubmit" class="btn btn-default mb-1" disabled="disabled" ><i class="fas fa-edit"></i> Edit</button>
            </div>
            </form>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Content</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($listQuestions as $item)
                  <tr>    
                     <td>{{$item->id_question}}</td> 
                     <td data="{{$item->id_question}}" class="item-content">{{$item->content}}</td>                  
                  </tr>
                  @endforeach
              </tbody>
            </table>
        </div>

    </div>
  
    

@endsection

<script>
    
    function addQuestion() {
    
     const qtElement = document.querySelector('#group_questions');

     const divElement = document.createElement('div');

     divElement.classList.add('form-group', 'row');
     var text = `
                <div class="col-sm-6 ml_qt">
                   <i class="fas fa-minus-circle minusQt"></i>
                   <input type="text" class="form-control ml-2" name="question[]">
                </div>`

     divElement.innerHTML = text;
     qtElement.appendChild(divElement);

    }


window.addEventListener('load', function() {
    var nodes = document.getElementsByClassName('minusQt')
    // change state btn edit question
    $('.item-content').click(function() {

        let qtText = this.textContent
        let questionId = this.getAttribute('data')
        $('input[name="question"]').val(qtText)
        $('input[name="questionId"]').val(questionId)

       
        $('#btnSubmit').prop('disabled', false) 
       
    })
     
    $(".minusQt").on("click", function() {
        const node = this.parentNode
        node.parentNode.remove()
    })
})
</script>
