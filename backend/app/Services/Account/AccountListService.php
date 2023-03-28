<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Repositories\Account\AccountListRepository;

class AccountListService {
    /**
     * アカウント情報を取得する
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account\Account>
     */
    public function do() {
        // DBからアカウント一覧を取得する
        $res_accounts = (new AccountListRepository())([
            DbTableAccount::ID,
            DbTableAccount::NICKNAME,
            DbTableAccount::SELF_INTRO,
            DbTableAccount::REGISTERED_AT
        ]);

        return $res_accounts;
    }
}
