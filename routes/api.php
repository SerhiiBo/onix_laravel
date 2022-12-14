<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('post/search', [PostController::class, 'search']);
Route::get('post/my', [PostController::class, 'index']);

Route::apiResource('users', UserController::class);
Route::apiResource('post', PostController::class);
