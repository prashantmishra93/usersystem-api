<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/index', [UserController::class, 'index']);
Route::post('/userView', [UserController::class, 'userView']);
Route::post('/userEditView', [UserController::class, 'userEditView']);
Route::post('/userUpdate', [UserController::class, 'userUpdate']);
Route::post('/userDestroy', [UserController::class, 'userDestroy']);
Route::post('/registerUser', [UserController::class, 'registerUser']);