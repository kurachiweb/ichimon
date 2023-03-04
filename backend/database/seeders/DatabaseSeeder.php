<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAddress;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Account\DbTableAccountHistory;
use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Constants\Db\Account\DbTableAccountVerifyEmail;

class DatabaseSeeder extends Seeder {
    /**
     * 全てのDBを対象に、初期データを生成する
     */
    public function run() {
        // truncate時、外部キー制約の検証を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table(DbTableAccount::TABLE_NAME)->truncate();
        DB::table(DbTableAccountHistory::TABLE_NAME)->truncate();
        DB::table(DbTableAccountAuth::TABLE_NAME)->truncate();
        DB::table(DbTableAccountAddress::TABLE_NAME)->truncate();
        DB::table(DbTableAccountLoginSession::TABLE_NAME)->truncate();
        DB::table(DbTableAccountVerifyEmail::TABLE_NAME)->truncate();

        $this->call([
            AccountSeeder::class,
            AccountHistorySeeder::class,
            AccountAuthSeeder::class,
            AccountAddressSeeder::class
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
