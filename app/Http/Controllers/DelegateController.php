<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delegate;
use App\Contact;
use App\Event;
use App\Traits\Booking;

class DelegateController extends Controller
{
    //Traits
        use Booking;
    //

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
    public function index($id)
    {
        //
        $delegates = Delegate::where('eventID',$id)
          ->orderBy('name','asc')
          ->get();
        return view('pages/delegates', [
          'eventID'=>$id,
          'delegates'=>$delegates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($delegateJSON)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Booking($eventId)
    {
        //
        $event = Event::findorfail($eventId);
        $contacts = Contact::where('active',true)
          ->where('name','like','Pete%')
          ->orderBy('name','asc')
          ->get();
        return view('pages/booking', [
            'event'=>$event,
            'contacts'=>$contacts
        ]);
    }

    public function HtmlBooking(Request $request, $eventId)
    {
        $contactId = (int)$request->input('contactSelect');
        $this->CreateDelegate($contactId,$eventId);
    }

    /**
     * Make booking in administrate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CreateDelegate($contactId, $eventId)
    {
        $responce = $this->CreateDeligateBooking($contactId, $eventId);
        return $responce;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($delegateJSON)
    {
      $today = date("Y-m-d");

      $delegateDecode = json_decode($delegateJSON,true);

      $delegate = Delegate::firstorNew(['id'=>$delegateDecode['id']]);
      $delegate->eventID = $delegateDecode['event']['id'];
      $delegate->courseID = $delegateDecode['event']['course_id'];
      $delegate->contactID = $delegateDecode['contact']['id'];
      $delegate->name = $delegateDecode['contact']['first_name'] . " " . $delegateDecode['contact']['last_name'];
      $delegate->email = $delegateDecode['contact']['email'];
      $delegate->administrateDelegateJSON = json_encode($delegateDecode, JSON_PRETTY_PRINT);

      $delegate->save();
    }

    /**
     * select the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        return redirect()->action(
          'DelegateController@show',
          ['delegate' => $request->input('delegateSelect')]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delegate = Delegate::findorfail($id);

        return view('pages/delegate', [
            'delegateID'=>$delegate->id,
            'delegateName'=>$delegate->name,
            'delegateEmail'=>$delegate->email,
            'delegateJSON'=>$delegate->administrateDelegateJSON,
            'eventID'=>$delegate->eventID
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
      $delegate = Delegate::findorfail($id);

      $delegateDecode = json_decode($delegate->delegateJSON,true);

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
        $delegate = Delegate::findorfail($id);

        $delegateDecode = json_decode($delegate->delegateJSON,true);
        $delegate->delegateJSON = json_encode($delegateDecode, JSON_PRETTY_PRINT);
        $delegate->save();
        flash('<strong>Success!</strong> Delegate Updated')->success();
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

}
?>
