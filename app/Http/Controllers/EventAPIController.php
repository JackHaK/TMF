<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventAPIController extends Controller
{
  // constrain the controller to authorised users
  public function __construct()
  {
      //$this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = $request->input('startDate',date("Y-m-d"));
        $endDate = $request->input('endDate',date("2019-12-30"));

        $events = Event::where('expired',false)
          ->wherebetween('startDate', [$startDate, $endDate])
          ->orderBy('startDate','asc')
          ->get();

        $evArray=array();
        foreach ($events as &$event)
        {
          $ev['eventID'] = $event->id;
          $ev['courseTitle'] = $event->course->title;
          $ev['courseDate'] = $event->startDate;
          $ev['courseLength'] = $event->course->length;
          $ev['coursePrice'] = $event->price;
          $ev['courseSummary'] = $event->course->summary;
          $ev['coursePage'] = $event->course->page;
          $ev['courseCategories'] = $event->course->categoriesJSON;
          array_push($evArray,$ev);
        }
        return $evArray;
    }

    public function cpmEvent($id)
    {
      $event = Event::findorfail($id);

      $eventDecode = json_decode($event->administrateEventJSON,true);
/*
1.	Course name
2.	Course date
3.	Course length
4.	Course price
5.	Course summary text
6.	Link to course page
7.	For each course I select which of the 29 segment(s) of the GTA Master List should be able to see that particular course
*/
      $CPM['eventID'] = $event->id;
      $CPM['courseTitle'] = $event->course->title;
      $CPM['courseDate'] = $event->startDate;
      $CPM['courseLength'] = $event->course->length;
      $CPM['coursePrice'] = $event->price;
      $CPM['courseSummary'] = $eventDecode['course']['summary'];
      $CPM['coursePage'] = $event->course->page;
      $CPM['courseCategories'] = $event->course->categoriesJSON;

      return $CPM;
    }

    public function cpmEvents(Request $request)
    {
      $events = Event::where('expired',false)
        ->wherebetween('startDate', [$request->startDate, $request->endDate])
        ->orderBy('startDate','asc')
        ->get();;

      $CPMArray=array();
      foreach ($events as &$event)
      {
        $eventDecode = json_decode($event->administrateEventJSON,true);
        $CPM['eventID'] = $event->id;
        $CPM['courseTitle'] = $event->course->title;
        $CPM['courseDate'] = $event->startDate;
        $CPM['courseLength'] = $event->course->length;
        $CPM['coursePrice'] = $event->price;
        $CPM['courseSummary'] = $eventDecode['course']['summary'];
        $CPM['coursePage'] = $event->course->page;
        $CPM['courseCategories'] = $event->course->categoriesJSON;
        array_push($CPMArray,$CPM);
      }
      return $CPMArray;
    }

}
?>
