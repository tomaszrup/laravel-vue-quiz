<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Transformers\QuizTransformer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Quiz;

class ApiQuizzesController extends ApiController
{

    protected $transformer;

    public function __construct(QuizTransformer $transformer) {
      $this->transformer = $transformer;
    }

    public function index(Request $request)
    {

      $quizzes = Quiz::leftJoin('completions', 'completions.quiz_id', 'quizzes.id')
                      ->addSelect('quizzes.*', DB::raw('count(completions.quiz_id) as completions'))
                      ->groupBy('quizzes.id');

      if($request->sortby) $quizzes = $quizzes->orderBy($request->sortby, ($request->sortdir ?: 'asc'));
      else $quizzes = $quizzes->latest();

      if(!$quizzes->first()) return $this->respondNotFound('No quizzes were found.');

      if($request->amount) $quizzes = $quizzes->take($request->amount)->get();
      else $quizzes = $quizzes->take(Quiz::count())->get();

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
         'questions.*.body' => 'required',
         'questions.*.a' => 'required',
         'questions.*.b' => 'required',
         'questions.*.c' => 'required',
         'questions.*.d' => 'required',
         'questions.*.correct_answer' => 'required'
       ]);


       $quiz = $request->user()->quizzes()->create([
         'title' => $request->title
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

    public function complete(Quiz $quiz, Request $request) {
      $answers = $request->answers;

      $score = $request->user()->completeQuiz($quiz)->check($answers)->getScore();

      return $this->respond($score);
    }
}
