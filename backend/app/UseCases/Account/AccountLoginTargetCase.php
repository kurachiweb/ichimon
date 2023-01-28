<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\Account;
use App\Models\Account\AccountAuth;
use App\Utilities\Hash;

class AccountLoginTargetCase {
    /**
     * ログイン対象アカウント取得
     *
     * @param string $req_name
     * @param boolean $is_email
     * @return \App\Models\Account\Account
     */
    public function __invoke($req_name, $is_email) {
        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $account = null;
        $account_auth = null;
        if ($is_email) {
            $account_auth = AccountAuth::where(DbTableAccountAuth::EMAIL_HASH, Hash::toHashString($req_name))
                ->first();
        } else {
            $account = Account::with(['auth'])
                ->where(DbTableAccount::DISPLAY_ID, $req_name)
                ->first();
        }
        if ($account_auth) {
            $account = $account_auth->account;
        }
        return $account;
    }
}
