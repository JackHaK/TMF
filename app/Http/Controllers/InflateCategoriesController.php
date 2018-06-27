<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class InflateCategoriesController extends Controller
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

  /* Process the returned JSON string **/
  $AdministrateCategories = json_decode($result,true);

  /* Create a new refdata **/
  $refdata = new RefDataController;
  $refdata->store('Categories',json_encode($AdministrateCategories));

  flash('<strong>Success!</strong> Categories Re-inflated from Administrate')->success();
  return redirect()->back();
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
=======
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class InflateCategoriesController extends Controller
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

  /* Process the returned JSON string **/
  $AdministrateCategories = json_decode($result,true);

  /* Create a new refdata **/
  $refdata = new RefDataController;
  $refdata->store('Categories',$this->categories($AdministrateCategories));

  flash('<strong>Success!</strong> Categories Re-inflated from Administrate')->success();
  return redirect()->back();
}

public function loadingAll()
{
  return view('pages/longExecute',[
      'startMessage'=>'Categories Inflating - Please Wait',
      'endMessage'=>'Categories Inflated successfully',
      'script'=>'scripts/inflateAllCategories'
    ]);
}

/**
 * Format Categories Helper.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
private function categories($categoriesAdministrate)
{
    //
  $categories = array();
  foreach ($categoriesAdministrate as &$category)
  {
    $subCategories = array();
    if (! empty($category['sub_categories']))
    {
      foreach ($category['sub_categories'] as &$subCategory)
      array_push($subCategories,$subCategory['title']);
    }
    array_push($categories,array("name"=>$category['name'],"subCategories"=>$subCategories));
  }
    return json_encode($categories);
}

}
?>
>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea
