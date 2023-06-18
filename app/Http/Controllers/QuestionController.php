<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Mcq;
use App\Models\TrueOrFalse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\ValnewQuestionIdator;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return $questions;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // question valnewQuestionIdation
        $question = new Question(); 
        $validator = Validator::make($request->all(),$question->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $newQuestionId = generateUniqueId("questions", "question_id");
        $question = Question::create([
            'question_id' => $newQuestionId,
            'question' => $request->question,
            'answer' => $request->answer,
            'creator' => 1371096878,
            'subject' => $request->subject,
            'type' => $request->type,
            'level' => $request->level,
            'is_draft' => false,
            'is_accepted' => false
        ]);

        if ($request->type == '1') {
            // teacher validation
            $mcq = new Mcq(); 
            $validator = Validator::make($request->all(),$mcq->rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
            } 

            Mcq::create([
                'question_id' => $newQuestionId,
                'choice2' => $request->choice2,
                'choice3' => $request->choice3,
                'choice4' => $request->choice4,
            ]);
        } elseif ($request->type == '2') {
            // student validation
            $trueOrFalse = new TrueOrFalse(); 
            $validator = Validator::make($request->all(),$trueOrFalse->rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
            }

            Student::create([
                'question_id' => $newQuestionId,
                'false_ans' => $request->false_ans
            ]);
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question, $id)
    {
        // get question type
        $questionType = DB::table("questions")->where("question_id", $id)->value("type");

        // join with the right type
        if($questionType = 1){
            $question = DB::table('questions')
                            ->join('mcq', 'questions.question_id', '=', 'mcq.question_id')
                            ->select('questions.*', 'mcq.*')
                            ->where('questions.question_id', '=', $id)
                            ->first();
        }else if($questionType = 2){
            $question = DB::table('questions')
                            ->join('true_or_false', 'question_id', '=', 'true_or_false.question_id')
                            ->select('questions.*', 'true_or_false.*')
                            ->where('questions.question_id', '=', $id)
                            ->first();
        }

        return $question;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }

}
