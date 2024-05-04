<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// List users
Route::get('/api/users', [UserController::class, 'index']);

// Create a new user
Route::post('/api/users', [UserController::class, 'store']);

// Get a specific user
Route::get('/api/users/{user}', [UserController::class, 'show']);

// Update a specific user
Route::put('/api/users/{user}', [UserController::class, 'update']);
Route::patch('/api/users/{user}', [UserController::class, 'update']);

// Delete a specific user
Route::delete('/api/users/{user}', [UserController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
});
