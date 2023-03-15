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
//Welcome page
Route::get('/', function () {
    if(auth()->user())
    {
        return redirect(route('home'));
    }

    return view('welcome');
});

//User routes
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

//Predifine Auth laravel routes
Auth::routes();

//Dashboard after login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Courses routes
Route::get('/courses', [App\Http\Controllers\CourseController::class, 'index']);


