<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class InflateEventsController extends Controller
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
    $result = Storage::disk('local')->get('events.json');
  } else {
    $result = $this->inflateAllFromAdministrate();
  }

  /* Process the returned JSON string **/
  $AdministrateEvents = json_decode($result,true);

  /* for each Event returned from Administrate **/
  foreach ($AdministrateEvents as &$AdministrateEvent)
    {
      /* Create a new Event **/
      $Event = new EventController;
      $Event->store(json_encode($AdministrateEvent));
    }
  // $Events = Event::all()->searchable();
  return response()->json(['Events Inflated:' => 0]);
}

Public function inflate($EventID)
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/public_events/'.$EventID;
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  /* Create a new Event **/
  $Event = new EventController;
  $Event->store($result);

  flash('<strong>Success!</strong> Event Re-inflated from Administrate')->success();
  return redirect()->back();
}

Public function inflateCourseEvents($courseID)
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/public_events?course_id__eq='.$courseID;
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  /* Process the returned JSON string **/
  $AdministrateEvents = json_decode($result,true);

  /* for each Event returned from Administrate **/
  foreach ($AdministrateEvents as &$AdministrateEvent)
    {
      /* Create a new Event **/
      $Event = new EventController;
      $Event->store(json_encode($AdministrateEvent));
    }

  flash('<strong>Success!</strong> Course Events Re-inflated from Administrate')->success();
  return redirect()->back();
}

public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Events Inflating - Please Wait',
      'endMessage'=>'Events Inflated successfully',
      'script'=>'scripts/inflateAllEvents'
    ]);
}

Private function inflateAllFromAdministrate()
{
  //
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/public_events';
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials),
      'timeout'=>600
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  Storage::disk('local')->put('events.json', $result);
  return $result;
}

}
?>
