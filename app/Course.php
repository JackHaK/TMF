<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Course extends Model
{
  /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
  protected $fillable = ['id'];

  protected $attributes = array(
    'active' => 1,
    'useLocal' => 0,
  );

  public function events()
  {
      return $this->hasMany('App\Event');
  }


  use Searchable;

  public function toSearchableArray()
      {
          $array = $this->toArray();

          // Customize array...
          unset($array['administrateCourseJSON'], $array['courseJSON'],$array['created_at'], $array['updated_at']);

          return $array;
      }
}
