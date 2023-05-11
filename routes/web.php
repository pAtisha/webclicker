<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;
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

//notify for password reset
//Route::post('notify-admin/send', [App\Http\Controllers\HomeController::class, 'notify_admin'])->middleware('guest');
//Route::get('notify-admin', [App\Http\Controllers\HomeController::class, 'show_password_reset'])->middleware('guest');

Route::get('/', function () {
    if(Auth::check())
    {
        if(Auth::user()->isStudent())
        {
            return redirect('student/home');
        } elseif(Auth::user()->isProfessor()) {
            return redirect('professor/home');
        } else {
            return redirect('admin/home');
        }

    }

    return view('welcome');
});

//Google
Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){

    Route::get('/home', [App\Http\Controllers\AdminController::class, 'home']);

    Route::get('users', [App\Http\Controllers\AdminController::class, 'show_users']);
    Route::post('/getUsers', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('getUsers');
    Route::delete('/users/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user']);
    Route::get('users/edit/{id}',[App\Http\Controllers\AdminController::class, 'edit_user']);
    Route::patch('users/update/{id}', [App\Http\Controllers\AdminController::class, 'update_user']);
    Route::patch('users/update/role/{id}', [App\Http\Controllers\AdminController::class, 'update_role']);
});


Route::prefix('professor')->middleware(['auth', 'isProfessor'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    //profile
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

    //courses
    Route::get('/courses', [App\Http\Controllers\ProfessorController::class, 'show_courses']);
    Route::post('/courses/create', [App\Http\Controllers\ProfessorController::class, 'create_course']);
    Route::put('/courses/active/{id}', [App\Http\Controllers\ProfessorController::class, 'active_course']);
    Route::delete('/courses/delete/{id}', [App\Http\Controllers\ProfessorController::class, 'delete_course']);
    Route::get('/courses/edit/{id}', [App\Http\Controllers\ProfessorController::class, 'edit_course']);
    Route::patch('/courses/update/{id}', [App\Http\Controllers\ProfessorController::class, 'update_course']);

    //courses JSON
    Route::get('/courses/get/all', [App\Http\Controllers\ProfessorController::class, 'get_coursesJSON']);

    //questions JSON
    Route::get('/questions/get/{id}', [App\Http\Controllers\ProfessorController::class, 'get_questionsJSON']);

    //tests
    Route::get('/courses/{id}', [App\Http\Controllers\ProfessorController::class, 'show_tests']);
    Route::post('/courses/create/test', [App\Http\Controllers\ProfessorController::class, 'create_test']);
    Route::delete('/courses/delete/test/{id}', [App\Http\Controllers\ProfessorController::class, 'delete_test']);
    Route::get('/courses/edit/test/{id}', [App\Http\Controllers\ProfessorController::class, 'edit_test']);
    Route::patch('/courses/update/test/{id}', [App\Http\Controllers\ProfessorController::class, 'update_test']);
    Route::put('/courses/active/test/{id}', [App\Http\Controllers\ProfessorController::class, 'active_test']);
    Route::put('/courses/open/test/{id}', [App\Http\Controllers\ProfessorController::class, 'open_test']);


    //questions
    Route::get('/courses/questions/test/{id}', [App\Http\Controllers\ProfessorController::class, 'show_questions']);
    Route::post('/courses/questions/test/create', [App\Http\Controllers\ProfessorController::class, 'create_question']);
    Route::put('/courses/active/questions/test/active/{id}', [App\Http\Controllers\ProfessorController::class, 'active_question']);
    Route::get('/courses/questions/test/edit/{id}', [App\Http\Controllers\ProfessorController::class, 'edit_question']);
    Route::patch('/courses/questions/test/update/{id}', [App\Http\Controllers\ProfessorController::class, 'update_question']);
    Route::delete('/courses/question/delete/test/{id}', [App\Http\Controllers\ProfessorController::class, 'delete_question']);

    Route::post('/courses/questions-existing/test/create', [App\Http\Controllers\ProfessorController::class, 'create_existing_question']);

    //answers
    Route::get('/courses/questions/test/answers/{id}', [App\Http\Controllers\ProfessorController::class, 'show_answers']);
    Route::post('/courses/questions/test/answers/create', [App\Http\Controllers\ProfessorController::class, 'create_answer']);
    Route::put('/courses/active/questions/test/answers/active/{id}', [App\Http\Controllers\ProfessorController::class, 'active_answer']);
    Route::delete('/courses/question/delete/test/answers/{id}', [App\Http\Controllers\ProfessorController::class, 'delete_answer']);
    Route::get('/courses/questions/test/answers/edit/{id}', [App\Http\Controllers\ProfessorController::class, 'edit_answer']);
    Route::patch('/courses/questions/test/answers/update/{id}', [App\Http\Controllers\ProfessorController::class, 'update_answer']);
});


Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    //courses
    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);
    Route::post('/courses/follow/create/{id}', [App\Http\Controllers\CourseController::class, 'follow']);
    Route::post('/courses/unfollow/{id}', [App\Http\Controllers\CourseController::class, 'unfollow']);

    //profile
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

    //tests
    Route::get('/courses/{id}', [App\Http\Controllers\CourseController::class, 'show_tests']);

    //answering test
    Route::get('/test/create/{id}', [App\Http\Controllers\TestAnswerController::class, 'show_entire_test']);
    Route::post('/test/create/password/{id}', [App\Http\Controllers\TestAnswerController::class, 'show_entire_test_with_password']);
    Route::post('/test/send', [App\Http\Controllers\TestAnswerController::class, 'submit_answers']);
});


Auth::routes();



