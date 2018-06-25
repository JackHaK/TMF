<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class APIController extends Controller
{
  // constrain the controller to authorised users
  public function __construct()
  {
    // $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courses()
    {
        //
        $courses = Course::where('active',true)
          ->orderBy('title','asc')
          ->get();
        return $courses;
    }

}
?>
