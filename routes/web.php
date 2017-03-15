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

Route::get('/', function () {
    return view('master');
});

Route::group(['prefix' => 'api'], function() {

  Route::resource('quizzes', 'Api\ApiQuizzesController');

  Route::resource('quizzes.questions', 'Api\ApiQuizzesQuestionsController');

  Route::post('quizzes/{quiz}/complete', 'Api\ApiQuizzesController@complete');

});
