<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyJWTToken;
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
// User API Routes
Route::post('/user-registration', [UserController::class, 'RegisterUser']);
Route::post('/user-login', [UserController::class, 'LoginUser']);
Route::get('/user-profile', [UserController::class, 'ProfileUser'])->middleware([VerifyJWTToken::class]);
Route::post('/user-logout', [UserController::class, 'LogoutUser']);

// User View Routes
Route::get('/signin-page', [UserController::class, 'LoginPage']);
Route::get('/signup-page', [UserController::class, 'RegistrationPage']);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([VerifyJWTToken::class]);
