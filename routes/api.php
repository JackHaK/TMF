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

Route::get('courses','APIController@Courses');
Route::get('api/courses/search/{searchString}','APIController@Search')

Route::get('events/{id}/cpm','EventAPIController@CPMEvent');
Route::get('events/cpm','EventAPIController@CPMEvents');
