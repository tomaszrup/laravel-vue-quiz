<?php

namespace App\Transformers;

class QuizTransformer extends Transformer {

  public function transform($quiz) {
    return [
      'id' => $quiz->id,
      'title' => $quiz->title,
      'author' => $quiz->author,
      'completions' => $quiz->completions,
      'created_at' => $quiz->created_at
    ];
  }

}
