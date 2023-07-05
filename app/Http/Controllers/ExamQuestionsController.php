<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestions;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/exam-questions",
     *      tags={"Exam Questions"},
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="exam_id", type="integer", example="1"),
     *                  @OA\Property(property="question_id", type="integer", example="1"),
     *                  @OA\Property(property="answer", type="string"),
     *                  @OA\Property(property="answer_time", type="string", format="email"),
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
        $examQuestions = ExamQuestions::all();
        return $examQuestions;
    }

        /**
     * @OA\Post(
     *      path="/api/v1/exam-questions",
     *      tags={"Exam Questions"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="exam_id", type="integer"),
     *              @OA\Property(property="question_id", type="integer"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="Successfully created"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     * )
     */
    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), (new ExamQuestions())->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // create new exam
        $newExamQuestion = ExamQuestions::create([
            'exam_id' =>  $request->exam_id,
            'question_id' => $request->question_id,
        ]);

        return response()->json(["message" => 'question {$newExamQuestion->question_id} is successfully added to exam {$newExamQuestion->exam_id}']);
    }
}
