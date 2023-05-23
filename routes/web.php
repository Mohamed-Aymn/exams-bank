<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home', ['showHeader' => false, "showFooter" => true]);
});

Route::get('/signup', function () {
    return view('signup', ['showHeader' => false, "showFooter" => false]);
});

Route::get('/profile', function () {
    return view('profile', ['showHeader' => true, "showFooter" => false]);
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

