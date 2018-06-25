<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Storage;

class InflateCoursesController extends Controller
{
  // constrain the controller to authorised users
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

Public function inflateAll()
{
  $env = env('APP_ENV','local');

  if ($env==='local') {
    $result = Storage::disk('local')->get('courses.json');
  } else {
    $result = $this->inflateAllFromAdministrate();
  }

  /* Process the returned JSON string **/
  $AdministrateCourses = json_decode($result,true);

  /* for each course returned from Administrate **/
  foreach ($AdministrateCourses as &$AdministrateCourse)
    {
      /* Create a new course **/
      $course = new CourseController;
      $course->store(json_encode($AdministrateCourse));
    }
  $courses = Course::all()->searchable();
  return response()->json(['Courses Inflated:' => count($courses)]);
}

Public function inflate($courseID)
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/courses/' . $courseID;
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  /* Create a new course **/
  $course = new CourseController;
  $course->store($result);

  flash('<strong>Success!</strong> Course Re-inflated from Administrate')->success();
  return redirect()->back();
}


public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Courses Inflating - Please Wait',
      'endMessage'=>'Courses Inflated successfully',
      'script'=>'scripts/inflateAllCourses'
    ]);
}


Private function inflateAllFromAdministrate()
{
  //
  /* $credentials = '(username):(password)'; **/
  //$credentials = 'Pete@humbleandkind.co.uk:Pete1234';
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/courses';
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  Storage::disk('local')->put('courses.json', $result);
  return $result;
}

}
?>
