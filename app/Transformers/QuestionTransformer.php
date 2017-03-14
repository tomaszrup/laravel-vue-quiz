<?php

namespace App\Transformers;

class QuestionTransformer extends Transformer {

  public function transform($question) {
    return [
      'id' => $question->id,
      'quiz_id' => $question->quiz_id,
      'body' => $question->body,
      'answers' => [
        'a' => $question->a,
        'b' => $question->b,
        'c' => $question->c,
        'd' => $question->d
      ],
    ];
  }

}
