<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::post('/users',[UserController::class, 'store']);


// --------------------- views
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
    return view('bank', ['showHeader' => true, "showFooter" => false]);
});

Route::get('bank/questions', function () {
    return view('questions', ['showHeader' => true, "showFooter" => false]);
});

Route::get('bank/questions/question', function () {
    return view('question', ['showHeader' => true, "showFooter" => false]);
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

