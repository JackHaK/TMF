<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
  // constrain the controller to authorised users
  public function __construct()
  {
      $this->middleware('auth');
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
        return view('pages/activeCourses', [
            'courses'=>$courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($courseJSON)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($courseJSON)
    {
        //
        $courseDecode = json_decode($courseJSON,true);

        $course = Course::firstorNew(['id'=>$courseDecode['id']]);

        $course->title = $courseDecode['title'];
        $course->summary = $courseDecode['summary'];
        $course->length = json_encode($courseDecode['course_text_7']);
        if (! empty($courseDecode['prices']))
          {
            $course->price = $courseDecode['prices'][0]['price'];
          }
        $course->page = strtolower(str_replace(' ', '-', 'https://www.gta.gg/course/'.$courseDecode['title']));
        $course->administrateCourseJSON = json_encode($courseDecode, JSON_PRETTY_PRINT);
        $course->categoriesJSON = $this->categories($courseDecode['categories']);
        $course->courseJSON = json_encode($courseDecode, JSON_PRETTY_PRINT);
        $course->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findorfail($id);

        return view('pages/course', [
            'courseID'=>$course->id,
            'courseTitle'=>$course->title,
            'courseLength'=>$course->length,
            'coursePrice'=>$course->price,
            'courseCategories'=>$course->categoriesJSON,
            'courseJSON'=>$course->courseJSON
          ]);
    }

    /**
     * Display a listing of the Events for the course.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEvents($id)
    {
      //
      $course = Course::findorfail($id);

      return view('pages/events', [
                  'courseID'=>$course->id,
                  'events'=>$course->events,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $course = Course::findorfail($id);

      $courseDecode = json_decode($course->courseJSON,true);


      return view('pages/updateCourse', [
        'courseID'=>$course->id,
        'courseTitle'=>$course->title,
        'courseSummary'=>$course->summary,
        'courseTopics'=>$courseDecode['topics'],
        'courseMethod'=>$courseDecode['method'],
        'courseBenefits'=>$courseDecode['benefits'],
        'coursePage'=>$course->page,
        'courseCategories'=>$course->categoriesJSON,
        'courseJSON'=>json_encode($courseDecode, JSON_PRETTY_PRINT),

        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //return $request;
        $course = Course::findorfail($id);

        $courseDecode = json_decode($course->courseJSON,true);
        $course->title = $request->input('courseTitle');
        $course->summary = $request->input('courseSummary');
        $courseDecode['title'] = $request->input('courseTitle');
        $courseDecode['summary'] = $request->input('courseSummary');
        $courseDecode['topics'] = $request->input('courseTopics');
        $courseDecode['method'] = $request->input('courseMethod');
        $courseDecode['benefits'] = $request->input('courseBenefits');
        $course->page = $request->input('coursePage');
        $course->categoriesJSON = $request->input('courseCategories');
        $course->courseJSON = json_encode($courseDecode, JSON_PRETTY_PRINT);
        $course->save();
        flash('<strong>Success!</strong> Course Updated')->success();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search the courses for the given string.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($searchString)
    {
        //
        $courses = Course::search($searchString)->raw();
        return $courses;
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
