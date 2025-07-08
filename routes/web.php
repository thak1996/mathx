<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/generate-exercises', [MainController::class, 'generateExercises'])->name('generateExercises');
Route::get('/print-exercises', [MainController::class, 'printExercises'])->name('printExercises');
Route::get('/export-exercises', [MainController::class, 'exportExercises'])->name('exportExercises');
