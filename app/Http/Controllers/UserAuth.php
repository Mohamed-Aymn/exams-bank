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
        // web validation
        $validator = $request->validate([
            'name' => [
                'required',
                'string'
            ], 'email' => [
                'required',
                'string',
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

        // create token from api endpoint
        $requestBody = [
            'email' => $user->email,
            'password' => $user->password,
        ];
        $request = Request::create('http://127.0.0.1:8000/api/v1/tokens', 'POST');

        // redirect with the created token
        return redirect()->intended('profile');
    }

    public function logout(Request $request): RedirectResponse
    {
        // search for that specific user
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->withErrors([
                'message' => 'user id is requried.',
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'message' => 'user not found.',
            ]);
        }

        // terminate session cookie
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Revoke all tokens...
        $requestBody = [
            "user_id" => $request->user_id,
            "action" => "revoke_all",
        ];
        $token = Http::delete('http://127.0.0.1:8000/api/v1/tokens', $requestBody);

        // redirect to home page
        return redirect('/');
    }
}
