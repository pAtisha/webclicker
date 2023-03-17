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
});


Route::prefix('professor')->middleware(['auth', 'isProfessor'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'professor_index']);
});


Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function (){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);


    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
});


Auth::routes();



