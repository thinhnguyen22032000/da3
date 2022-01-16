@extends('dashboard_layout')

@section('title', 'Home')
@section('path', 'List Course')
@section('name', '')
@section('test', '')
@section('admin_content')
<?php 
     if(isset($_GET['q'])){
        echo '<h4>Search key: '.$_GET['q'].'</h4>';
     }
?>
<p><i class="fas fa-bars"></i> List courses</p>

<form action="{{url('admin/course')}}" id="form-search"  method="GET" style="margin-left: 70%;">
            @csrf
           <input type="text" class="" placeholder="Enter course name..." name="q">
           <button id="btnSearch" class="btn btn-success mb-1"><i class="fas fa-search"></i></button>
           <button class="btn btn-primary mb-1"><a href="{{url('admin/course')}}"><i style="color: white;" class="fas fa-share"></i></a></button>
</form>

<form action="{{url('admin/course/handle_form')}}" id="form-submit-checked" method="POST">
@csrf
<div class="d-flex align-items-center">
        <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="checkbox-all">
              <label class="form-check-label" for="checkbox-all">
                Check all
              </label>
       </div>
       <select class="form-select ml-3" id="select-acrions" name="action" required="">
          <option value="" selected>--Actions--</option>
          <option value="public">public</option>
          <option value="private">private</option>
        </select>
        <button class="btn btn-primary ml-3 p-1" id="publicAllCourses" disabled="disabled">Execute</button>

</div>

<br>
<h5>Total: {{ $numRow }} row</h5>
<table class="table table-hover">
    <thead>
      <tr>
        <th></th>
        <th>ID</th>
        <th>Category</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Code</th>
        <th>Date start</th>
        <th>Step</th>
        <th>Status</th>
        <th >Action</th>
      </tr>
    </thead>
    <tbody>
    @if(!$result->isEmpty())
    @foreach($result as $item)
      <tr>
        <td>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="courseIds[]" value="{{$item->id_course}}">
            </div>
        </td>
        <td>{{$item->id_course}}</td>
        <td>{{$item->categoryName}}</td>
        <td style="width: 200px;">
            <img class="w-25" src="{{asset('public/backend/uploads/img')}}/{{$item->img}}" alt="">
        </td>
        <td>{{$item->name}}</td>
        <td>${{$item->price}}</td>
        <td>{{$item->code}}</td>
        <td>{{ date('d-m-Y',strtotime($item->date_start)) }}</td>
        <td>{{$item->step}}</td>
        <td>
            @if($item->status == 0)
              <span class="badge badge-danger">private</span>
            @else
              <span class="badge badge-success">public</span> 
            @endif
        </td>
        <td >
            <a href="{{url('admin/course/'.$item->id_course.'/edit')}}" style="margin-right: 8px;">
                <p class="btn btn-warning p-1"><i class="fas fa-edit text-white"></i></p>
            </a>
            <a href="{{url('admin/course/'.$item->id_course.'/lesson')}}">
               <p class="btn btn-primary p-1"><i class="far fa-eye"></i></p>
            </a>
        </td>
      </tr>
    @endforeach 
    @else
    <div class="alert alert-notify" role="alert">
        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
         Course not found
     </div>
    @endif
    </tbody>
</table>

<hr>

<div>
   
</div>
</form>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxALl = $('#checkbox-all')
        const courseItemCheckbox = $('input[name="courseIds[]"]')
        const publicAllCourses = $('#publicAllCourses')
        const selectActions = $('#select-acrions')
        const btnSearch = $('#btnSearch')


        checkboxALl.change(function() {
            const isCheckALl =  $(this).prop('checked')
            courseItemCheckbox.prop('checked', isCheckALl)
            checkALlSubmitBtn() 

        })

        courseItemCheckbox.change(function() {
            const isChecked = courseItemCheckbox.length === $('input[name="courseIds[]"]:checked').length
            checkboxALl.prop('checked', isChecked)
             checkALlSubmitBtn() 
        })

        publicAllCourses.click(function(e) {
             e.preventDefault();
             if(selectActions.val() !== '') {
               $('#form-submit-checked').submit();
            }
            

        })

        function checkALlSubmitBtn() {
            var checkedCount = $('input[name="courseIds[]"]:checked').length
            if(checkedCount > 0) {
                publicAllCourses.prop('disabled', false)
            } else{
                publicAllCourses.prop('disabled', true)
            }
        }
        // search course

        btnSearch.click(function() {
            console.log($('#form-search'))
        })


    })
</script> 
@endsection