<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refdata extends Model
{
    //

  public $incrementing = false;
  public $primaryKey = 'refdatatype';
  protected $fillable = ['refdatatype'];

}
