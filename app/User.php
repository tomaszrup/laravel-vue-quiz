<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Completion;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'login', 'points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function completeQuiz($quiz, $answers) {

      $score = $quiz->check($answers)->getScore();

      if($quiz->user == $this) return $score;
      if($this->hasCompleted($quiz)) return $score;

      Completion::create([
        'user_id' => $this->id,
        'quiz_id' => $quiz->id,
        'score' => $score
      ]);

      return $score;
    }

    public function hasCompleted($quiz) {
      return Completion::where('user_id', $this->id)->where('quiz_id', $quiz->id)->get()->first();
    }

    public function completions() {
      return $this->hasMany('App\Completion');
    }

    public function quizzes() {
      return $this->hasMany('App\Quiz');
    }
}
