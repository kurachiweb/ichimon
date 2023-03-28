<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Models\Account\Account;
use App\Stores\AccountStore;

class AccountUpdateRepository {
    /**
     * アカウント基本情報更新
     */
    public function __invoke(Account $req_account): bool {
        // キャッシュに収めたデータがDBの保存データと一致しなくなるのを避けるため、削除
        (new AccountStore())->delete($req_account[DbTableAccount::ID]);

        // 更新を反映する
        $is_saved = $req_account->save();

        return $is_saved;
    }
}
