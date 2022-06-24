<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\AccountUpdate;

class AccountUpdateCase {
    /**
     * アカウント更新
     *
     * @param array $req_account
     * @return bool
     */
    public function __invoke($req_account) {
        // 更新対象のアカウント
        $account = AccountUpdate::findOrFail($req_account['id']);
        $account->fill($req_account);

        // 更新を反映する(更新可能カラムはモデルで定義済み)
        $is_saved = $account->saveOrFail();

        return $is_saved;
    }
}
