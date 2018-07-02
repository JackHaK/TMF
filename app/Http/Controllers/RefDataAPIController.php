<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Refdata;

class RefDataAPIController extends Controller
{
    /**
     * Display the specified resource.
     *
     */
    public function show($refdatatype)
    {
      $refdata = Refdata::findorfail($refdatatype);
      return response()->json(json_decode($refdata->refdataJSON));
    }

}
