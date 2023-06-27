<?php

use Illuminate\Support\Facades\Route;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAuth;

// unauthorized users only
Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('home', ['showHeader' => false, "showFooter" => true]);
    })->name('home');
    
    Route::get('/signup', function () {
        return view('signup', ['showHeader' => false, "showFooter" => false]);
    });
});

// authorized users only
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/exam', function () {
        return view('exam');
    });
    Route::get('/customize-exam', function () {
        return view('customizeExam');
    });

    // admin user only
    Route::middleware(['user-type:a'])->group(function(){
        // bank routes
        Route::prefix('/bank')->group(function(){
            Route::get('/', function () {
                $request = Request::create("/api/v1/subjects", 'GET');
                $response = Route::dispatch($request);
                $responseBody = json_decode($response->getContent(), true);
                return view('bank', ["subjects" => $responseBody]);
            });
        
            Route::get('/{subject}', function (Request $request, $subject) {
                $questions = Question::subject($subject)->get();
                return view('subject', ["subject" => $subject, "questions" => $questions]);
            });
        
            Route::get('/{subject}/{questionId}', function ($subject, $questionId) {
                $request = Request::create("/api/v1/questions/".$questionId, 'GET');
                $response = Route::dispatch($request);
                $responseBody = json_decode($response->getContent(), true);
                return view('question', ["subject" => $subject, "question" => $responseBody]);
            });
        });

        // manage routes
        Route::prefix('/manage')->group(function(){
            Route::get('/', function () {
                return view('manage');
            });
            // Route::get('/questions/question', function () {
            //     return view('manageQuestion', ['showHeader' => true, "showFooter" => false]);
            // });
        
            // Route::get('/teachers/teacher', function () {
            //     return view('manageTeacher', ['showHeader' => true, "showFooter" => false]);
            // });
        });

        // user list
        Route::get('/users-list', function () {
            return view('users');
        });

        // create question
        Route::get('/create-subject', function () {
            return view('createSubject');
        });
    });

    // teachers and admins (non-students) routes 
    Route::middleware(['user-type:t'])->group(function () {
        // create question page
        Route::get('create', function () {
            $permission = true;
            if (Auth::user()->type == 't'){
                $teacher = Teacher::where('user_id', Auth::user()->user_id)->first();
                if($teacher->persmission == false){
                    $permission = false;
                }
            }
            return view('create', ["permission" => $permission]);
        })->middleware("user-type:a,t");

        // create question
        Route::get('/create-question', function () {
            return view('createQuestion');
        });
    });
});

// --------------------------------------------- logic routes

// authentication
Route::prefix("/auth")->group(function (){
    Route::post('/signup', [UserAuth::class, 'signup']);
    Route::post('/login', [UserAuth::class, 'login']);
    Route::get('/logout', [UserAuth::class, 'logout']);
});

// exams
Route::prefix("/exams")->group(function(){
    Route::post('/', function(Request $request){
        $examRequest = Request::create("/api/v1/exams", 'POST', $request->all());
        $response = Route::dispatch($examRequest);
        $newExam = json_decode($response->getContent(), true);
        return redirect('/exam?id='.$newExam["exam_id"].'?n=1');
    });
});