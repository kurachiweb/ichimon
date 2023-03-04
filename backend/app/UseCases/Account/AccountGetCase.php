<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

class AccountGetCase {
    /**
     * アカウント取得
     *
     * @return \App\Models\Account\Account
     */
    public function __invoke(string $req_account_id, bool $also_relation = false) {
        $with = [];
        if ($also_relation) {
            $with = ['setting', 'auth', 'addresses'];
        }

        // DBにアクセスし、IDからアカウント情報を取得
        return Account::with($with)->findOrFail($req_account_id);
    }
}
