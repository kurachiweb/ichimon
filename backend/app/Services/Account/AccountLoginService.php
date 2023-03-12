<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;

use App\UseCases\Account\AccountLoginTargetCase;

class AccountLoginService {
    /**
     * アカウントにログインする
     */
    public static function verify(string $req_name, string $req_password) {
        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $account = (new AccountLoginTargetCase())($req_name);
        // アカウントが存在するか
        if (!$account) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }
        $account_auth = $account['auth'];

        // そのアカウントのパスワードと入力値が一致するか
        $match_password = password_verify($req_password, $account_auth[DbTableAccountAuth::PASSWORD]);
        if (!$match_password) {
            throw new AuthorizationException('Not match \'account\'.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // ログイントークンを生成
        $token = bin2hex(random_bytes(48));
        $id_token = ['id' => $account[DbTableAccount::ID], 'token' => $token];

        return $id_token;
    }
}
