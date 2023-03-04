<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Constants\ConstBackend;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountLoginRequest;
use App\Services\Account\AccountLoginService;
use App\UseCases\Account\AccountLoginSessionCreateCase;
use App\Utilities\BundleIdToken;
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
        $verifyied = AccountLoginService::verify($req['name'], $req['password']);

        $res_account_id = $verifyied['id'];
        $bundled_id_token = BundleIdToken::bundle($res_account_id, $verifyied['token']);

        // ハッシュ化したログイントークンをDBに保存
        (new AccountLoginSessionCreateCase())($res_account_id, $bundled_id_token, $request->ip(), $request->userAgent());

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

        return response()->success(['account_id' => $res_account_id]);
    }
}
