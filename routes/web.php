<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
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

Route::group(['middleware' => ['auth', 'admin']], function () {
   
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
   //comment


    Route::get('admin/jobs/manage', [JobController::class, 'manageAll'])->name('jobs.manage.all');
});

Route::get('/', [JobController::class,'index'], )->name('home');
Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update')->middleware('auth');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware('auth');
Route::get('/jobs/manage', [JobController::class, 'manage'])->name('jobs.manage')->middleware('auth');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit')->middleware('auth');
Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.delete')->middleware('auth');


//New changes




Route::get('/users/create', [UserController::class,'create'] )->name('register')->middleware('guest');
Route::get('/users/login', [UserController::class,'showLoginForm'])->name('login')->middleware('guest');
Route::post('/users/login', [UserController::class,'login']);
Route::post('/users/logout', [UserController::class,'logout'])->name('logout')->middleware('auth');
Route::post('/users', [UserController::class,'store'] );

