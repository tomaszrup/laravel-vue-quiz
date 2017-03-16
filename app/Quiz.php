<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = ['id', 'created_at'];

    protected $score = 0;

    public function complete() {
      $this->completions += 1;
      $this->save();
      return $this;
    }

    public function check($answers) {
      foreach ($this->questions as $key => $question) {
        if(isset($answers[$question->id])) {
          if($answers[$question->id] === $question->correct_answer) $this->score += 1;
        }
      }
      return $this;
    }

    public function getScore() {
      return $this->score;
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
