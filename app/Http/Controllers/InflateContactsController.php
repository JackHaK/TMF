<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class InflateContactsController extends Controller
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
    $result = Storage::disk('local')->get('contacts.json');
  } else {
    $result = $this->inflateAllFromAdministrate();
  }

  /* Process the returned JSON string **/
  $AdministrateContacts = json_decode($result,true);

  /* for each Contact returned from Administrate **/
  foreach ($AdministrateContacts as &$AdministrateContact)
    {
      /* Create a new Contact **/
      $Contact = new ContactController;
      $Contact->store(json_encode($AdministrateContact));
    }
  // $Contacts = Contact::all()->searchable();
  return response()->json(['Contacts Inflated:' => 0]);
}

Public function inflate($ContactID)
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/crm/contacts/'.$ContactID;
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  /* Create a new Contact **/
  $Contact = new ContactController;
  $Contact->store($result);

  flash('<strong>Success!</strong> Contact Re-inflated from Administrate')->success();
  return response()->json(['Contacts Inflated:' => 0]);
}

public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Contacts Inflating - Please Wait',
      'endMessage'=>'Contacts Inflated successfully',
      'script'=>'scripts/inflateAllContacts'
    ]);
}

Private function inflateAllFromAdministrate()
{
  //
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/crm/contacts';
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

  Storage::disk('local')->put('contacts.json', $result);
  return $result;
}

}
?>
