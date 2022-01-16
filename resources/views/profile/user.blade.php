@extends('dashboard_layout')

@section('title', 'Home')
@section('name', '')
@section('path','Profile')
@section('test','')
@section('admin_content')

<style type="text/css">
     .inf-content{
        border:1px solid #DDDDDD;
        -webkit-border-radius:10px;
        -moz-border-radius:10px;
        border-radius:10px;
        box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
    }
</style>
<p class="font-weight-bold"><i class="fas fa-bars"></i> Profile</p>
<div class="container bootstrap snippets bootdey">
<div class="panel-body inf-content">
    <div class="row">
        <div class="col-md-4">
            <img alt="" style="width:600px;" title="" class="img-circle img-thumbnail isTooltip"
             src="{{asset('public/backend/uploads/img/'.$userProfile->img)}}" data-original-title="Usuario"> 
            <ul title="Ratings" class="list-inline ratings text-center">
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-star"></span></a></li>
            </ul>
        </div>
        <div class="col-md-6">
            <strong>Information</strong><br>
            <div class="table-responsive">
            <table class="table table-user-information">
                <tbody>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                Identificacion                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            E-{{$userProfile->id}}     
                        </td>
                    </tr>
                    <tr>    
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                Name                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            {{$userProfile->name}}    
                        </td>
                    </tr>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-cloud text-primary"></span>  
                                Mail                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            {{$userProfile->email}}  
                        </td>
                    </tr>

                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                Gender                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            {{$userProfile->gender == 1? 'Male':'Female'}} 
                        </td>
                    </tr>


                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-eye-open text-primary"></span> 
                                Phone                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            {{$userProfile->phone}}
                        </td>
                    </tr>
                    <?php
                    if ($userProfile->level == 1){?>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-envelope text-primary"></span> 
                                Address                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                            {{$userProfile->address}}  
                        </td>
                    </tr>
                    <?php }?>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-calendar text-primary"></span>
                                Created                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                           {{$userProfile->created_at}}
                        </td>
                    </tr>
                    <?php
                    if ($userProfile->level == 1){?>
                    <tr>        
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-calendar text-primary"></span>
                                Modified                                                
                            </strong>
                        </td>
                        <td class="text-primary">
                             {{$userProfile->updated_at}}
                        </td>
                    </tr> 
                    <?php }?>                                   
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>            

@endsection