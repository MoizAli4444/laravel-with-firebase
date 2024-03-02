<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

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
    return redirect()->route('task.index');
});

Route::group(['prefix' => 'task', 'as' => 'task.'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/store', [TaskController::class, 'store'])->name('store');
    Route::get('/edit/{id?}', [TaskController::class, 'edit'])->name('edit');
    Route::get('/show/{id?}', [TaskController::class, 'show'])->name('show');
    Route::put('/update/{id?}', [TaskController::class, 'update'])->name('update');
    Route::delete('/delete/{id?}', [TaskController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id?}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{id?}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{id?}', [UserController::class, 'destroy'])->name('destroy');
});
