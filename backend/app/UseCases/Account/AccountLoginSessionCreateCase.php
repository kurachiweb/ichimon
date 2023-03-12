<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Models\Account\AccountLoginSession;
use App\Utilities\Hash;
use App\Utilities\Random;

class AccountLoginSessionCreateCase {
    /**
     * アカウントログインセッション作成
     *
     * @return \App\Models\Account\AccountLoginSession
     */
    public function __invoke(string $req_account_id, string $req_token, ?string $req_ip, ?string $req_user_agent) {
        $account_session = (new AccountLoginSession())->toArray();
        $account_session[DbTableAccountLoginSession::ACCOUNT_ID] = $req_account_id;
        // ログイントークンをハッシュ化し、DBに保存
        $account_session[DbTableAccountLoginSession::TOKEN_HASH] = Hash::toHashPassword($req_token);
        $account_session[DbTableAccountLoginSession::IP_ADDRESS] = $req_ip;
        $account_session[DbTableAccountLoginSession::USER_AGENT] = $req_user_agent;

        return AccountLoginSession::create($account_session);;
    }
}
