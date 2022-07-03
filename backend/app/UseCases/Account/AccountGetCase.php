<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

class AccountGetCase {
    /**
     * アカウント取得
     *
     * @param string $req_account_id
     * @param boolean $relation
     * @return \App\Models\Account\Account
     */
    public function __invoke($req_account_id, $relation = false) {
        // アカウント基本IDからアカウントを取得
        $with = [];
        if ($relation) {
            $with = ['infos', 'auth', 'addresses'];
        }
        return Account::with($with)->findOrFail($req_account_id);
    }
}
