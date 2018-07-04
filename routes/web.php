<?php

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

Route::get('/', function () {
    return view('pages.home');
});

Route::get('refdata/categories/inflate','InflateCategoriesController@loadingAll');
Route::get('refdata/categories/inflateAll','InflateCategoriesController@inflateAll');
Route::get('refdata/{refdatatype}', 'RefDataController@show');

Route::get('courses/inflate','InflateCoursesController@loadingAll');
Route::get('courses/inflateAll','InflateCoursesController@inflateAll');
Route::get('courses/search/{searchString}','CourseController@search');

Route::resource('courses', 'CourseController');

Route::get('courses/{id}/inflate','InflateCoursesController@inflate');
Route::get('courses/{id}/local','CourseController@showLocal');
Route::get('courses/{id}/administrate','CourseController@showAdministrate');
Route::get('courses/{id}/events','CourseController@showEvents');
Route::get('courses/{id}/events/inflate','InflateEventsController@inflateCourseEvents');
Route::get('courses/{id}/attachments','CourseAttachmentController@index');
Route::post('courses/{id}/attachments/upload','CourseAttachmentController@create');
Route::get('courses/{id}/attachments/delete/{file}','CourseAttachmentController@destroy');

Route::get('events/inflate','InflateEventsController@loadingAll');
Route::get('events/inflateAll','InflateEventsController@inflateAll');
Route::post('events/select','EventController@select');
Route::get('events/{id}/inflate','InflateEventsController@inflate');
Route::get('events/{id}/delegates', 'DelegateController@index');
Route::get('events/{id}/delegates/inflate','InflateDelegatesController@inflate');
Route::get('events/{id}/booking','DelegateController@Booking');
Route::post('events/{id}/createBooking','DelegateController@HtmlBooking');
Route::get('events/{id}/cpm','EventController@CPMEvent');
Route::get('events/cpm','EventController@CPMEvents');

Route::resource('events', 'EventController');

Route::get('contacts/inflate','InflateContactsController@loadingAll');
Route::get('contacts/inflateAll','InflateContactsController@inflateAll');
Route::get('contacts/{id}/inflate','InflateContactsController@inflate');
Route::post('contacts/select','ContactController@select');

Route::resource('contacts', 'ContactController');

Route::get('delegates/select','DelegateController@select');
Route::resource('delegates', 'DelegateController');

Route::get('welcome', function () {
    return view('welcome');
});


/*
Route::get('/courses/{id}/show',['as' => 'courses.show', 'uses' => 'CourseController@show']);
Route::get('/courses/{id}/edit',['as' => 'courses.edit', 'uses' => 'CourseController@edit']);
Route::post('/courses/{id}/update',['as' => 'courses.update', 'uses' => 'CourseController@update']);
*/

Auth::routes();
