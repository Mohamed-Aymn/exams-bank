<?php

namespace App\Http\Controllers;

use App\Models\QuestionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class QuestionRequestController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/question-requests",
     *      tags={"Question Requests"},
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="question_id", type="integer"),
     *                  @OA\Property(property="question_request_id", type="integer"),
     *                  @OA\Property(property="teacher_id", type="integer"),
     *                  @OA\Property(property="reviewer_id", type="integer"),
     *                  @OA\Property(property="about", type="integer"),
     *                  @OA\Property(property="is_accepted", type="boolean", example="true"),
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
        $questionRequests = QuestionRequest::all();
        return response()->json($questionRequests);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/question-requests",
     *      tags={"Question Requests"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="teacher_id", type="integer"),
     *              @OA\Property(property="about", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="question_id", type="integer"),
     *              @OA\Property(property="teacher_id", type="integer"),
     *              @OA\Property(property="reviewer_id", type="integer"),
     *              @OA\Property(property="about", type="integer"),
     *              @OA\Property(property="is_accepted", type="boolean", example="true"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     * )
     */
    public function store(Request $request, QuestionRequest $questionRequest)
    {
        // authorization (admins only proceed)
        Gate::authorize('create', $questionRequest);

        // validation
        $validator = Validator::make($request->all(), [
            'teacher_id' => [
                'required',
            ],
            'about' => [
                'required',
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->withErrors([
                'message' => 'user id is requried.',
            ]);
        };

        $newQuestionRequest = User::create([
            'teacher_id' =>  $request->teacher_id,
            'about' => $request->about,
        ]);

        return response()->json($newQuestionRequest);
    }

    /**
     * Update the specified resource in storage.
     * @param  int  $question_request_id
     * @param  string  $is_accepted
     * @return Illuminate\Http\JsonResponse
     */
        /**
     * @OA\Post(
     *      path="/api/v1/question-requests/{id}",
     *      operationId="update",     
     *      tags={"Question Requests"},
     *      
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
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="question_request_id", type="integer"),
     *              @OA\Property(property="is_accepted", type="boolean"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="question request updated successfuly"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized",
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Question not found"
     *      ),
     * )
     */
    public function update(Request $request, QuestionRequest $questionRequest)
    {
        // authorization (admins only proceed)
        Gate::authorize('update', $questionRequest);

        // input validation
        $validator = Validator::make($request->all(), [
            'question_request_id' => 'required',
            'is_accepted' => 'in:1,0|string'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // search for that question request in database        
        $retrivedQuestionRequest = QuestionRequest::where('question_request_id', $request->question_request_id)->first();
        if (!$questionRequest) {
            return response()->json(['message' => 'question request not found'], Response::HTTP_NOT_FOUND);
        }
        
        // update statememnt
        QuestionRequest::where('question_request_id', $request->question_request_id)
                ->update(['is_accepted' => boolval($request->is_accepted)]);

        return response()->json(['message' => 'question request updated successfuly']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionRequest $questionRequest)
    {
        //
    }
}
