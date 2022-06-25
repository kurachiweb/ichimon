<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

class AccountGetCase {
    /**
     * アカウント取得
     *
     * @param string $req_account_id
     * @return array
     */
    public function __invoke($req_account_id) {
        // アカウント基本IDからアカウントを取得
        $account = Account::findOrFail($req_account_id);
        $account_auth = $account->auth;
        $account = $account->toArray();
        $account['auth'] = $account_auth;

        return $account;
    }
}
