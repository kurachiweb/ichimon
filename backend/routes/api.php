<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Master\MasterGetController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\AccountEmailConfirmController;
use App\Http\Controllers\Account\AccountEmailVerifyController;
use App\Http\Controllers\Account\AccountLoginController;

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

// マスタ情報取得
Route::get('/masters', MasterGetController::class);

// アカウント作成
Route::apiResource('/accounts', AccountController::class, ['only' => ['store']]);
// アカウントログイン
Route::post('/accounts/login', AccountLoginController::class);

// ログイン状態なら
Route::group(['middleware' => ['account.auth:authz']], function () {
  // アカウント基礎情報・認証情報のRUD
  Route::apiResource('/accounts', AccountController::class, ['only' => ['index']]);

  // ログインユーザーを認証できれば
  Route::group(['middleware' => ['account.auth:authr']], function () {
    // アカウント基礎情報・認証情報のRUD
    Route::apiResource('/accounts', AccountController::class, ['except' => ['index', 'store']]);

    // アカウントメールアドレスの認証メール送信
    Route::post('/accounts/{account}/email/confirm', AccountEmailConfirmController::class);

    // アカウントメールアドレスの認証トークン検証
    Route::post('/accounts/{account}/email/verify', AccountEmailVerifyController::class);
  });
});
