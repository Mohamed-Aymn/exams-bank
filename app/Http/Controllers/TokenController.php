<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class TokenController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'string'
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // get user from db
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User with email ' . $request->email . ' not found in the database'
            ], 404);
        }

        // TODO: password check to return unauthorized response if fase

        // create token 
        $token = $user->createToken(time())->plainTextToken;

        // reutn tokent with authenticated status code
        return response($token, 201);
        // return response()->json(['token' => $token], 201);
    }

    // terminate auth
    public function terminate(){
        auth()->user()->currentAccessToken()->delete();
        return "token terminated";
    }
}
