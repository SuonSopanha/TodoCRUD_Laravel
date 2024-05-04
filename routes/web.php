<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
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

//For login

//Login user
Route::post('/api/login', [AuthController::class, 'login']);

//Logout user
Route::post('/api/logout', [AuthController::class, 'logout']);

//Sign up
Route::post('/api/signup',[AuthController::class, 'signup']);


//Route for todo

// List all todos
Route::get('/api/todos', [TodoController::class, 'index']);

// Create a new todo
Route::post('/api/todos', [TodoController::class, 'store']);

// Get a specific todo

// Get a specific todo
Route::get('/api/todos/{todo}', [TodoController::class, 'show']);

// Update a specific todo
Route::put('/api/todos/{todo}', [TodoController::class, 'update']);
Route::patch('/api/todos/{todo}', [TodoController::class, 'update']);

// Delete a specific todo
Route::delete('/api/todos/{todo}', [TodoController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
});
