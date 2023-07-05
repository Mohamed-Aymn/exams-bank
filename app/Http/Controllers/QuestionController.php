<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Mcq;
use App\Models\QuestionRequest;
use App\Models\TrueOrFalse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\ValnewQuestionIdator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/v1/questions",
     *      tags={"Questions"},
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="question_id", type="integer"),
     *                  @OA\Property(property="creator", type="integer"),
     *                  @OA\Property(property="answer", type="string"),
     *                  @OA\Property(property="subject", type="string"),
     *                  @OA\Property(property="is_accepted", type="boolean"),
     *                  @OA\Property(property="is_draft", type="boolean"),
     *                  @OA\Property(property="type", type="intiger", format="email", enum={"1", "2", "3"}),
     *                  @OA\Property(property="level", type="intiger", format="email", enum={"1", "2", "3"}),
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
        $questions = Question::all();
        return response()->json($questions);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/questions",
     *      tags={"Questions"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="teacher_id", type="integer"),
     *              @OA\Property(property="about", type="string"),
     *              @OA\Property(property="question", type="string"),
     *              @OA\Property(property="answer", type="string"),
     *              @OA\Property(property="creator", type="integer"),
     *              @OA\Property(property="subject", type="string"),
     *              @OA\Property(property="type", type="string", enum={"1", "2", "3"}),
     *              @OA\Property(property="level", type="string", enum={"1", "2", "3"}),
     *              @OA\Property(property="is_accepted", type="boolean"),
     *              @OA\Property(property="is_draft", type="boolean"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="question created successfully"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Question not found"
     *      ),
     * )
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

        // send question request if user was a teacher
        if(Auth::user()->type == 't'){
            $questionRequestId = generateUniqueId("users", "user_id");
            $questionRequest = QuestionRequest::create([
                'question_request_id' => $questionRequestId,
                'teacher_id' => Auth::user()->user_id,
                'about' => $request->about,
            ]);
        }

        $newQuestionId = generateUniqueId("questions", "question_id");
        $isAccepted = Auth::user()->type == "a" ? true : false;
        $question = Question::create([
            'question_id' => $newQuestionId,
            'question' => $request->question,
            'answer' => $request->answer,
            'creator' => Auth::user()->user_id,
            'subject' => $request->subject,
            'type' => $request->type,
            'level' => $request->level,
            'is_draft' => false,
            'is_accepted' => $isAccepted
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

            TrueOrFalse::create([
                'question_id' => $newQuestionId,
                'false_ans' => $request->false_ans
            ]);
        }

        return response()->json([
            'message' => 'question created successfully',
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/questions",
     *      tags={"Questions"},
     *      operationId="show",
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
     *              @OA\Property(property="teacher_id", type="integer"),
     *              @OA\Property(property="about", type="string"),
     *              @OA\Property(property="question", type="string"),
     *              @OA\Property(property="answer", type="string"),
     *              @OA\Property(property="creator", type="integer"),
     *              @OA\Property(property="subject", type="string"),
     *              @OA\Property(property="type", type="string", enum={"1", "2", "3"}),
     *              @OA\Property(property="level", type="string", enum={"1", "2", "3"}),
     *              @OA\Property(property="is_accepted", type="boolean"),
     *              @OA\Property(property="is_draft", type="boolean"),
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

        return response()->json($question);
    }
}
