<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delegate;
use App\Event;

class DelegateAPIController extends Controller
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
    public function Courses_On($id)
    {
        //
        $delegates = Delegate::where('contactID',$id)
          ->orderBy('eventID','asc')
          ->get();

        $delArray =array();
        foreach ($delegates as &$delegate) {
            $evID = $delegate->eventID;
            $ev = Event::findorfail($evID);

            if ($ev->expired == false) {
                $del['id'] = $delegate->id;
                $del['eventID'] = $delegate->eventID;
                $del['courseID'] = $delegate->courseID;
                $del['contactID'] = $delegate->contactID;
                $del['name'] = $delegate->name;
                $del['email'] = $delegate->email;
                array_push($delArray,$del);
            }
        }
        return $delArray;
    }

    //collects delegate data and checks to see if the course event is still active
    //returns the list of expired courses for this delegate
    public function Courses_Been($id)
    {
        //
        $delegates = Delegate::where('contactID',$id)
          ->orderBy('eventID','asc')
          ->get();

        $delArray =array();
        foreach ($delegates as &$delegate) {
            $evID = $delegate->eventID;
            $ev = Event::findorfail($evID);

            if ($ev->expired == true) {
                $del['id'] = $delegate->id;
                $del['eventID'] = $delegate->eventID;
                $del['courseID'] = $delegate->courseID;
                $del['contactID'] = $delegate->contactID;
                $del['name'] = $delegate->name;
                $del['email'] = $delegate->email;
                array_push($delArray,$del);
            }
        }

        return $delArray;
    }

}
?>
