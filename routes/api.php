<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserCollection;

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

Route::group(['middleware' => ['verifyAccessKey']], function () {

    Route::controller(AuthController::class)->group( function () {
        Route::post('/register', 'Register')->middleware('ability:register');
        Route::post('/login', 'Login')->middleware('ability:login');
        Route::post('/otp', 'OtpSubmit')->middleware('ability:otp.submit');
        Route::post('/otp/resend', 'OtpResend')->middleware('ability:otp.resend');
        Route::post('/logout', 'Logout')->middleware('ability:logout');
    } );
    
});

Route::get('coba1', [UserController::class, 'Coba']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/refreshUser', 'refreshUser');
    });
});
