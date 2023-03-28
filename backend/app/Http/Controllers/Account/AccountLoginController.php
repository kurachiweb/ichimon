<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Constants\ConstBackend;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountLoginRequest;
use App\Services\Account\AccountLoginService;
use App\Utilities\ValidateRequest;

class AccountLoginController extends Controller {
    /**
     * アカウントにログインする
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        // リクエスト中のログイン情報を入力チェック
        $req = ValidateRequest::json($request, new AccountLoginRequest());

        // アカウントにログインする
        $bundled_id_token = (new AccountLoginService())->do($req['name'], $req['password'], $request->ip(), $request->userAgent());

        // ログイン状態を保持するため、Cookieを設定
        // 有効期限は24時間・基本的にnot secure・http-only
        Cookie::queue(
            ConstBackend::COOKIE_ACCOUNT_LOGIN_NAME,
            $bundled_id_token,
            config('session.lifetime'),
            '/',
            '',
            config('session.secure', true),
            true
        );

        return response()->success();
    }
}
