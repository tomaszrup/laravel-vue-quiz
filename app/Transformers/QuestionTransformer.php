<?php

namespace App\Transformers;

class QuestionTransformer extends Transformer {

  public function transform($question) {
    return [
      'id' => $question->id,
      'quiz_id' => $question->quiz_id,
      'body' => $question->body,
      'answers' => [
        'a' => $question->answer_a,
        'b' => $question->answer_b,
        'c' => $question->answer_c,
        'd' => $question->answer_d
      ],
    ];
  }

}
