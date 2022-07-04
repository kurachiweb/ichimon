<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use Carbon\Carbon;

use App\Models\Account\Account;
use App\Models\Account\AccountAuth;
use App\Utilities\Random;

class AccountCreateCase {
    /**
     * アカウント作成
     *
     * @param array $req_account
     * @return \App\Models\Account\Account
     */
    public function __invoke($req_account) {
        $account = (new Account())->toArray();
        $account_auth = (new AccountAuth())->toArray();

        $now = Carbon::now('UTC');
        $account_id = Random::dbPrimaryId();
        $account_auth_id = Random::dbPrimaryId();

        // アカウント基本情報をリクエスト内容で上書き
        $account['id'] = $account_id;
        $account['display_id'] = $req_account['display_id'];
        $account['registered_at'] = $now;

        // アカウント認証情報をリクエスト内容で上書き
        $account_auth['id'] = $account_auth_id;
        $account_auth['account_id'] = $account_id;
        $account_auth['email'] = $req_account['auth']['email'];
        $account_auth['email_hash'] = $req_account['auth']['email'];
        $account_auth['password'] = $req_account['auth']['password'];
        $account_auth['password_updated_at'] = $now;

        $res_account = Account::create($account);
        $res_account_auth = AccountAuth::create($account_auth);
        $res_account = $res_account->toArray();
        $res_account['auth'] = $res_account_auth->toArray();

        return $res_account;
    }
}
