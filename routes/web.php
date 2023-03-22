<?php

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


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function (){

    Route::get('/home', [App\Http\Controllers\AdminController::class, 'home']);

    Route::get('users', [App\Http\Controllers\AdminController::class, 'show_users']);
    Route::delete('/users/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_user']);
    Route::get('users/edit/{id}',[App\Http\Controllers\AdminController::class, 'edit_user']);
    Route::patch('users/update/{id}', [App\Http\Controllers\AdminController::class, 'update_user']);
    Route::patch('users/update/role/{id}', [App\Http\Controllers\AdminController::class, 'update_role']);
});


Route::prefix('professor')->middleware(['auth', 'isProfessor'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    //courses
    Route::get('/courses', [App\Http\Controllers\ProfessorController::class, 'show_courses']);
    Route::post('/courses/create', [App\Http\Controllers\ProfessorController::class, 'create_course']);
    Route::put('/courses/active/{id}', [App\Http\Controllers\ProfessorController::class, 'active_course']);
    Route::delete('/courses/delete/{id}', [App\Http\Controllers\ProfessorController::class, 'delete_course']);
    Route::get('/courses/edit/{id}', [App\Http\Controllers\ProfessorController::class, 'edit_course']);
    Route::patch('/courses/update/{id}', [App\Http\Controllers\ProfessorController::class, 'update_course']);

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
});


Auth::routes();



