<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JWTAuthController;
use App\Http\Controllers\Api\SignatureImageController;
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


 
// Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login']);
  
Route::group(['middleware' => 'auth.jwt'], function () {
 
    Route::post('logout', [JWTAuthController::class, 'logout']);
    Route::get('signature', [SignatureImageController::class, 'getSignatureRegisted']);
    Route::get('signatures', [SignatureImageController::class, 'getAllSignature']);
});