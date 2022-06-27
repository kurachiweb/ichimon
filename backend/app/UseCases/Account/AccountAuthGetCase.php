<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\AccountAuth;

class AccountAuthGetCase {
    /**
     * アカウント認証情報取得
     *
     * @param string $req_account_id
     * @return \App\Models\Account\AccountAuth
     */
    public function __invoke($req_account_id) {
        // アカウント基本IDからアカウント認証情報を取得
        return AccountAuth::where('account_id', $req_account_id)->firstOrFail();
    }
}
