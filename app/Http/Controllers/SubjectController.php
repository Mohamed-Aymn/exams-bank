<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subjects::all();
        return $subjects;
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
        // subject validation
        $subject = new Subject(); 
        $validator = Validator::make($request->all(),$subject->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $newOne = User::create([
            'name' =>  $request->name,
            'color' => $request->color,
            'description' => $request->description
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
