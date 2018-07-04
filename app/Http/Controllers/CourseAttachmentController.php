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

    public function action(Request $request, $id)
    {
        $file;
        if (Input::get('upload')) {
            $this->create($request, $id);
        }
        else if (Input::get('delete')) {
            $this->destroy($request, $id);
        }
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
        $p = $request->input('attachmentSelect');
        if (!$p){flash('<strong>WARNING!</strong> No File Selected')->warning();}
        else {
            $deletable = Storage::files('attachments/courses/'.$id);
            $bDeleted = false;
            foreach ($deletable as $path) {
                if ($path == $p)
                {
                    Storage::delete($path);
                    $bDeleted = true;
                }
            }
            if ($bDeleted) {
                flash('<strong>Success!</strong> File Deleted')->success();
            }
            else {
                flash('<strong>WARNING!</strong> File Not Found')->warning();
            }
        }

        return redirect()->back();

    }
}
