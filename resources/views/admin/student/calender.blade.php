@extends('dashboard_layout');
@section('link')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
@endsection

@section('title', 'Caleder')

@section('path', 'home  > my calender')

@section('admin_content')
<style>
    .calender {
        width: 80%;
       display: inline-block;
    }
</style>

<div class="outer" style="width:80%;">
   <div id="calendar">
   </div>
</div>
   
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    $(document).ready(function() {
    $('#calendar').fullCalendar({
    defaultView: 'week',
    views: {
        week: {
            type: 'basic', /* 'basicWeek' ?? */
            duration: { weeks: 2 }
        }
    },
        events: {

            url: "http://localhost:88/da3/admin/api/v1/calender"
        }
    });

  });
    console.log('DOM fully loaded and parsed');
 });
 
</script>
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
@endsection

@endsection