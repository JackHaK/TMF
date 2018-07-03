<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class CourseAttachmentController extends Controller
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
    public function index($id)
    {
      $attachments = Storage::files("attachments/courses/" . $id);
      //return $attachments;
      return view('pages/courseAttachments', [
          'courseID'=>$id,
          'attachments'=>$attachments
      ]);
    }

    /**
     * Uploads and stores the file.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    { if (!empty($request->file('attachmentFile'))) {
        $filename = $request->file('attachmentFile')->getClientOriginalName();
        $request->file('attachmentFile')->storeAs('attachments/courses/'.$id, $filename);
        flash('<strong>Success!</strong> File Uplaoded')->success();
      }
      else {
        flash('<strong>Warning!</strong> Choose file to upload before clicking Upload')->warning();
      }
      return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
