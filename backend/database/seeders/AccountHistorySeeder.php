<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Constants\Db\Account\DbTableAccountHistory;
use App\Utilities\Crypto;

class AccountHistorySeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_history_id = '00000l5b04ot4u8xgp1fdnhd6lzqdgp';
        $account_id = '00000l59q5fckcv53bm1w0z9vda4vbd';
        $birthday = new Carbon('2000-10-18');
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account_history1 = [
            DbTableAccountHistory::ID => $account_history_id,
            DbTableAccountHistory::ACCOUNT_ID => $account_id,
            DbTableAccountHistory::FIRST_NAME => Crypto::toEncryptString('倉地'),
            DbTableAccountHistory::MIDDLE_NAME => Crypto::toEncryptString(null),
            DbTableAccountHistory::LAST_NAME => Crypto::toEncryptString('俊輔'),
            DbTableAccountHistory::SEX => 1,
            DbTableAccountHistory::BIRTHDAY => $birthday,
            DbTableAccountHistory::CREATED_AT => $created_at,
            DbTableAccountHistory::UPDATED_AT => $registered_at,
            DbTableAccountHistory::DELETED_AT => null,
        ];

        $account_history_id = '00000l5b07nnjop6z3r2lc1j56tvz65';
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        // UNIX時刻基準の1970年1月1日より前で、かつ閏日
        $birthday = new Carbon('1920-02-29');
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');

        $account_history2 = [
            DbTableAccountHistory::ID => $account_history_id,
            DbTableAccountHistory::ACCOUNT_ID => $account_id,
            DbTableAccountHistory::FIRST_NAME => Crypto::toEncryptString(' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"'),
            DbTableAccountHistory::MIDDLE_NAME => Crypto::toEncryptString(' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	'),
            DbTableAccountHistory::LAST_NAME => Crypto::toEncryptString('あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	'),
            DbTableAccountHistory::SEX => 3,
            DbTableAccountHistory::BIRTHDAY => $birthday,
            DbTableAccountHistory::CREATED_AT => $created_at,
            DbTableAccountHistory::UPDATED_AT => $registered_at,
            DbTableAccountHistory::DELETED_AT => null,
        ];

        DB::table('account_history')->insert([$account_history1, $account_history2]);
    }
}
