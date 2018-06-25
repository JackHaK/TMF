<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inflation extends Model
{
  //
  protected $primaryKey = "type";
  protected $fillable = ['type'];
  public $incrementing = false;
}
