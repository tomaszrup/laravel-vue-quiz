<?php

namespace App\Transformers;

class UserTransformer extends Transformer {

  public function transform($user) {
    return [
      'id' => $user->id,
      'name' => $user->name,
      'points' => $user->completions()->count(),
      'created_at' => $user->created_at
    ];
  }

}
