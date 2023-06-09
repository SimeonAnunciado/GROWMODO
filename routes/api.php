<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);


// protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::post('/logout', [AuthController::class,'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::post('/users/{id}/update', [UserController::class, 'update']);
    Route::post('/users/destroy', [UserController::class, 'destroy']);
    Route::post('/users/unsubscribe', [UserController::class, 'unsubscribe']);


});
