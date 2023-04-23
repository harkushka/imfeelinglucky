<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'register'])->name('register');
Route::post('user', [UserController::class, 'store']);
Route::get('user/{token}', [UserController::class, 'getUserPage'])->name('user');
Route::post('user/{token}/lucky', [UserController::class, 'addLucky'])->name('lucky');
Route::get('user/{token}/history', [UserController::class, 'getHistory'])->name('history');
Route::post('user/{token}/deactivate', [UserController::class, 'deactivateUser'])->name('deactivateUser');
Route::post('user/{token}/update-link', [UserController::class, 'updateLink'])->name('updateLink');
