<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class UserAuth extends Controller
{
    public function signup(Request $request)
    {
        // web validation
        $validator = $request->validate([
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
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

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
        $validator = Validator::make($request->all(), [
            'email' => [
                // 'required',
                // 'unique:users',
                'email'
            ],
            'password' => [
                // 'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // check if user exists in db
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User with email ' . $request->email . ' not found in the database'
            ], 404);
        }

        // create token from api endpoint
        $csrfToken = csrf_token();
        // $token = Http::withToken($csrfToken)->post('http://127.0.0.1:8000/api/v1/auth',[
        //     'email' => $user->email,
        //     'password' => $user->password,
        // ]);

        $token = Http::post('http://127.0.0.1:8000/api/v1/auth',[
            'email' => $user->email,
            'password' => $user->password,
        ]);


        if ($response->ok()  == false) {
            $error = $response->status() . ' ' . $response->body();
        } 


        dd($token);

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
