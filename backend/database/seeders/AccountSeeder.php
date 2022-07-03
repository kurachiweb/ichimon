<?php

declare(strict_types=1);

namespace Database\Seeders;

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
        $account_id = 'nflannyhk3k0kswo804sck04gcso4ck';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account1 = [
            'id' => $account_id,
            'display_id' => 'kurachi',
            'nickname' => '倉地 俊輔',
            'registered_at' => $registered_at,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        // 1アカウントで多大なバグを見つけようとする
        $account_id = 'fqrvqr1uuxo2kzs70ff7mr6kxznzw7q';
        // 2038年問題を乗り越えられるか
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');
        // 先頭スペース・イングランド国旗は超多バイト・RTl文字と!の方向も合わせるための制御文字・半角カタカナと濁点・𩸽はサロゲートペア・表はShift-JISだとバックスラッシュ・他の多様な記号・末尾タブ→全部イングランドの旗(DB上7文字分)で試す
        // $account_nickname = ' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	';
        $account_nickname = '🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿🏴󠁧󠁢󠁥󠁮󠁧󠁿';

        $account2 = [
            'id' => $account_id,
            'display_id' => 'test_super-longtest_super-long',
            'nickname' => $account_nickname,
            'registered_at' => $registered_at,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        DB::table('account')->insert([$account1, $account2]);
    }
}
