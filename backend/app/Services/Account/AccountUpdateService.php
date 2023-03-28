<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Repositories\Account\AccountGetRepository;
use App\Repositories\Account\AccountUpdateRepository;

class AccountUpdateService {
    /**
     * アカウント情報を更新する
     */
    public function do(array $req) {
        // 更新対象のアカウント
        $account = (new AccountGetRepository())($req[DbTableAccount::ID]);
        if (!isset($account)) {
            return;
        }
        $profile_images = $account->profileImages();
        //@todo プロフィール画像も更新する

        $account[DbTableAccount::NICKNAME] = $req['nickname'];
        $account[DbTableAccount::SELF_INTRO] = $req['self_intro'];

        // DBにアクセスしてアカウントを更新する
        (new AccountUpdateRepository())($account);
    }
}
