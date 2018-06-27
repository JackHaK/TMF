<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delegate;
use App\Event;

class ContactAPIController extends Controller
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

     //collects delegate data and checks to see if the course event is still active
     //returns the list of active courses for this delegate
    public function Courses_On($contactId)
    {
        //
        $delegates = Delegate::where('contactID',$contactId)
          ->orderBy('eventID','asc')
          ->get();

        $evArray =array();
        foreach ($delegates as &$delegate) {
            $expired = $delegate->event->expired;
            if (!$expired){
                $ev['eventID'] = $delegate->event->id;
                $ev['courseTitle'] = $delegate->event->course->title;
                $ev['courseDate'] = $delegate->event->startDate;
                $ev['courseLength'] = $delegate->event->course->length;
                $ev['coursePrice'] = $delegate->event->price;
                $ev['courseSummary'] = $delegate->event->course->summary;
                $ev['coursePage'] = $delegate->event->course->page;
                $ev['courseCategories'] = $delegate->event->course->categoriesJSON;
                array_push($evArray,$ev);
            }
        }
        return $evArray;
    }

    //collects delegate data and checks to see if the course event is still active
    //returns the list of expired courses for this delegate
    public function Courses_Been($contactId)
    {
        //
        $delegates = Delegate::where('contactID',$contactId)
          ->orderBy('eventID','asc')
          ->get();

        $evArray =array();
        foreach ($delegates as &$delegate) {
            $expired = $delegate->event->expired;
            if ($expired){
                $ev['eventID'] = $delegate->event->id;
                $ev['courseTitle'] = $delegate->event->course->title;
                $ev['courseDate'] = $delegate->event->startDate;
                $ev['courseLength'] = $delegate->event->course->length;
                $ev['coursePrice'] = $delegate->event->price;
                $ev['courseSummary'] = $delegate->event->course->summary;
                $ev['coursePage'] = $delegate->event->course->page;
                $ev['courseCategories'] = $delegate->event->course->categoriesJSON;
                array_push($evArray,$ev);
            }
        }
        return $evArray;
    }

}
?>
