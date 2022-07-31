<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\AccountAuth;
use App\Utilities\KeysOnly;

class AuthVerifyEmailUpdateCase {
    /**
     * アカウントメール認証情報更新
     *
     * @param array $req_account_auth
     * @return bool
     */
    public function __invoke($req_account_auth) {
        // 更新対象のアカウント認証情報
        $account = AccountAuth::findOrFail($req_account_auth[DbTableAccountAuth::ID]);
        // 更新可能なカラムの絞り込み
        $account->fill(KeysOnly::select($req_account_auth, [
            DbTableAccountAuth::VERIFIED_EMAIL,
        ]));
        // 更新を反映する
        $is_saved = $account->saveOrFail();

        return $is_saved;
    }
}
