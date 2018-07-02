<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FormatCategories;
use Storage;

class InflateCategoriesController extends Controller
{
    //Traits
    use FormatCategories;

  // constrain the controller to authorised users
  public function __construct()
  {
  //    $this->middleware('auth');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

Public function inflateAll()
{
  /* $credentials = '(username):(password)'; **/
  $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
  $url = env('ADMINISTRATE_URL','') . '/api/v2/event/categories';
  $options = array(
    'http' => array(
      'method'  => 'GET',
      'header'=>  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  /* Create a new refdata **/
  $refdata = new RefDataController;
  $refdata->store('Categories',$this->FormatCategories($result));
  // $refdata->store('Categories',$result);

  flash('<strong>Success!</strong> Categories Re-inflated from Administrate')->success();
  return "true"; //redirect()->back();
}

public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Categories Inflating - Please Wait',
      'endMessage'=>'Categories Inflated successfully',
      'script'=>'scripts/inflateAllCategories'
    ]);
}


}
?>
