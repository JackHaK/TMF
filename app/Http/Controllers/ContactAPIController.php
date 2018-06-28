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
     //returns the list of courses for this delegate given perameters
    public function ContactEvents($contactId,$attendType = NULL)
    {
        //retrieve delegate records
        $delegates = Delegate::where('contactID',$contactId)
          ->orderBy('eventID','asc')
          ->get();

        //initialise boolians
        $attended = false;
        $attending = false;
        $all = false;
        //switch the optional variable $attendType
        switch ($attendType) {
        case "attended": //if $attendType = attended
            $attended = true;
            break;
        case "attending": //if $attendType = attending
            $attending = true;
            break;
        case NULL: //if $attendType is left blank
            $all = true;
            break;
        default: //if anything other than above three options
            return "Not a valid route: /api/contact/{$contactId}/events/{$attendType} - Valid options: '/events/attended', '/events/attending' or /events/";
        }
        //initialise array

        $evArray =array();
        //for each delegate record - return the event details.
        foreach ($delegates as &$delegate) {
            $expired = $delegate->event->expired;
            if (!$expired&&$attending || $expired&&$attended || $all){
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
