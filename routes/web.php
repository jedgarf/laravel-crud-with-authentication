<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

use App\Http\Middleware\CheckLoginSession;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rendering Views
Route::get('/', function () {
    return view('authentication/login');
});

// Authentication Routes
Route::post('auth', [AuthController::class, 'auth']);
Route::get('auth/logout', [AuthController::class, 'logout']);

Route::get('admin/students', [StudentController::class, 'index'])->middleware(CheckLoginSession::class);
Route::get('admin/students/create', [StudentController::class, 'create'])->middleware(CheckLoginSession::class);
Route::post('admin/students/save', [StudentController::class, 'store'])->middleware(CheckLoginSession::class)->name('validate.createform');
Route::get('admin/students/edit/{id}', [StudentController::class, 'edit'])->middleware(CheckLoginSession::class);
Route::post('admin/students/update/{id}', [StudentController::class, 'update'])->middleware(CheckLoginSession::class)->name('validate.updateform');
Route::get('admin/students/delete/{id}', [StudentController::class, 'destroy'])->middleware(CheckLoginSession::class)->name('validate.deleteform');

Route::get('admin/students/multipleDelete/{id}', [StudentController::class, 'massDestroy'])->middleware(CheckLoginSession::class)->name('validate.multipledelete');
