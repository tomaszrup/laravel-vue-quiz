<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  protected $statusCode = 200;


  public function getStatusCode() {
    return $this->statusCode;
  }

  public function setStatusCode($code) {
    $this->statusCode = $code;

    return $this;
  }

  public function respondNotFound($message = "Nie znaleziono.") {
    return $this->setStatusCode(404)->respondWithError($message);
  }

  public function respond($data) {
    return response([
      'data' => $data
    ], $this->getStatusCode());
  }

  public function respondWithError($message) {
    return response([
      'data' => [
        'message' => $message,
        'status' => $this->getStatusCode()
      ]
    ], $this->getStatusCode());
  }

}
