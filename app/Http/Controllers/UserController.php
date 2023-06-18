<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserAuth;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
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
        // check if user exist
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json(['errors' => "this email is already used"], Response::HTTP_BAD_REQUEST);
        }
    
        // validation
        $validator = Validator::make($request->all(),(new User())->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $id = generateUniqueId("users", "user_id");
        $newUser = User::create([
            'user_id' =>  $id,
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => $request->photo,
            'type' => $request->type,
        ]);

        if ($request->type == 't' || $request->type == 'a') {
            // teacher validation
            $teacher = new Teacher(); 
            $validator = Validator::make($request->all(),$teacher->rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
            }

            Teacher::create([
                'teacher_id' => $id,
                'title' => $request->title,
                'bio' => $request->bio,
            ]);
        } elseif ($request->type == 's') {
            // student validation
            $student = new Student(); 
            $validator = Validator::make($request->all(),$student->rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
            }

            Student::create([
                'student_id' => $id,
                'fav_questions' => $request->fav_questions
            ]);
        }

        return $newUser;
    }

    /**
     * Display the specified resource.u
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
