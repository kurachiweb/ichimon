<?php

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

// アカウント作成
Route::apiResource('/accounts', 'App\Http\Controllers\AccountController', ['only' => ['store']]);
// アカウントログイン
Route::post('/accounts/login', 'App\Http\Controllers\AccountLoginController');

// ログイン状態なら
Route::group(['middleware' => ['account.auth:authz']], function () {
  // アカウント基礎情報・認証情報のRUD
  Route::apiResource('/accounts', 'App\Http\Controllers\AccountController', ['only' => ['index']]);

  // ログインユーザーを認証できれば
  Route::group(['middleware' => ['account.auth:authr']], function () {
    // アカウント基礎情報・認証情報のRUD
    Route::apiResource('/accounts', 'App\Http\Controllers\AccountController', ['except' => ['index', 'store']]);

    // アカウントメールアドレスの認証メール送信
    Route::post('/accounts/{account}/email/confirm', 'App\Http\Controllers\AccountEmailConfirmController');

    // アカウントメールアドレスの認証トークン検証
    Route::post('/accounts/{account}/email/verify', 'App\Http\Controllers\AccountEmailVerifyController');
  });
});
