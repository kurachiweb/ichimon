<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use Carbon\Carbon;

use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Models\Account\AccountLoginSession;
use App\Utilities\Hash;

class AccountLoginSessionCreateRepository {
    /**
     * アカウントログインセッション作成
     *
     * @return \App\Models\Account\AccountLoginSession
     */
    public function __invoke(string $req_account_id, string $req_token, ?string $req_ip, ?string $req_user_agent) {
        $now = Carbon::now(config('app.timezone'));

        $account_session = (new AccountLoginSession())->toArray();
        $account_session[DbTableAccountLoginSession::ACCOUNT_ID] = $req_account_id;
        // ログイントークンをハッシュ化し、DBに保存
        $account_session[DbTableAccountLoginSession::TOKEN_HASH] = Hash::toHashPassword($req_token);
        $account_session[DbTableAccountLoginSession::IP_ADDRESS] = $req_ip;
        $account_session[DbTableAccountLoginSession::USER_AGENT] = $req_user_agent;
        $account_session[DbTableAccountLoginSession::LAST_LOGIN_AT] = $now;

        return AccountLoginSession::create($account_session);;
    }
}
