<?php

use Illuminate\Support\Facades\Route;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAuth;

Route::prefix("/auth")->group(function (){
    Route::post('/signup', [UserAuth::class, 'signup']);
    Route::post('/login', [UserAuth::class, 'login']);
    Route::post('/logout', [UserAuth::class, 'logout']);
});

Route::get('/', function () {
    return view('home', ['showHeader' => false, "showFooter" => true]);
})->name('home');

Route::get('/signup', function () {
    return view('signup', ['showHeader' => false, "showFooter" => false]);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile', function () {
        return view('profile', ['showHeader' => true, "showFooter" => false]);
    })->name('profile');

    Route::get('/bank', function () {
        $request = Request::create("/api/v1/subjects", 'GET');
        $response = Route::dispatch($request);
        $responseBody = json_decode($response->getContent(), true);
        return view('bank', ['showHeader' => true, "showFooter" => false, "subjects" => $responseBody]);
    });

    Route::get('bank/{subject}', function (Request $request, $subject) {
        $questions = Question::subject($subject)->get();
        return view('subject', ['showHeader' => true, "showFooter" => false, "subject" => $subject, "questions" => $questions]);
    });

    Route::get('bank/{subject}/{questionId}', function ($subject, $questionId) {
        $request = Request::create("/api/v1/questions/".$questionId, 'GET');
        $response = Route::dispatch($request);
        $responseBody = json_decode($response->getContent(), true);
        return view('question', ['showHeader' => true, "showFooter" => false, "subject" => $subject, "question" => $responseBody]);
    });

    Route::get('manage', function () {
        return view('manage', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('userslist', function () {
        return view('users', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('create', function () {
        return view('create', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('manage/questions/question', function () {
        return view('manageQuestion', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('manage/teachers/teacher', function () {
        return view('manageTeacher', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('/exam', function () {
        return view('exam', ['showHeader' => false, "showFooter" => false]);
    });

    Route::get('/customize-exam', function () {
        return view('customizeExam', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('/create-question', function () {
        return view('createQuestion', ['showHeader' => true, "showFooter" => false]);
    });

    Route::get('/create-subject', function () {
        return view('createSubject', ['showHeader' => true, "showFooter" => false]);
    });
});







/**
 * Auth routes:-
 * 
 * auth routes are defined here in web.php file as all of them will
 * redirect to view.php files. 
 * This method is used used as this api will not be used by any other
 * client that is not this laravel website.
 */