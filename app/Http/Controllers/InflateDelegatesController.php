<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class InflateDelegatesController extends Controller
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

  if ($env ==='local') {
    $result = Storage::disk('local')->get('delegates.json');
  } else {
    $result = $this->inflateAllFromAdministrate();
  }

  /* Process the returned JSON string **/
  $AdministrateDelegates = json_decode($result,true);

  /* for each delegate returned from Administrate **/
  foreach ($AdministrateDelegates as &$AdministrateDelegate)
    {
      /* Create a new delegate **/
      $delegate = new DelegateController;
      $delegate->store(json_encode($AdministrateDelegate));
    }
  // $delegates = delegate::all()->searchable();
  return response()->json(['delegates Inflated:' => 0]);
}

Public function inflate($eventID)
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/delegates?event_id__eq='.$eventID;
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
  $AdministrateDelegates = json_decode($result,true);

  /* for each delegate returned from Administrate **/
  foreach ($AdministrateDelegates as &$AdministrateDelegate)
    {
      /* Create a new delegate **/
      $delegate = new DelegateController;
      $delegate->store(json_encode($AdministrateDelegate));
    }

  flash('<strong>Success!</strong> Delegates for Event:'.$eventID.' Re-inflated from Administrate')->success();
  return redirect()->back();
}

public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Delegates Inflating - Please Wait',
      'endMessage'=>'Delegates Inflated successfully',
      'script'=>'scripts/inflateAllDelegates'
    ]);
}

Private function inflateAllFromAdministrate()
{
  //
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/delegates';
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

  Storage::disk('local')->put('delegates.json', $result);
  return $result;
}

}
?>
