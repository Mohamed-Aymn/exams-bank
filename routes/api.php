<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionsController;
use App\Http\Controllers\TokenController;


Route::prefix('users')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);

    Route::prefix("/tokens")->group(function(){
        Route::post("/", [TokenController::class, 'create']);
        Route::delete("/", [TokenController::class, 'terminate']);
    });
});


Route::post('/questions',[QuestionController::class, 'store']);
Route::get('/questions/{id}',[QuestionController::class, 'show']);
Route::post('/subjects',[SubjectController::class, 'store']);
Route::get('/subjects',[SubjectController::class, 'index']);
Route::post('/exams',[ExamController::class, 'store']);
Route::post('/exam-questions',[ExamQuestionsController::class, 'store']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
