<?php

use Illuminate\Support\Facades\Route;





Route::group(['prefix' => 'admin'], function(){

     Route::get('register', 'AdminController@getRegister');
     Route::post('register/auth', 'AdminController@checkRegister');

     Route::post('/auth', 'AdminController@checkLogin');

     Route::get('forgotpassword', 'AdminController@forgotPassword');
     Route::post('forgotpassword/auth', 'AdminController@recoverPassword');



     Route::get('/dashboard', 'AdminController@dashboard')->middleware('adminrole')->name('dashboard');
     Route::get('/welcome', 'AdminController@welcome')->middleware('teacherrole')->name('welcome');

     // teach route -------------------

     Route::resource(
        'teacher', 'TeacherController'
     )->middleware('adminrole');

     // Course------------------
     Route::resource(
        'course', 'CourseController'
     )->middleware('teacherrole');
     Route::post('course/handle_form', 'CourseController@handlePublicCourse')->middleware('teacherrole');
     


     //course for student
     Route::get('course_detail/{id}', 'CourseController@courseDetail');
     Route::get('buy_course_success/{id}','CourseController@toturialGetCourse');
    
     Route::post('my_course/check_code/{id}', 'CourseController@checkCodeMyCourse');
    
     Route::post('my_course/learning/{id_lesson}', 'CourseController@getLessonCurrent');

     //category-----------------------------------------------------------------------------------
     Route::resource('category', 'CategoryController')->middleware('teacherrole');
     Route::get('category/{id}/course', 'CategoryController@getCourseByCat')->middleware('teacherrole');
     


     // lab
     Route::get('lab', 'CourseController@courseToggleData')->middleware('teacherrole');
     Route::get('lab/{lesson}/{id}', 'CourseController@showLab')->middleware('teacherrole');
     Route::get('lab/download/file/{file}', 'CourseController@downloadLab')->middleware('teacherrole');



    

     //lesson-------------------------------------------------------------------------------------
     $prefixLesson = 'course/{id}/';
     Route::get(  $prefixLesson.'lesson', 'LessonController@index');
     Route::get(  $prefixLesson.'lesson/create', 'LessonController@create');
     Route::post( $prefixLesson.'lesson', 'LessonController@store');
     Route::get(  $prefixLesson.'lesson/{edit_id}/edit', 'LessonController@edit');
     Route::put(  $prefixLesson.'lesson/{edit_id}', 'LessonController@update');
     Route::get(  'lesson/{edit_id}/status/{stutus}', 'LessonController@updateStatus');

     
     //questions-----------------------------------------------------------------------------------
     Route::get(  $prefixLesson.'lesson/{id_lesson}/question/create', 'LessonController@getAddFromQuestion');
     Route::post( $prefixLesson.'lesson/{id_lesson}/question', 'LessonController@questionCreate');
     Route::post( 'question/update', 'LessonController@questionUpdate');



     //api - calender
     Route::get('api/v1/calender', 'CalenderController@api_calender');
     // api test
     Route::get('api/data/{id?}', 'APIController@index');


     // slider

     Route::get('slider', 'SliderController@index')->middleware('adminrole')->name('slider.manager');
     Route::post('slider/store', 'SliderController@store')->middleware('adminrole');
     Route::get('slider/{id}', 'SliderController@edit')->middleware('adminrole');
     Route::put('slider/{id}', 'SliderController@update')->middleware('adminrole');

     





});

Route::get('update_password', 'AdminController@getUpdatePassword');
Route::post('admin/update_password/auth', 'AdminController@updatePassword');


// site 

Route::get('home/{id?}','HomeController@showCourseL3' )->middleware('studentrole');
// show course by cat
Route::get('category/{id}','HomeController@showCourseByCat' );

// fullcalender--------------------------------------
Route::get('home/me/calender', 'CalenderController@index');

// my course
 Route::get('my_course', 'CourseController@getMyCourse');
 Route::get('my_course/{id}/learning/{id_lesson?}', 'CourseController@getLessonOfCourse');

 Route::post('ajax_upload_lab', 'LessonController@uploadLab')->name('ajax_upload_lab');

 // auth
 Route::get('/', 'AdminController@getLogin')->name('login');
 Route::get('logout', 'AdminController@logout');

 // user
 Route::get('profile', 'HomeController@getProfile');
