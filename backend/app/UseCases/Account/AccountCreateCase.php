<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use Carbon\Carbon;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\Account;
use App\Models\Account\AccountAuth;
use App\Stores\AccountStore;
use App\Utilities\Random;

class AccountCreateCase {
    /**
     * アカウント作成
     *
     * @return \App\Models\Account\Account
     */
    public function __invoke(array $req_account) {
        $account = (new Account())->toArray();
        $account_auth = (new AccountAuth())->toArray();

        $now = Carbon::now(config('app.timezone'));
        $account_id = Random::dbPrimaryId();

        // アカウント基本情報をリクエスト内容で上書き
        $account[DbTableAccount::ID] = $account_id;
        $account[DbTableAccount::NICKNAME] = $req_account['nickname'];
        $account[DbTableAccount::SELF_INTRO] = $req_account['self_intro'];
        $account[DbTableAccount::REGISTERED_AT] = $now;

        // アカウント認証情報をリクエスト内容で上書き
        $account_auth[DbTableAccountAuth::ACCOUNT_ID] = $account_id;
        $account_auth[DbTableAccountAuth::EMAIL] = $req_account['email'];
        $account_auth[DbTableAccountAuth::EMAIL_HASH] = $req_account['email'];
        $account_auth[DbTableAccountAuth::PASSWORD] = $req_account['password'];
        $account_auth[DbTableAccountAuth::PASSWORD_UPDATED_AT] = $now;

        $res_account = Account::create($account);
        $res_account_auth = AccountAuth::create($account_auth);
        $res_account = $res_account->toArray();
        $res_account['auth'] = $res_account_auth->toArray();

        // キャッシュにも登録したアカウント情報を保存する
        (new AccountStore())->save($res_account);

        return $res_account;
    }
}
