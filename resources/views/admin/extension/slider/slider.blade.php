@extends('dashboard_layout')

@section('title', 'Home')

@section('path', 'Slider List')

@section('admin_content')
<div class="row">
    <div class="col-md-8">
        <p><i class="fas fa-bars"></i> Slider List</p>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Status</th>
              <th scope="col">Order</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($result as $item)
            <tr>
              <th>{{ $item->id_slider }}</th>
              <td>{{ $item->title }}</td>
              <th>{{ $item->author }}</th>
              <td>
                <?php 
                if($item->status == 0) { ?>
                   <div class="btn btn-secondary p-1" >disable</div>
                <?php
                }else{ ?>
                   <div class="btn btn-success p-1">enable</div>
                <?php
                }
                ?> 
              </td>
              <td>{{ $item->order }}</td>
              <td> <a href="{{url('admin/slider/'.$item->id_slider)}}" style="margin-right: 8px;">
                <p class="btn btn-warning p-1"><i class="fas fa-edit text-white"></i></p>
            </a></td>
            </tr>
            @endforeach   
          </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <p><i class="fas fa-plus-circle"></i> Slider</p>
        <form action="{{ url('admin/slider/store') }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="formGroupExampleInput">Slider content</label>
                <input type="text" class="form-control" name="title"  placeholder="Slider content">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Slider author</label>
                <input type="text" class="form-control" name="author"  placeholder="Slider author">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Status</label>
                <select class="form-control" name="status">
                      <option selected>__choose state__</option>
                      <option value="0">Disable</option>
                      <option value="1">Enable</option>
                    </select>
              </div>
               <div class="form-group">
                <label for="formGroupExampleInput2">Order</label>
                <input type="number" class="form-control" name="order"  placeholder="Another input">
              </div>

              <button class="btn btn-primary"><i class="far fa-save"></i> Save</button>
        </form>
    </div>
</div>
@endsection