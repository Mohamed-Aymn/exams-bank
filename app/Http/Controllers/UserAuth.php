<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserAuth extends Controller
{
    public function signup(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(),(new User())->rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        // create user
        $requestBody = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'type' => $request->type,
        ];
        $newUserRequest = Request::create('http://127.0.0.1:8000/api/v1/users', 'POST', $requestBody);
        $response = Route::dispatch($newUserRequest);
        $user = json_decode($response->getContent(), true);

        // sign in using session cookie
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'message' => 'user email or passowrd are not typed correctly',
            ]);
        }
        $request->session()->regenerate();
        

        // create token from api endpoint
        $requestBody = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $request = Request::create('http://127.0.0.1:8000/api/v1/tokens', 'POST');
        // dd($request);
        // dd($user);
        
        // redirect with the created token
        return redirect()->intended('profile?id='.$user['user_id']);
    }

    public function login(Request $request)
    {
        // web validation
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
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // check if user exists in db
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // sign in using session cookie
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'message' => 'user email or passowrd are not typed correctly',
            ]);
        }
        $request->session()->regenerate();

        // create token 
        $token = $user->createToken("user_token"); 
        $plainTextToken = $token->plainTextToken; 

        $request->session()->put('token', $plainTextToken);
        
        // redirect with the created token
        return redirect()->intended('profile?id='.$user->user_id);
    }

    public function logout(Request $request): RedirectResponse
    {
        if (!Auth::user()->user_id) {
            return back()->withErrors([
                'message' => 'user not found.',
            ]);
        }

        // terminate session cookie
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Revoke all tokens...
        // $requestBody = [
        //     "action" => "revoke_all",
        // ];
        // $token = Http::delete('http://127.0.0.1:8000/api/v1/tokens', $requestBody);

        // redirect to home page
        return redirect('/');
    }
}
