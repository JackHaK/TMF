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
    public function index()
    {
        //
        $events = Event::where('expired',false)
          ->orderBy('startDate','asc')
          ->get();
        return $events;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($EventJSON)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($eventJSON)
    {
      $today = date("Y-m-d");

      $eventDecode = json_decode($eventJSON,true);

      $event = Event::firstorNew(['id'=>$eventDecode['id']]);
      $event->course_id = $eventDecode['course_id'];
      $event->startDate = $eventDecode['start_date'];
      $event->endDate = $eventDecode['end_date'];
      if (! empty($eventDecode['prices'])) {
        $event->price = $eventDecode['prices'][0]['price'];
      }
      if ($event->startDate < $today) {
        $event->expired = true;
      } else {
        $event->expired = false;
      }
      $event->administrateEventJSON = json_encode($eventDecode, JSON_PRETTY_PRINT);

      $event->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findorfail($id);

        return $event;

    }

    /**
     * Return JSON for Campaign Monitor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $Event = Event::findorfail($id);

        $EventDecode = json_decode($Event->EventJSON,true);
        $Event->EventJSON = json_encode($EventDecode, JSON_PRETTY_PRINT);
        $Event->save();
        flash('<strong>Success!</strong> Event Updated')->success();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($searchString)
    {
        //
        $Events = Event::search($searchString)->raw();
        return $Events;
    }
}
?>
