<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Models\Account\Account;
use App\Stores\AccountStore;

class AccountDeleteRepository {
    /**
     * アカウント削除
     */
    public function __invoke(Account $req_account): bool|null {
        // アカウントを削除した後に、キャッシュデータが残っている状況を避けるため、削除
        (new AccountStore())->delete($req_account[DbTableAccount::ID]);

        // 関連するテーブルのレコードも併せて削除
        $req_account->auth()->delete();
        $req_account->loginSessions()->delete();
        $req_account->manageSites()->delete();
        $req_account->notifications()->delete();
        $req_account->profileImages()->delete();
        $req_account->styling()->delete();
        $req_account->securityLogs()->delete();
        $req_account->surveys()->delete();
        $is_deleted = $req_account->delete();

        return $is_deleted;
    }
}
