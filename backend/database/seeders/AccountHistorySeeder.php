<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

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
            'id' => $account_history_id,
            'account_id' => $account_id,
            'first_name' => Crypto::toEncryptString('倉地'),
            'middle_name' => Crypto::toEncryptString(null),
            'last_name' => Crypto::toEncryptString('俊輔'),
            'sex' => 1,
            'birthday' => $birthday,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        $account_history_id = '00000l5b07nnjop6z3r2lc1j56tvz65';
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        // UNIX時刻基準の1970年1月1日より前で、かつ閏日
        $birthday = new Carbon('1920-02-29');
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');

        $account_history2 = [
            'id' => $account_history_id,
            'account_id' => $account_id,
            'first_name' => Crypto::toEncryptString(' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"'),
            'middle_name' => Crypto::toEncryptString(' ｳﾞｨ🏴󠁧󠁢󠁥󠁮󠁧󠁿fF5الويب!‏"あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	'),
            'last_name' => Crypto::toEncryptString('あ𩸽表あいう!"#$%&\'()=~|`{+*}<>?_\\`	'),
            'sex' => 3,
            'birthday' => $birthday,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        DB::table('account_history')->insert([$account_history1, $account_history2]);
    }
}
