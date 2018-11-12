<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends ApiController
{
    public function __construct() {
      $this->middleware('guest');
    }

    public function login(Request $request) {

      if(Auth::attempt(['login' => $request->login, 'password' => $request->password], $request->remember)) {
        return $this->respond('/');
      }

      return $this->respondUnathorized();

    }

    public function availability(Request $request) {

      if(User::where('login', $request->login)->first()) {
        return $this->respondUnprocessable('This username is already taken.');
      }

      return $this->respond('This username is available.');

    }

    public function register(Request $request) {
      // TODO: add validation

      $user = User::create($request->all());
      if($user) Auth::login($user);
    }


}
