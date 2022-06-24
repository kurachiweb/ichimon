<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account\Account;

class AccountDeleteCase {
    /**
     * アカウント削除
     *
     * @param string $req_account_id
     * @return boolean
     */
    public function __invoke($req_account_id) {
        // 削除対象のアカウント
        $account = Account::findOrFail($req_account_id);
        $account_auth = $account->auth;
        if (!isset($account_auth)) {
            // アカウントが見つからない
            throw new ModelNotFoundException('Not found.', 400);
        }

        // リレーション制約エラーにならない順番で削除
        $account_auth->delete();
        $account->delete();

        return true;
    }
}
