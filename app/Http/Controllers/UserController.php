<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        // validation
        // create model object
        $users = new User(); 
        // validator is a laravel object
        $validator = Validator::make($request->all(),$users->rules);
        if ($validator->fails()) {
            // return "view('test')->withErrors($validator)"
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // create a new user if it passes the validation
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'photo' => $request->photo,
            'type' => $request->type,
        ]);

        // view return is to redirect user to the website istead of viewing json window of the returned data
        return redirect('/');
    }

    /**
     * Display the specified resource.u
     */
    public function show(User $user)
    {
        //
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
