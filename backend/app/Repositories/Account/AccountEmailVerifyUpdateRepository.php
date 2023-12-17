<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\AccountAuth;
use App\Utilities\KeysOnly;

class AccountEmailVerifyUpdateRepository {
    /**
     * アカウントメール認証情報更新
     */
    public function __invoke(array $req_account_auth): bool {
        // 更新対象のアカウント認証情報
        $account_auth = AccountAuth::find($req_account_auth[DbTableAccountAuth::ID]);
        if (!isset($account_auth)) {
            return false;
        }
        // 更新可能なカラムの絞り込み
        $account_auth->fill(KeysOnly::select($req_account_auth, [
            DbTableAccountAuth::VERIFIED_EMAIL,
        ]));
        // 更新を反映する
        $is_saved = $account_auth->saveOrFail();

        return $is_saved;
    }
}