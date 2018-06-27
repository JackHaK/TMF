<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
  /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
    protected $fillable = ['id'];
    protected $visible = ['id','eventID','courseID','contactID','name','email'];

}
