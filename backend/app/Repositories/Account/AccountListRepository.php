<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use App\Models\Account\Account;

class AccountListRepository {
    /**
     * アカウント一覧取得
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\Account\Account>
     */
    public function __invoke($columns = ['*']) {
        return Account::all($columns);
    }
}
