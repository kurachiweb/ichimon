<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;

use App\Constants\Db\Account\DbTableAccount;

class AccountListCase {
    /**
     * アカウント一覧取得
     *
     * @param array $req_account
     * @return array<int, array>
     */
    public function __invoke() {
        return Account::all([
            DbTableAccount::ID,
            DbTableAccount::DISPLAY_ID,
            DbTableAccount::NICKNAME,
            DbTableAccount::REGISTERED_AT
        ]);
    }
}
