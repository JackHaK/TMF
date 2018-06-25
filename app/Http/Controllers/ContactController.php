<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
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
        $contacts = Contact::where('active',true)
          ->orderBy('name','asc')
          ->get();
        return view('pages/contacts', [
            'contacts'=>$contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ContactJSON)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($contactJSON)
    {
      $today = date("Y-m-d");

      $contactDecode = json_decode($contactJSON,true);

      $contact = Contact::firstorNew(['id'=>$contactDecode['id']]);
      $contact->name = $contactDecode['first_name'] . " " . $contactDecode['last_name'];
      $contact->email = $contactDecode['email'];
      if ($contactDecode['is_deleted'] or $contactDecode['dormant']) {
        $contact->active = false;
      } else {
        $contact->active = true;
      }
      $contact->administrateContactJSON = json_encode($contactDecode, JSON_PRETTY_PRINT);

      $contact->save();
    }

    /**
     * select the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
      $context = $request->input('select');

      if ($context === 'select') {
        return redirect()->action(
          'ContactController@show',
          ['id' => $request->input('contactSelect')]
        );
      } elseif ($context === 'booking') {
        return "making booking";
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findorfail($id);

        return view('pages/contact', [
            'contactID'=>$contact->id,
            'contactName'=>$contact->name,
            'contactEmail'=>$contact->email,
            'contactJSON'=>$contact->administrateContactJSON,
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
      $Contact = Contact::findorfail($id);

      $ContactDecode = json_decode($Contact->ContactJSON,true);

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
        $Contact = Contact::findorfail($id);

        $ContactDecode = json_decode($Contact->ContactJSON,true);
        $Contact->ContactJSON = json_encode($ContactDecode, JSON_PRETTY_PRINT);
        $Contact->save();
        flash('<strong>Success!</strong> Contact Updated')->success();
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
        $Contacts = Contact::search($searchString)->raw();
        return $Contacts;
    }
}
?>
