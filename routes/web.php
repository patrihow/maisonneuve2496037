<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/students', [StudentController::class, 'index'])->name('student.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/students', [StudentController::class, 'store'])->name('student.store');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('student.show');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
