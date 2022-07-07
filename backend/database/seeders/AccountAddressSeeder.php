<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Utilities\Crypto;

class AccountAddressSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_address_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        $account_id = '00000l59q5fckcv53bm1w0z9vda4vbd';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account_address1 = [
            'id' => $account_address_id,
            'account_id' => $account_id,
            'post_code' => Crypto::toEncryptString('0000000'),
            // ISO 3166-1における国コードの数字版 392:日本
            'country' => 392,
            'region' => '石川県',
            'city' => Crypto::toEncryptString('金沢市'),
            'area1' => Crypto::toEncryptString('何渡河町1丁目5-3'),
            'area2' => Crypto::toEncryptString('シャルマンフジビルト・モアー住之江公園駅前アーバンヴィレッジ 204号室'),
            'use_for' => 0,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        $account_address_id = '00000l5b08bhpoxz5b5zc1gvmpfs1bq';
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');

        $account_address2 = [
            'id' => $account_address_id,
            'account_id' => $account_id,
            // ロンドンに実在する英字入り郵便番号
            'post_code' => Crypto::toEncryptString('SW1W0NY'),
            // ISO 3166-1における国コードの数字版 826:イギリス
            'country' => 826,
            'region' => '𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽',
            'city' => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            'area1' => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            'area2' => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            'use_for' => 0,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        DB::table('account_address')->insert([$account_address1, $account_address2]);
    }
}
