<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Auth;

class QuizTransformer extends Transformer {

  public function transform($quiz) {
    return [
      'id' => $quiz->id,
      'title' => $quiz->title,
      'author' => [
        'id' => $quiz->user->id,
        'name' => $quiz->user->name
      ],
      'completions' => $quiz->completions()->count(),
      'created_at' => $quiz->created_at,
      'completed' => $quiz->completions()->where('user_id', Auth::id())->first() ?: false
    ];
  }

}
