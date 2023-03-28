<?php

declare(strict_types=1);

namespace App\Services\Account;

use Carbon\Carbon;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\Account;
use App\Models\Account\AccountAuth;
use App\Repositories\Account\AccountCreateRepository;
use App\Repositories\Account\AccountGetRepository;

class AccountCreateService {
    /**
     * アカウント情報を作成する
     *
     * @return \App\Models\Account\Account
     */
    public function do(array $req) {
        $now = Carbon::now(config('app.timezone'));

        // アカウント基本情報をリクエスト内容で上書き
        $account = (new Account())->toArray();
        $account[DbTableAccount::NICKNAME] = $req['nickname'];
        $account[DbTableAccount::SELF_INTRO] = $req['self_intro'];
        $account[DbTableAccount::REGISTERED_AT] = $now;

        // アカウント認証情報をリクエスト内容で上書き
        $account_auth = (new AccountAuth())->toArray();
        $account_auth[DbTableAccountAuth::EMAIL] = $req['email'];
        $account_auth[DbTableAccountAuth::EMAIL_HASH] = $req['email'];
        $account_auth[DbTableAccountAuth::PASSWORD] = $req['password'];
        $account_auth[DbTableAccountAuth::PASSWORD_UPDATED_AT] = $now;

        // DBに保存する
        $res_account_id = (new AccountCreateRepository())($account, $account_auth);

        $res_account = (new AccountGetRepository())($res_account_id, true);

        return $res_account;
    }
}
