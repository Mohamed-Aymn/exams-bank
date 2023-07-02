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
        Route::get("/", [TokenController::class, 'getToken']);
        Route::post("/", [TokenController::class, 'create']);
        Route::delete("/", [TokenController::class, 'terminate']);
    });
});

Route::middleware(['auth:sanctum'])->prefix('question-requests')->group(function () {
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

Route::prefix('/exams')->group(function(){
    Route::post('/',[ExamController::class, 'store']);
    Route::get('/{exam}',[ExamController::class, 'show']);
    Route::get('/{exam}/results',[ExamController::class, 'showResults']);
    Route::post('/{exam}',[ExamController::class, 'storeAnswers']);
});

Route::prefix('/exam-questions')->group(function(){
    Route::post('/',[ExamQuestionsController::class, 'store']);
    Route::get('/',[ExamQuestionsController::class, 'show']);
});
