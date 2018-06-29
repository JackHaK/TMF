<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delegate;
use App\Event;
use App\Contact;

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
            return "Not a valid route: /api/contact/{$contactId}/events/{$attendType} -
                    Valid options: '/events/attended', '/events/attending' or /events/";
        }
        //initialise array
        $evArray =array();
        //for each delegate record - return the event details.
        foreach ($delegates as &$delegate) {
            $event = $delegate->event;
            $expired = $event->expired;
            if (!$expired&&$attending || $expired&&$attended || $all){
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
        }
        return $evArray;
    }

    public function ContactBooking($contactId,$eventId)
    {
        $contactId = (int)$contactId;
        $eventId = (int)$eventId;
        $credentials = env('ADMINISTRATE_USER','') . ":" . env('ADMINISTRATE_SECRET','');
        $url = env('ADMINISTRATE_URL','') . '/api/v2/event/delegates';
        $data = array("event_id" => $eventId, "notes" => 'Booking made through the Integration Tier', "contact_id" => $contactId);
        $options = array(
          'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header'=>
                  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n" .
                  "Authorization: Basic " . base64_encode($credentials)
          )
        );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      return $result;
    }

}
?>
