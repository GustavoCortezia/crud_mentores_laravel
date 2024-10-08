<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'store']);
Route::apiResource('/users', UserController::class)->only('store');
Route::apiResource('/auth', AuthController::class);

//middleware
Route::apiResource('/mentors', MentorController::class)->middleware(['auth:sanctum', 'admin']);
Route::delete('/logout', [AuthController::class, 'destroy'])->middleware('auth:sanctum');
