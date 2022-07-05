<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

class AccountListCase {
    /**
     * アカウント一覧取得
     *
     * @param array $req_account
     * @return array<int, array>
     */
    public function __invoke() {
        return Account::all([
            'id',
            'display_id',
            'nickname',
            'registered_at'
        ]);
    }
}
