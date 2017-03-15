<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\QuizTransformer;
use Illuminate\Support\Facades\Schema;
use App\Quiz;

class ApiQuizzesController extends ApiController
{

    protected $transformer;

    public function __construct(QuizTransformer $transformer) {
      $this->transformer = $transformer;
    }

    public function index(Request $request)
    {

      if($request->sortby) {
        if(Schema::hasColumn('quizzes', $request->sortby)) $quizzes = Quiz::orderBy($request->sortby, ($request->sortdir ?: 'asc'));
      }
      else $quizzes = Quiz::latest();

      if($request->amount) $quizzes = $quizzes->take($request->amount);

      $quizzes = $quizzes->get();

      if(!$quizzes) return $this->respondNotFound('No quizzes were found.');

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
         'title' => 'required',
         'author' => 'required',
         'questions.*.body' => 'required',
         'questions.*.a' => 'required',
         'questions.*.b' => 'required',
         'questions.*.c' => 'required',
         'questions.*.d' => 'required',
         'questions.*.correct_answer' => 'required'
       ]);


       $quiz = Quiz::create([
         'title' => $request->title,
         'author' => $request->author
       ]);

       $quiz->addQuestions($request->questions);

       return $this->respond('Quiz has been added.');

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

       if(!$quiz) return $this->respondNotFound('There is no such quiz');

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

    public function complete(Quiz $quiz) {
      return 'ok';
    }
}
