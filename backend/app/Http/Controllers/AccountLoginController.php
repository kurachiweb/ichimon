<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Constants\ConstBackend;
use Illuminate\Http\Request;

use App\Http\Requests\AccountLoginRequest;
use App\Services\Account\AccountLoginService;
use App\Utilities\ValidateRequest;
use Illuminate\Support\Facades\Cookie;

class AccountLoginController extends Controller {
    /**
     * アカウントにログインする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        // リクエスト中のログイン情報を入力チェック
        $req = ValidateRequest::json($request, new AccountLoginRequest());

        // アカウントにログインする
        $bundled_id_token = AccountLoginService::verify(
            $req['name'],
            $req['password'],
            $request->ip(),
            $request->userAgent()
        );

        // ログイン状態を保持するため、Cookieを設定
        // 有効期限は24時間・基本的にnot secure・http-only
        Cookie::queue(
            ConstBackend::COOKIE_NAME_LOGIN_TOKEN,
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
