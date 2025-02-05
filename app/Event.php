<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    protected $fillable = ['id'];

    public function course()
     {
         return $this->belongsTo('App\Course');
     }
}
