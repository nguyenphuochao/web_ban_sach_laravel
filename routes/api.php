<?php

use App\Http\Controllers\APIProductController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// API
Route::get('product',[APIProductController::class,'index']);
Route::get('product/{id}',[APIProductController::class,'show']);
Route::post('product',[APIProductController::class,'create']);
Route::delete('product/{id}',[APIProductController::class,'delete']);
Route::put('product/{id}',[APIProductController::class,'update']);
