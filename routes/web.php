<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;

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
// Routes pour changer la langue de l'app
Route::get('/lang/{locale}', [LocaleController::class, 'change'])->name('lang.change');

// Routes de gestion des utilisateurs
Route::get('/register', [UserController::class, 'create'])->name('user.create');
Route::post('/register', [UserController::class, 'store'])->name('user.store');

// Routes de autenticación
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('articles', ArticleController::class)->middleware('auth');

Route::resource('documents', DocumentController::class)->middleware('auth');

// Routes pour les etudiants accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students', [StudentController::class, 'store'])->name('student.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
});
