<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\AccountAuth;
use App\Utilities\Hash;

class AccountLoginTargetCase {
    /**
     * ログイン対象アカウント取得
     *
     * @return \App\Models\Account\Account|null
     */
    public function __invoke(string $req_name) {
        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $account_auth = AccountAuth::firstWhere(
            DbTableAccountAuth::EMAIL_HASH,
            Hash::toHashString($req_name)
        );
        if (!$account_auth) {
            return null;
        }
        return $account_auth->account;
    }
}
