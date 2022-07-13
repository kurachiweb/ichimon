<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Models\Account\AccountLoginSession;
use App\Utilities\Hash;
use App\Utilities\Random;

class AccountLoginSessionCreateCase {
    /**
     * アカウントログインセッション作成
     *
     * @param string $req_account_id
     * @param string $req_token
     * @param string|null $req_ip
     * @param string|null $req_user_agent
     * @return \App\Models\Account\AccountLoginSession
     */
    public function __invoke($req_account_id, $req_token, $req_ip, $req_user_agent) {
        $account_session = (new AccountLoginSession())->toArray();
        $account_session['id'] = Random::dbPrimaryId();
        $account_session['account_id'] = $req_account_id;
        // ログイントークンをハッシュ化し、DBに保存
        $account_session['token_hash'] = Hash::toHashPassword($req_token);
        $account_session['ip_address'] = $req_ip;
        $account_session['user_agent'] = $req_user_agent;

        return AccountLoginSession::create($account_session);;
    }
}
