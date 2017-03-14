<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = ['id', 'created_at'];


    public function addCompletion() {
      $this->completions += 1;
      $this->save();
    }

    public function addQuestions($questions) {
      foreach ($questions as $key => $question) {
        $this->questions()->create($question);
      }
    }

    public function questions() {
      return $this->hasMany('App\Question');
    }
}
