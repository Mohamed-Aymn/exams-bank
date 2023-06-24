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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        return $newQuestionRequest;
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionRequest $questionRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionRequest $questionRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
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
