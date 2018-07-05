<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Event;
use Storage;

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
    public function index()
    {
        //
        $courses = Course::where('active',true)
          ->orderBy('title','asc')
          ->get();
        return $courses;
    }

    //searches the courses categories index based on an input string
    public function search_by_category($searchString)
    {
        $courses = Course::search($searchString)
            ->within('GTACourses_Categories')
            ->raw();
        return $courses;
    }

    public function show($id)
    {
        $course = Course::findorfail($id);
        return $course;
    }

    //searches the courses index for based on an input string
    public function search_by_text($searchString)
    {
        $courses = Course::search($searchString)->raw();
        return $courses;
    }

    public function CourseAttachments($id)
    {
        $courses = Course::where('id',$id)
            ->get();

        $array = array();
        foreach ($courses as &$course) {

            $ar['id'] = $course->id;
            $ar['title'] = $course->title;
            $ar['summary'] = $course->summary;
            $ar['attachments'] = Storage::files("attachments/courses/" . $course->id);

            array_push($array,$ar);
        }
        $theReturn['courses']=$array;
        return $theReturn;
    }

}
?>
