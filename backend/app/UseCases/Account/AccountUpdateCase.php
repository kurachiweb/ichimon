<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Models\Account\Account;
use App\Stores\AccountStore;
use App\Utilities\KeysOnly;

class AccountUpdateCase {
    /**
     * アカウント基本情報更新
     *
     * @param array $req_account
     * @return bool
     */
    public function __invoke($req_account) {
        // 更新対象のアカウント
        $account = Account::findOrFail($req_account[DbTableAccount::ID]);
        // 更新可能なカラムの絞り込み
        $account->fill(KeysOnly::select($req_account, [
            DbTableAccount::DISPLAY_ID,
            DbTableAccount::NICKNAME
        ]));
        // 更新を反映する
        $is_saved = $account->saveOrFail();

        // Redisにも同じ内容を保存する
        (new AccountStore())->saveById($account[DbTableAccount::ID]);

        return $is_saved;
    }
}
