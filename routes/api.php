<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('tasks', [TaskController::class, 'create']);
Route::put('tasks', [TaskController::class, 'update']);
Route::get('tasks/{id}', [TaskController::class, 'read'])->whereNumber('id');
Route::delete('tasks', [TaskController::class, 'delete']);
Route::get('tasks', [TaskController::class, 'list']);