<?php

declare(strict_types=1);

namespace App\Services\Account;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Cookie;

use App\Constants\ConstBackend;
use App\Models\Account\AccountSession;
use App\UseCases\Account\AccountLoginTargetCase;
use App\Utilities\BundleIdToken;
use App\Utilities\Crypto;
use App\Utilities\Random;

class AccountLoginService {
    /**
     * アカウントにログインする
     *
     * @param string $req_name
     * @param string $req_password
     * @param string|null $req_ip
     * @param string|null $req_user_agent
     */
    public static function verify($req_name, $req_password, $req_ip, $req_user_agent) {
        if (is_null($req_name) || $req_name === '') {
            throw new AuthorizationException('Require \'name\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }
        if (is_null($req_password) || $req_password === '') {
            throw new AuthorizationException('Require \'password\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // @が2文字目以降にあればメールアドレス扱い
        $is_email = true;
        if (strpos($req_name, '@', 1) === false) {
            // @が無いか1文字目なら表示用ID扱い
            $is_email = false;
        }

        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $accountAuthGetCase = new AccountLoginTargetCase();
        $account = $accountAuthGetCase($req_name, $is_email);

        // アカウントが存在するか
        if (!$account) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }
        $account_auth = $account['auth'];

        // そのアカウントのパスワードが一致するか
        $match_password = password_verify($req_password, $account_auth['password']);
        if (!$match_password) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // ログイントークンを生成
        $token = bin2hex(random_bytes(48));
        $bundled_id_token = BundleIdToken::bundle($account['id'], $token);

        // ハッシュ化したログイントークンをDBに保存
        $account_session = AccountSession::getDefault(false);
        $account_session['id'] = Random::dbPrimaryId();
        $account_session['account_id'] = $account['id'];
        $account_session['token_hash'] = Crypto::toHashPassword($bundled_id_token);
        $account_session['ip_address'] = $req_ip;
        $account_session['user_agent'] = $req_user_agent;

        AccountSession::create($account_session);

        // ログイン状態を保持するため、Cookieを設定
        // 有効期限は24時間・基本的にnot secure・http-only
        Cookie::queue(ConstBackend::COOKIE_NAME_LOGIN_TOKEN, $bundled_id_token, config('session.lifetime'), '/', '', config('session.secure', true), true);
    }
}
