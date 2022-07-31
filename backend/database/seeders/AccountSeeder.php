<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Constants\Db\Account\DbTableAccount;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_id = '00000l59q5fckcv53bm1w0z9vda4vbd';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account1 = [
            DbTableAccount::ID => $account_id,
            DbTableAccount::DISPLAY_ID => 'kurachi',
            DbTableAccount::NICKNAME => '倉地 俊輔',
            DbTableAccount::REGISTERED_AT => $registered_at,
            DbTableAccount::CREATED_AT => $created_at,
            DbTableAccount::UPDATED_AT => $registered_at,
            DbTableAccount::DELETED_AT => null,
        ];

        // 1アカウントで多大なバグを見つけようとする
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        // 2038年問題を乗り越えられるか
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');
        // 先頭スペース・イングランド国旗は超多バイト・RTl文字と!の方向も合わせるための制御文字・半角カタカナと濁点・𩸽はサロゲートペア・表はShift-JISだとバックスラッシュ・他の多様な記号・末尾タブ→全部イングランドの旗(DB上7文字分)で試す
        // $account_nickname = ' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	';
        $account_nickname = '🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿';

        $account2 = [
            DbTableAccount::ID => $account_id,
            DbTableAccount::DISPLAY_ID => 'test_super-longtest_super-long',
            DbTableAccount::NICKNAME => $account_nickname,
            DbTableAccount::REGISTERED_AT => $registered_at,
            DbTableAccount::CREATED_AT => $created_at,
            DbTableAccount::UPDATED_AT => $registered_at,
            DbTableAccount::DELETED_AT => null,
        ];

        DB::table('account')->insert([$account1, $account2]);
    }
}
