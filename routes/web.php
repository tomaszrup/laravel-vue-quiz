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

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

  Route::resource('quizzes', 'Api\ApiQuizzesController');

  Route::resource('users', 'Api\ApiUsersController');

  Route::get('user', 'Api\ApiUsersController@user');

  Route::resource('quizzes.questions', 'Api\ApiQuizzesQuestionsController');

  Route::post('quizzes/{quiz}/complete', 'Api\ApiQuizzesController@complete');

});

Route::get('/{any1?}/{any2?}', function () {
    return view('master');
})->middleware('auth');
