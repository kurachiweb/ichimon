<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

class AccountGetCase {
    /**
     * アカウント取得
     *
     * @param string $req_account_id
     * @param boolean $relation 関連テーブルからも一度に取得すか
     * @return \App\Models\Account\Account
     */
    public function __invoke($req_account_id, $relation = false) {
        $with = [];
        if ($relation) {
            $with = ['setting', 'auth', 'addresses'];
        }

        // DBにアクセスし、IDからアカウント情報を取得
        return Account::with($with)->findOrFail($req_account_id);
    }
}
