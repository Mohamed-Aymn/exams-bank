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
     * @OA\Get(
     *      path="/api/v1/exams",
     *      tags={"Exams"},
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="exam_id", type="integer", example="1"),
     *                  @OA\Property(property="duration", type="string"),
     *                  @OA\Property(property="created_at", type="string", format="email"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     * )
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/exams",
     *      tags={"Exams"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *                  @OA\Property(property="exam_id", type="integer", example="1"),
     *                  @OA\Property(property="duration", type="string"),
     *                  @OA\Property(property="created_at", type="string", format="email"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *                  @OA\Property(property="exam_id", type="integer", example="1"),
     *                  @OA\Property(property="duration", type="string"),
     *                  @OA\Property(property="created_at", type="string", format="email"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     * )
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
        return $newExam;
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
     * @OA\Post(
     *      path="/api/v1/{id}",
     *      tags={"Exams"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="The ID of the user",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *  
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="duration", type="string"),
     *              @OA\Property(property="questions", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="User not found"
     *      )
     * )
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

        /**
     * @OA\Get(
     *      path="/api/v1/{id}/results",
     *      tags={"Exams"},
     *      operationId="showResults",
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="number_of_questions", type="integer"),
     *                  @OA\Property(property="correct", type="integer"),
     *                  @OA\Property(property="wrong", type="integer"),
     *                  @OA\Property(property="grade", type="string"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     * )
     */
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
}
