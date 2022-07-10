<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\Account;
use App\Stores\AccountStore;

class AccountGetCase {
    /**
     * アカウント取得
     *
     * @param string $req_account_id
     * @param boolean $relation 関連テーブルからも一度に取得すか
     * @param boolean $forceDb 保存領域ではなく必ずDBから取得するか
     * @return \App\Models\Account\Account
     */
    public function __invoke($req_account_id, $relation = false, $forceDb = false) {
        $with = [];
        if ($relation) {
            $with = ['setting', 'auth', 'addresses'];
        }

        if (!$forceDb) {
            // DBからの取得が強制でなければ、まずは保存領域を見る
            $account_stored = (new AccountStore())->get($req_account_id);
            if (is_array($account_stored)) {
                // 保存領域にアカウント情報があればそれを返す
                return $account_stored;
            }
        }

        // DBにアクセスし、IDからアカウント情報を取得
        return Account::with($with)->findOrFail($req_account_id);
    }
}
