<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use App\Models\Account\Account;

class AccountGetRepository {
    /**
     * アカウント取得
     *
     * @return \App\Models\Account\Account
     */
    public function __invoke(string $req_account_id, bool $also_relation = false) {
        $with = [];
        if ($also_relation) {
            $with = [
                'auth',
                'loginSessions',
                'manageSites',
                'notifications',
                'profileImages',
                'styling',
                'securityLogs',
            ];
        }

        // DBにアクセスし、IDからアカウント情報を取得
        return Account::with($with)->find($req_account_id);
    }
}
