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
    protected $visible = ['eventID','courseID','contactID',];

    public function event()
    {
        return $this->belongsTo('App\Event', 'eventID');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

}
