<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\AccountAuth;

class AccountAuthGetCase {
    /**
     * アカウント認証情報取得
     *
     * @return \App\Models\Account\AccountAuth
     */
    public function __invoke(string $req_account_id) {
        // アカウント基本IDからアカウント認証情報を取得
        return AccountAuth::where(DbTableAccountAuth::ACCOUNT_ID, $req_account_id)->firstOrFail();
    }
}
