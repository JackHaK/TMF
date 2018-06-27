<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD

class RefDataController extends Controller
{
=======
use App\Refdata;

class RefDataController extends Controller
{
  // constrain the controller to authorised users
  public function __construct()
  {
      $this->middleware('auth');
  }

>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store($refdatatype, $refdataJSON)
    {
      //
<<<<<<< HEAD
      $refdata = RefData::firstorNew('refdatatype'=>$refdatatype);
=======
      $refdata = Refdata::firstorNew(['refdatatype'=>$refdatatype]);
>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea

      $refdata->refdataJSON = $refdataJSON;
      $refdata->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($refdatatype)
    {
<<<<<<< HEAD
      $refdata = Course::findorfail($refdatatype);
      return $refdata->$refdataJSON;
=======
      $refdata = Refdata::findorfail($refdatatype);
      return $refdata->refdataJSON;
>>>>>>> 495f65246f2176b8f16c1bd8d1807bbfa7c3adea
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
