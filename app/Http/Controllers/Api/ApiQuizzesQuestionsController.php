<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Question;
use App\Transformers\QuestionTransformer;
use App\Quiz;

class ApiQuizzesQuestionsController extends ApiController
{

    protected $transformer;

    public function __construct(QuestionTransformer $transformer) {
      $this->transformer = $transformer;
    }


    public function index($id)
    {
      $quiz = Quiz::find($id);

      if(!$quiz) return $this->respondNotFound('There is no such quiz');

      $questions = $quiz->questions;

      if(!$questions->first()) return $this->respondNotFound('This quiz has no questions');

      $questions = $this->transformer->transformCollection($questions);

      return $this->respond($questions);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
