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
    /**
     * Store a newly created resource in storage.
     * @param  string  $email
     * @param  string  $password
     * @return Illuminate\Http\JsonResponse
     */
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


        $cookie = cookie('token', $plainTextToken, 60*24, null, null, false, true);
        return response()->json(['token' => $token])->withCookie($cookie);
    }


    /**
     * terminate token
     * @param  string  $email
     * @param  string  $password
     * @return Illuminate\Http\JsonResponse
     */
    public function terminate(Request $request){
        // validate request data
        $validator = Validator::make($request->all(), [
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
        $user = User::where('user_id', Auth::user()->user_id)->first();
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

    // assign token to browser cookie
    public function getToken(Request $request)
    {
        $token = $request->session()->get('token');
        $cookie = cookie('token', $token, 60*24, null, null, false, true);
        return response()->json(['token' => $token])->withCookie($cookie);
    }
}
