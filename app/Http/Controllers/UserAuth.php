<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserAuth extends Controller
{
    public function signup(Request $request)
    {
        // web validation
        $fields = $request->validate([
            'name' => [
                'required',
                'string'
            ], 'email' => [
                'required',
                'string',
                'unique:users',
                'email'
            ],'password' => [
                'required',
                'string'
            ], 'type' => [
                'required',
                'string',
                'in:a,t,s'
            ]
        ]);

        // create user from api endpoint
        $hashedPassword = Hash::make($request->password);
        $csrfToken = csrf_token();
        $user = Http::withToken($csrfToken)->post('http://127.0.0.1:8000/api/v1/users', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'type' => $request->type,
            'csrfToken' => $csrfToken,
        ]);

        // create token from api endpoint
        $token = Http::withToken($csrfToken)->post('http://127.0.0.1:8000/api/v1/auth',[
            'email' => $user->email,
            'password' => $user->password,
        ]);

        // redirect with the created token
        return redirect('/dashboard')->with('token', $token);
    }

    public function login(Request $request)
    {
        // web validation
        $fields = $request->validate([
            'email' => [
                'required',
                'string',
                'unique:users',
                'email'
            ],'password' => [
                'required',
                'string'
            ]
        ]);

        // check if user exists in db
        $user = User::where('email', $request->email)->first();
        
        // create token from api endpoint
        $hashedPassword = Hash::make($user->password);
        $csrfToken = csrf_token();
        $token = Http::withToken($csrfToken)->post('http://127.0.0.1:8000/api/v1/auth',[
            'email' => $user->email,
            'password' => $hashedPassword
        ]);

        // redirect with the created token
        return redirect('/dashboard')->with('token', $token);
    }

    public function logout()
    {
        // terminte token
        $token = Http::post('http://127.0.0.1:8000/api/v1/auth');
        // redirect to home page
        return redirect('/');
    }
}
