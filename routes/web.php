<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => 'admin'], function(){

     Route::get('register', 'AdminController@getRegister');
     Route::post('register/auth', 'AdminController@checkRegister');
     Route::get('/', 'AdminController@getLogin');
     Route::post('/auth', 'AdminController@checkLogin');
     Route::get('logout', 'AdminController@logout');

     Route::get('/dashboard', 'AdminController@dashboard')->middleware('checklogin');

     // teach route -------------------

     Route::resource(
        'teacher', 'TeacherController'
     )->middleware('adminrole');

     // Course------------------
     Route::resource(
        'course', 'CourseController'
     )->middleware('teacherrole');
     Route::post('course/handle_form', 'CourseController@handlePublicCourse');

     //course for student
     Route::get('course_detail/{id}', 'CourseController@courseDetail');
     Route::get('buy_course_success/{id}','CourseController@toturialGetCourse');
     Route::get('my_course', 'CourseController@getMyCourse');
     Route::post('my_course/check_code/{id}', 'CourseController@checkCodeMyCourse');
     Route::get('my_course/{id}/learning/{id_lesson?}', 'CourseController@getLessonOfCourse');
     Route::post('my_course/learning/{id_lesson}', 'CourseController@getLessonCurrent');

     //category-----------------------------------------------------------------------------------
     Route::resource('category', 'CategoryController')->middleware('teacherrole');
     
     Route::get('home/{id?}','HomeController@showCourseL3' );
     Route::get('home/category/{id}','HomeController@showCourseByCat' );

     // fullcalender--------------------------------------
     Route::get('home/me/calender', 'CalenderController@index');

     //lesson-------------------------------------------------------------------------------------
     $prefixLesson = 'course/{id}/';
     Route::get(  $prefixLesson.'lesson', 'LessonController@index');
     Route::get(  $prefixLesson.'lesson/create', 'LessonController@create');
     Route::post( $prefixLesson.'lesson', 'LessonController@store');
     Route::get(  $prefixLesson.'lesson/{edit_id}/edit', 'LessonController@edit');
     Route::put(  $prefixLesson.'lesson/{edit_id}', 'LessonController@update');

     Route::post('ajax_upload_lab', 'LessonController@uploadLab')->name('ajax_upload_lab');
     
     //questions-----------------------------------------------------------------------------------
     Route::get(  $prefixLesson.'lesson/{id_lesson}/question/create', 'LessonController@getAddFromQuestion');
     Route::post( $prefixLesson.'lesson/{id_lesson}/question', 'LessonController@questionCreate');


     //api - calender
     Route::get('api/v1/calender', 'CalenderController@api_calender');
     // api test
     Route::get('api/data/{id?}', 'APIController@index');




});

