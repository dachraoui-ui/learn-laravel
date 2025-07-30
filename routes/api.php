<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');












/* Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']); */

Route::apiResource('tasks', TaskController::class);
Route::post('profiles',[ProfileController::class, 'store']);

// the first way using profile controller to retrieve a profile by user ID
Route::get('profiles/{id}', [ProfileController::class, 'show']);
Route::put('profiles/{id}', [ProfileController::class, 'update']);

// the second way using user controller to retrieve a profile by user ID

Route::get('users/{id}/profile', [UserController::class, 'getProfile']);
Route::put('users/{id}/profile', [UserController::class, 'updateProfile']);

Route::get('/users/{id}/tasks', [UserController::class,'getUserTasks']);
Route::get('/task/{id}/user', [TaskController::class,'getTaskUser']);

Route::post('/categories', [CategoryController::class, 'store']);


Route::post('tasks/{taskId}/categories', [TaskController::class, 'addCategoriesToTask']);

Route::get('tasks/{taskId}/categories', [TaskController::class, 'getTaskCategories']);
Route::get('categories/{categoryId}/tasks', [CategoryController::class, 'getCategorieTasks']);

