<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
  /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    protected $fillable = ['id'];

    protected $attributes = array(
      'active' => 0,
    );

}
