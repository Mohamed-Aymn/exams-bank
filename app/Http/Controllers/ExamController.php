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
     * submit exam answers
     * @return Illuminate\Http\JsonResponse
     */
    public function storeAnswers(Request $request, Exam $exam)
    {
        // input validation
        $validator = Validator::make($request->all(), [
            'answers.*.questionId' => 'required',
            'answers.*.answer' => 'required|string',
            'answers.*.answerTime' => 'string',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // refine data
        $data = array_map(function($ans) {
            return [
                'answer' => $ans['answer'],
                'answer_time' => $ans['answerTime'],
            ];
        }, $request->answers);

        // Extract the question IDs from the array of question objects
        $questionIds = array_column($request->answers, 'questionId');

        // dynamic query function to update dynamic records with dynamic contnet
        function getWhenStatements(array $questionIds, array $data, string $field): string
        {
            $whenStatements = '';
            foreach ($questionIds as $key => $questionId) {
                if ($key > 0) {
                    $whenStatements .= ' ';
                }
                $whenStatements .= "WHEN '{$questionId}' THEN '{$data[$key][$field]}'";
            }
            return $whenStatements;
        }

        // update query
        ExamQuestions::whereIn('question_id', $questionIds)
            ->where('exam_id', $exam->exam_id)
            ->update([
                'answer' => DB::raw("CASE question_id " . getWhenStatements($questionIds, $data, 'answer') . " END"),
                'answer_time' => DB::raw("CASE question_id " . getWhenStatements($questionIds, $data, 'answer_time') . " END"),
            ]);

        return response()->json(["message" => 'answers submitted successfully']);
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
        ->select('exam_questions.question_id', 'questions.answer as choice1', 'mcq.choice2', 'mcq.choice3', 'mcq.choice4', 'questions.question', 'questions.level', 'questions.type')
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
        ->select('exam_questions.question_id', 'questions.answer as choice1', 'true_or_false.false_ans as choice2', 'questions.question', 'questions.level', 'questions.type')
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

    public function showResults(Exam $exam)
    {   
        // check if exist     
        if($exam == null){
            return resposne()->json(['message'=>'not found']);
        }
        
        // get questions and answers
        $questions = DB::table("exam_questions")
        ->join('questions', 'exam_questions.question_id', 'questions.question_id')
        ->select('exam_questions.answer as user_answer', 'questions.answer as model_answer')
        ->where('exam_questions.exam_id', '=', $exam->exam_id)
        ->get();

        // count correct and wrong answers
        $correct = 0;
        $wrong = 0;
        foreach ($questions as $q) {
            if ($q->user_answer == $q->model_answer){
                ++$correct;
            }else{
                ++$wrong;
            }
        }

        return response()->json([
            'number_of_questions' => count($questions),
            'correct' => $correct,
            'wrong' => $wrong,
            'grade' => "A+"
        ]);
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
