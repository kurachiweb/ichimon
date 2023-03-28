<?php

declare(strict_types=1);

namespace App\Services\Account;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Repositories\Account\AccountLoginSessionCreateRepository;
use App\Repositories\Account\AccountLoginTargetRepository;
use App\Utilities\BundleIdToken;

class AccountLoginService {
    /**
     * アカウントにログインする
     *
     * @throws AuthorizationException
     */
    public function do(string $req_name, string $req_password, ?string $req_ip, ?string $req_user_agent): string {
        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $account_auth = (new AccountLoginTargetRepository())($req_name);
        if (!isset($account_auth)) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }
        $account_id = $account_auth[DbTableAccountAuth::ACCOUNT_ID];

        // そのアカウントのパスワードと入力値が一致するか
        $match_password = password_verify($req_password, $account_auth[DbTableAccountAuth::PASSWORD]);
        if (!$match_password) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // ログイントークンを生成
        $token = bin2hex(random_bytes(48));
        $bundled_id_token = BundleIdToken::bundle($account_id, $token);

        // ハッシュ化したログイントークンをDBに保存
        (new AccountLoginSessionCreateRepository())($account_id, $bundled_id_token, $req_ip, $req_user_agent);

        return $bundled_id_token;
    }
}
