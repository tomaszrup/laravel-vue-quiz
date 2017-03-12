<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function quiz() {
      return $this->belongsTo('App\Quiz');
    }
}
