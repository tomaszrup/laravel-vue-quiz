<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Route::get('welcome', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function() {

  Route::group(['middleware' => 'auth'], function() {

    Route::resource('quizzes', 'ApiQuizzesController');
    Route::post('quizzes/{quiz}/complete', 'ApiQuizzesController@complete');

    Route::resource('users', 'ApiUsersController');

    Route::resource('quizzes.questions', 'ApiQuizzesQuestionsController');

    Route::get('user', 'ApiUsersController@user');

  });

  Route::post('login', 'ApiAuthController@login')->middleware('throttle:10,1');

  Route::post('register/availability', 'ApiAuthController@availability')->middleware('throttle:10,1');


});

Route::get('/{any1?}/{any2?}', function () {
    return view('master');
})->middleware('auth');
