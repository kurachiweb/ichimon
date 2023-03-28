<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Repositories\Account\AccountDeleteRepository;
use App\Repositories\Account\AccountGetRepository;

class AccountDeleteService {
    /**
     * アカウント情報を削除する
     */
    public function do(string $req_account_id) {
        // 削除対象のアカウント
        $account = (new AccountGetRepository())($req_account_id);
        if (!isset($account)) {
            return;
        }

        // DBにアクセスしてアカウントを削除する
        (new AccountDeleteRepository())($account);
    }
}
