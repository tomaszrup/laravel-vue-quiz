<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Collection;

abstract class Transformer {

  public function transformCollection(Collection $collection) {
    return $collection->map(function($item) {
      return $this->transform($item);
    });
  }

  abstract public function transform($item);

}
