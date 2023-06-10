<?php

use Illuminate\Support\Facades\Route;
use App\Models\Question;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --------------------- Api Routes
Route::prefix('api')->group(function () {
    Route::post('/users',[UserController::class, 'store']);
    Route::post('/questions',[QuestionController::class, 'store']);
    Route::get('/questions/{id}',[QuestionController::class, 'show']);
    Route::post('/subjects',[SubjectController::class, 'store']);
    Route::get('/subjects',[SubjectController::class, 'index']);
    Route::post('/exams',[ExamController::class, 'store']);
    Route::post('/exam-questions',[ExamQuestionsController::class, 'store']);
});

// --------------------- View Routes
Route::get('/', function () {
    return view('home', ['showHeader' => false, "showFooter" => true]);
});

Route::get('/signup', function () {
    return view('signup', ['showHeader' => false, "showFooter" => false]);
});

Route::get('/profile', function () {
    return view('profile', ['showHeader' => true, "showFooter" => false]);
});

Route::get('/bank', function () {
    $request = Request::create("/api/subjects", 'GET');
    $response = Route::dispatch($request);
    $responseBody = json_decode($response->getContent(), true);
    return view('bank', ['showHeader' => true, "showFooter" => false, "subjects" => $responseBody]);
});

Route::get('bank/{subject}', function (Illuminate\Http\Request $request, $subject) {
    $questions = Question::subject($subject)->get();
    return view('subject', ['showHeader' => true, "showFooter" => false, "subject" => $subject, "questions" => $questions]);
});

Route::get('bank/{subject}/{questionId}', function (Illuminate\Http\Request $request, $subject, $questionId) {
    $request = Request::create("/questions/".$questionId, 'GET');
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

