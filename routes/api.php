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

Route::get('courses','CourseAPIController@Courses');

Route::get('courses/search/{searchString}','CourseAPIController@search_by_text');
Route::get('courses/category/{searchString}','CourseAPIController@search_by_category');

Route::get('events','EventAPIController@index');

Route::get('events/{id}/cpm','EventAPIController@CPMEvent');
Route::get('events/cpm','EventAPIController@CPMEvents');
