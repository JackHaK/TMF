<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Event;

class CourseAPIController extends Controller
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
<<<<<<< HEAD
    public function courses()
=======
    public function index()
>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea
    {
        //
        $courses = Course::where('active',true)
          ->orderBy('title','asc')
          ->get();
        return $courses;
    }

<<<<<<< HEAD
=======
    // returns specified course
    public function show($id)
    {
        $course = Course::findorfail($id);
        return $course;
    }

>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea
    //searches the courses categories index based on an input string
    public function search_by_category($searchString)
    {
        $courses = Course::search($searchString)
            ->within('GTACourses_Categories')
            ->raw();
        return $courses;
    }

    //searches the courses index for based on an input string
    public function search_by_text($searchString)
    {
        $courses = Course::search($searchString)->raw();
        return $courses;
    }

}
?>
