<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Ref data things
Route::get('refdata/{refdatatype}', 'RefDataAPIController@show');

//Course things
Route::get('courses','CourseAPIController@Courses');
Route::get('courses','CourseAPIController@index');
Route::get('courses/{id}','CourseAPIController@show');
Route::get('courses/search/{searchString}','CourseAPIController@search_by_text');
Route::get('courses/category/{searchString}','CourseAPIController@search_by_category');

//Events things
Route::get('events','EventAPIController@index');
Route::get('events/{id}/cpm','EventAPIController@CPMEvent');
Route::get('events/cpm','EventAPIController@CPMEvents');

//Contact things
Route::get('contact/{contactId}/events/{attendType?}','ContactAPIController@ContactEvents');
Route::post('contact/{contactId}/book','ContactAPIController@JsonBooking');
Route::post('contact/create','ContactAPIController@CreateContact');
