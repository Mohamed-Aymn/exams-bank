<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/subjects",
     *      tags={"Subjects"},
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="description", type="string"),
     *                  @OA\Property(property="color", type="string"),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Subject not found"
     *      ),
     *  )
     */
    public function index()
    {
        $subjects = Subject::all();
        return response()->json($subjects);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/users",
     *      tags={"Users"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
      *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="description", type="string"),
     *                  @OA\Property(property="color", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="description", type="string"),
     *                  @OA\Property(property="color", type="string"),
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
        // subject validation
        $subject = new Subject(); 
        $validator = Validator::make($request->all(),$subject->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $newOne = Subject::create([
            'name' =>  $request->name,
            'color' => $request->color,
            'description' => $request->description
        ]);

        return $newOne;
    }
}
