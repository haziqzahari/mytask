<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group([
//     'prefix' => 'tasks',
//     'as' => 'tasks'
// ],function (){
//     Route::get('/', [TaskController::class, 'index']);
//     Route::get('/create', [TaskController::class, 'create']);
//     Route::post('/', [TaskController::class, 'store']);
//     Route::get('/{id}', [TaskController::class, 'show']);
//     Route::get('/{id}/edit', [TaskController::class, 'edit']);
//     Route::post('/{id}/update', [TaskController::class, 'update']);
//     Route::delete('/{id}', [TaskController::class, 'destroy']);

// });

// Route::resource('tasks', TaskController::class);