<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Models\Account\Account;

class AccountListCase {
    /**
     * アカウント一覧取得
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account\Account>
     */
    public function __invoke() {
        return Account::all([
            DbTableAccount::ID,
            DbTableAccount::NICKNAME,
            DbTableAccount::SELF_INTRO,
            DbTableAccount::REGISTERED_AT
        ]);
    }
}
