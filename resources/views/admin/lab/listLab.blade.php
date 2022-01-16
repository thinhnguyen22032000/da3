@extends('dashboard_layout')

@section('title', 'Home')
@section('name','admin/lab')
@section('test','Submited List')
@section('path','> Lab list: '.$lessonTitle )

@section('admin_content')



<p class="font-weight-bold"><i class="fas fa-bars"></i> Lab list: {{$lessonTitle}}</p>

 <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">User name</th>
                  <th scope="col">File</th>
                  <th scope="col">Submit at</th>
                  <th scope="col">Active</th>

                </tr>
              </thead>
              <tbody>
                  @if(!$data->isEmpty())
                  @foreach($data as $item)
                  <tr>    
                     <td>{{$item->student[0]->name}}</td> 
                     <td>{{$item->lab_file}}</td>                  
                     <td>{{$item->created_at}}</td>                  
                     <td>
                         <button class="btn btn-secondary"><a style="color: #fff !important;" href="{{url('admin/lab/download/file/'.$item->lab_file)}}">download</a></button>
                     </td>                  
                  </tr>
                  @endforeach
                  @else
                     <div class="alert alert-notify" role="alert">
                        <i class="fas fa-exclamation-circle alert-notify__icon"></i>
                         You don't have any labs yet
                    </div>
                  @endif
              </tbody>
            </table>



@endsection

