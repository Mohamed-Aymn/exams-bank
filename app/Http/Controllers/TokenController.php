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
        $token = $user->createToken("user_token"); 
        $plainTextToken = $token->plainTextToken; 

        return response()->json(['token' => $plainTextToken]);
    }

    // terminate auth
    public function terminate(Request $request){
        // validate request data
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
            ],
            'action' => [
                'required',
                'in:revoke_all,revoke_current,revoke_specific'
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // get that specific user
        $user = User::where('user_id', $request->user_id)->first();
        if (!$user) {
            return back()->withErrors([
                'message' => 'user not found.',
            ]);
        }

        // tokin termination 
        $action = $request->input('action');
        $tokenId = $request->input('token_id');
        switch ($action) {
            case 'revoke_all':
                $request->user()->tokens()->delete();
                return response()->json(['message' => 'All tokens revoked.']);
    
            case 'revoke_current':
                $request->user()->currentAccessToken()->delete();
                return response()->json(['message' => 'Current token revoked.']);
    
            case 'revoke_specific':
                if ($tokenId) {
                    $request->user()->tokens()->where('id', $tokenId)->delete();
                    return response()->json(['message' => 'Token with ID ' . $tokenId . ' revoked.']);
                }
                break;
        }

        return response()->json(['message' => 'Invalid action or token ID.'], 400);
    }

    // public function userTokens(Request $request){
    //     // search for the user
    //     $user = User::where('email', $request->email)->first();
    //     if (!$user) {
    //         return response()->json([
    //             'message' => 'User with email ' . $request->email . ' not found in the database'
    //         ], 404);
    //     }

    //     foreach ($user->tokens as $token) {
    //         // ...
    //     }

    //     return ['token' => $token->plainTextToken];
    // }
}
