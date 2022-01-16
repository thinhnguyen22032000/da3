@extends('dashboard_layout')

@section('title', 'Home')

@section('admin_content')


 <div class="row">
    @foreach($data as $item)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            
            <div class="{{ $item->style }}">
              <div class="inner">
                <h3>{{ $item->num }}</h3>
                <p>{{ $item->content }}</p>
              </div>
              <div class="icon">
                <i class="{{ $item->icon }}"></i>
              </div>
              <p class="small-box-footer" style="height: 20px;"></p>
            </div>
           
          </div>
     @endforeach
    </div>
         
@endsection