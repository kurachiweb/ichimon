<?php

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

// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::apiResource('/users', UserController::class);
// });
// アカウント基礎情報・認証情報のCRUD
Route::apiResource('/accounts', 'App\Http\Controllers\AccountController');
// 認証メール送信
Route::get('/verify/email/send/{id}', 'App\Http\Controllers\SendVerifyEmailController');
