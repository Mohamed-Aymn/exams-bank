<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\ExamQuestions;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
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
    public function store(Request $request, Exam $exam)
    {
        // exam validation
        $validator = Validator::make($request->all(), (new Exam())->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // exam questions validation
        if ($request->type[0] == null || $request->level[0] == null || $request->number[0] == null){
            return response()->json(['errors' => "questions type, level and number are requried"]);
        }

        // create new exam
        $id = generateUniqueId("exams", "exam_id");
        $newExam = Exam::create([
            'exam_id' =>  $id,
            'duration' => $request->duration,
            'created_at' => now(),
        ]);

        // create exam questions
        // logic is done for all chosen questions sets
        for ($i = 0; $i < count($request->type); $i++){
            // fetch questions with required specs
            $questions = Question::randomQuestions($request->subject, $request->type[$i], $request->level[$i], $request->number[$i])->pluck('question_id')->toArray();

            // combine exam_id with questions_id in an array
            $examQuestions;
            for ($j = 1; $j < $request->number[0]; $j++){
                $examQuestions [$j] = [
                    'exam_id' => $id,
                    'question_id' => $questions[$j]
                ];
            }

            // insert all of this questions using that array of exam questions
            ExamQuestions::insert($examQuestions);
        }
        return response()->json($newExam);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {

        if($exam == null){
            return resposne()->json(['message'=>'not found']);
        }

        // get mcq questions
        $mcqQuestions = DB::table('exam_questions')
        ->join('questions', 'exam_questions.question_id', '=', 'questions.question_id')
        ->join('mcq', 'exam_questions.question_id', '=', 'mcq.question_id')
        ->select('questions.answer as choice1', 'mcq.choice2', 'mcq.choice3', 'mcq.choice4', 'questions.question', 'questions.level', 'questions.type')
        ->where('exam_questions.exam_id', '=', $exam->exam_id)
        ->get();
        // shuffle values of choices
        foreach ($mcqQuestions as $question) {
            $choices = [$question->choice1, $question->choice2, $question->choice3, $question->choice4];
            shuffle($choices);
            $question->choice1 = $choices[0];
            $question->choice2 = $choices[1];
            $question->choice3 = $choices[2];
            $question->choice4 = $choices[3];
        }

        // get true or false questions
        $trueOrFalseQuestions = DB::table('exam_questions')
        ->join('questions', 'exam_questions.question_id', '=', 'questions.question_id')
        ->join('true_or_false', 'exam_questions.question_id', '=', 'true_or_false.question_id')
        ->select('questions.answer as choice1', 'true_or_false.false_ans as choice2', 'questions.question', 'questions.level', 'questions.type')
        ->where('exam_questions.exam_id', '=', $exam->exam_id)
        ->get();
        // shuffle values of choices
        foreach ($trueOrFalseQuestions as $question) {
            $choices = [$question->choice1, $question->choice2];
            shuffle($choices);
            $question->choice1 = $choices[0];
            $question->choice2 = $choices[1];
        }

        // merge all questions in one response
        $examQuestions = [];
        if($mcqQuestions->isNotEmpty()){
            $examQuestions = array_merge($examQuestions, $mcqQuestions->toArray());
        }
        if($trueOrFalseQuestions->isNotEmpty()){
            $examQuestions = array_merge($examQuestions, $trueOrFalseQuestions->toArray());
        }

        return response()->json([
            'duration' => $exam->duration,
            'questions' => $examQuestions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
