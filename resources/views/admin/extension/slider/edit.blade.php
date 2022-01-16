@extends('dashboard_layout')

@section('title', 'Home')

@section('path', '> Edit Slider')
@section('name', 'admin/slider')
@section('test', 'Slider List')
@section('admin_content')
<p><i class="fas fa-bars"></i> Edit Slider</p>
<a href="{{url('/admin/slider')}}" class="btn btn-primary btn-icon mb-2"><i class="fas fa-redo"></i></a>
<div class="row">
    <div class="col-md-5">
        <form action="{{ url('admin/slider/'.$result->id_slider ) }}" method="post">
            @csrf
            {{ method_field('PUT') }}  
              <div class="form-group">
                <label for="formGroupExampleInput">Slider content</label>
                <input type="text" class="form-control" name="title" value="{{ $result->title }}"  placeholder="Slider content">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Slider author</label>
                <input type="text" class="form-control" name="author" value="{{ $result->author }}"  placeholder="Slider content">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Status</label>
                <select class="form-control" name="status">
                      <option>__choose state__</option>
                      <?php 
                            if($result->status == 0) { ?>
                               <option selected value="0">Disable</option>
                               <option value="1">Enable</option>
                      <?php
                            }else { ?>
                               <option value="0">Disable</option>
                               <option selected value="1">Enable</option>
                      <?php
                            }

                      ?>
                    </select>
              </div>
               <div class="form-group">
                <label for="formGroupExampleInput2">Order</label>
                <input type="number" class="form-control" name="order" value="{{ $result->order }}"  placeholder="Another input">
              </div>

              <button class="btn btn-primary"><i class="far fa-save"></i> Save</button>
        </form>
    </div>
</div>
@endsection