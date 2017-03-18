<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{

  protected $guarded = [];

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function quiz() {
    return $this->belongsTo('App\Quiz');
  }
}
