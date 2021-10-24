@extends('dashboard_layout');

@section('title', 'dasboard')

@section('path', 'dashboard > course > create')

@section('admin_content')


<form id="" action="{{url('admin/course')}}" method="post" enctype='multipart/form-data'>
@csrf
    
    <div class="row">
        <div class="col-md-8">

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Course category</label>
            <div class="col-sm-6">
               <select name='id_cat' class="form-select" aria-label="Default select example">
                  <option selected>Choose category name</option>
                  @foreach($categoryData as $item)
                  <option value="{{$item->id_cat}}">{{$item->name}}</option>
                  @endforeach
              </select>
              @error('id_cat')
              <p class="text-danger mb-0"> {{ $message }} </p>
              @enderror
            </div>
            <p class="form-message"></p>
          </div>

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
              <input type="text" name="name" class="form-control"  placeholder="Name">
              @error('name')
              <p class="text-danger mb-0"> {{ $message }} </p>
              @enderror
            </div>
            <p class="form-message"></p>
          </div>

          <div class="form-group row">
            <label  class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-4">
              <input type="number" name="price" class="form-control"  placeholder="Price">
               @error('price')
               <p class="text-danger mb-0"> {{ $message }} </p>
               @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-8">
               <textarea id="summernote" name="desc" class="form-control rounded-0" rows="3"></textarea>
               @error('desc')
               <p class="text-danger mb-0"> {{ $message }} </p>
               @enderror
            </div>
          </div>

         </div>
        <div class="col-md-4">
            
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="img">
                    @error('img')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                    @enderror
                </div>
            </div>

           <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Date start</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="date_start">
                  @error('date_start')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                  @enderror
                </div>
           </div>

           <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Step</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="step">
                  @error('step')
                    <p class="text-danger mb-0"> {{ $message }} </p>
                  @enderror
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
       
    
    //  Validator({
    //     form: '#form_create_teacher',
    //     errorSelector: '.error-message',
    //     rules: [
    //         Validator.isRequired('#name'),
    //         // Validator.isEmail('#email'),
    //         // Validator.isMin('#password', 6),
    //         // Validator.isConfirm('#password_confirmation', function(){
    //         //     return document.querySelector('#form-1 #password').value;
    //         // }),
    //     ]
    // });
</script>