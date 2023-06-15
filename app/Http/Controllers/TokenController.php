<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{

    public function createToken(){
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

        // get user from db
        $user = User::where('email', $request->email)->first();

        // create token 
        $token = $user->createToken('myapptoken')->plainTextToken;

        // reutn tokent with authenticated status code
        return response($token, 201);
    }

    // terminate auth
    public function terminateToken(){
        auth()->user()->currentAccessToken()->delete();
        return "token terminated";
    }
}
