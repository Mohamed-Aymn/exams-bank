<?php

namespace App\Http\Controllers;

use App\Models\QuestionRequest;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionRequest $questionRequest)
    {
        //
    }
}
