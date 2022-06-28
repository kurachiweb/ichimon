<?php

declare(strict_types=1);

namespace App\Services\Account;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Cookie;

use App\Constants\ConstBackend;
use App\UseCases\Account\AccountLoginTargetCase;
use App\UseCases\Account\AccountSessionCreateCase;
use App\Utilities\BundleIdToken;

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

        // そのアカウントのパスワードと入力値が一致するか
        $match_password = password_verify($req_password, $account_auth['password']);
        if (!$match_password) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // ログイントークンを生成
        $token = bin2hex(random_bytes(48));
        $bundled_id_token = BundleIdToken::bundle($account['id'], $token);

        // ハッシュ化したログイントークンをDBに保存
        $accountSessionCreateCase = new AccountSessionCreateCase();
        $accountSessionCreateCase($account['id'], $bundled_id_token, $req_ip, $req_user_agent);

        return $bundled_id_token;
    }
}
