<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

    //checks which button has been pressed on the atachments webpage and acts accordingly
    public function action(Request $request, $id)
    {
        $file;
        if (Input::get('upload')) {
            $this->create($request, $id);
        }
        else if (Input::get('delete')) {
            $this->destroy($request, $id);
        }
        //refresh
        return redirect()->back();
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
    public function destroy(Request $request, $id)
    {
        //store the selected file path
        $p = $request->input('attachmentSelect');
        //if no file selected - let the user know
        if (!$p){flash('<strong>WARNING!</strong> No File Selected')->warning();}
        else {
            //open the directory that has the attachments for this course in storage
            $deletable = Storage::files('attachments/courses/'.$id);

            $bDeleted = false;//deletion boolian

            //search for the file within the directory
            foreach ($deletable as $path) {
                //if file is found
                if ($path == $p)
                {
                    //delete it
                    Storage::delete($path);
                    //set boolian
                    $bDeleted = true;
                }
            }
            //give user a nice little visual for pleasentness
            if ($bDeleted) {
                flash('<strong>Success!</strong> File Deleted')->success();
            }
            else {
                flash('<strong>WARNING!</strong> File Not Found')->warning();
            }
        }
        //refresh the page
        return redirect()->back();

    }
}
