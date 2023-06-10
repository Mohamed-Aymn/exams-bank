<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestions;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
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

        return response('question {$newExamQuestion->question_id} is successfully added to exam {$newExamQuestion->exam_id}');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamQuestions $examQuestions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamQuestions $examQuestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamQuestions $examQuestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamQuestions $examQuestions)
    {
        //
    }


}
