<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;
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
        $account = Account::findOrFail($req_account['id']);
        // 更新可能なカラムの絞り込み
        $account->fill(KeysOnly::select($req_account, [
            'display_id',
            'nickname'
        ]));
        // 更新を反映する
        $is_saved = $account->saveOrFail();

        return $is_saved;
    }
}
