<?php

declare(strict_types=1);

namespace App\Repositories\Account;

use Illuminate\Support\Facades\DB;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\Account\AccountAuth;

class AccountCreateRepository {
    /**
     * アカウント情報を作成する
     */
    public function __invoke(array $req_account, array $req_auth): string {
        DB::connection(DbConnectionName::ACCOUNT)->beginTransaction();
        try {
            $res_account = Account::create($req_account)->toArray();
            $res_account_id = $res_account[DbTableAccount::ID];

            $req_auth[DbTableAccountAuth::ACCOUNT_ID] = $res_account_id;
            AccountAuth::create($req_auth);

            DB::connection(DbConnectionName::ACCOUNT)->commit();
        } catch (\Throwable $e) {
            DB::connection(DbConnectionName::ACCOUNT)->rollBack();
            return '';
        }

        return $res_account_id;
    }
}
