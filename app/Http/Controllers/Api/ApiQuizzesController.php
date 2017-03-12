<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\QuizTransformer;
use App\Quiz;

class ApiQuizzesController extends ApiController
{

    protected $transformer;

    public function __construct(QuizTransformer $transformer) {
      $this->transformer = $transformer;
    }

    public function index()
    {
      $quizzes = Quiz::all();

      if(!$quizzes) return $this->respondNotFound('Nie ma tu obecnie quizów.');

      $quizzes = $this->transformer->transformCollection($quizzes);

      return $this->respond($quizzes);

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
       $quiz = Quiz::find($id);

       if(!$quiz) return $this->respondNotFound('Nie ma takiego quizu');

       $quiz = $this->transformer->transform($quiz);

       return $this->respond($quiz);
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
