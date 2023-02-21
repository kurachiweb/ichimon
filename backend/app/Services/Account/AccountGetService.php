<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Stores\AccountStore;
use App\UseCases\Account\AccountGetCase;

class AccountGetService {
    /**
     * アカウント情報を取得する
     *
     * @param string $req_account_id
     * @return array
     */
    public static function get($req_account_id) {
        // まずはキャッシュを見る
        $store = new AccountStore();
        $account_stored = $store->get($req_account_id);
        if (is_array($account_stored)) {
            return $account_stored;
        }

        // 無ければDBから取得する
        $account_saved = (new AccountGetCase())($req_account_id, true)->toArray();

        // DBから得たアカウント情報を、キャッシュに保存
        $store->save($account_saved);

        return $account_saved;
    }
}
