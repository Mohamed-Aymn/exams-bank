<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionsController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\QuestionRequestController;


Route::prefix('/users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);

    Route::prefix("/tokens")->group(function(){
        Route::post("/", [TokenController::class, 'create']);
        Route::delete("/", [TokenController::class, 'terminate']);
    });
});

// Route::middleware(['auth:sanctum'])->prefix('/question-requests')->group(function(){
Route::prefix('/question-requests')->group(function(){
    Route::post('/', [QuestionRequestController::class, 'update']);
});

Route::prefix('/questions')->group(function(){
    Route::post('/',[QuestionController::class, 'store']);
    Route::get('/{id}',[QuestionController::class, 'show']);
});

Route::prefix('/subjects')->group(function(){
    Route::post('/',[SubjectController::class, 'store']);
    Route::get('/',[SubjectController::class, 'index']);
});


Route::post('/exams',[ExamController::class, 'store']);
Route::post('/exam-questions',[ExamQuestionsController::class, 'store']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
