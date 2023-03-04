<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Constants\Db\Account\DbTableAccountAddress;
use App\Utilities\Crypto;

class AccountAddressSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run() {
        $account_address_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        $account_id = '00000l59q5fckcv53bm1w0z9vda4vbd';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account_address1 = [
            DbTableAccountAddress::ID => $account_address_id,
            DbTableAccountAddress::ACCOUNT_ID => $account_id,
            DbTableAccountAddress::POST_CODE => Crypto::toEncryptString('0000000'),
            // ISO 3166-1における国コードの数字版 392:日本
            DbTableAccountAddress::COUNTRY => 392,
            DbTableAccountAddress::REGION => '石川県',
            DbTableAccountAddress::CITY => Crypto::toEncryptString('金沢市'),
            DbTableAccountAddress::AREA1 => Crypto::toEncryptString('何渡河町1丁目5-3'),
            DbTableAccountAddress::AREA2 => Crypto::toEncryptString('シャルマンフジビルト・モアー住之江公園駅前アーバンヴィレッジ 204号室'),
            DbTableAccountAddress::USE_FOR => 0,
            DbTableAccountAddress::CREATED_AT => $created_at,
            DbTableAccountAddress::UPDATED_AT => $registered_at,
            DbTableAccountAddress::DELETED_AT => null,
        ];

        $account_address_id = '00000l5b08bhpoxz5b5zc1gvmpfs1bq';
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');

        $account_address2 = [
            DbTableAccountAddress::ID => $account_address_id,
            DbTableAccountAddress::ACCOUNT_ID => $account_id,
            // ロンドンに実在する英字入り郵便番号
            DbTableAccountAddress::POST_CODE => Crypto::toEncryptString('SW1W0NY'),
            // ISO 3166-1における国コードの数字版 826:イギリス
            DbTableAccountAddress::COUNTRY => 826,
            DbTableAccountAddress::REGION => '𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽𩸽',
            DbTableAccountAddress::CITY => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            DbTableAccountAddress::AREA1 => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            DbTableAccountAddress::AREA2 => Crypto::toEncryptString('𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫𩸽𠀳𠁙𠀾𠀿𠁀𠁎𠂉𠂤𠃅𠃵𠅘𠅍𠆢𠆤𠊙𠊜𠊞𠊷𠋥𠋦𠌥𠍆𠎊𠎠𥧄𥫩𥯪𣱆𣱽𣲚𣴛𦐒𦒘𦗝𦖭𦘩𦙱𦝋𦝺𦟻𩠘𩠭𩥋𩦝𩮭𪐀𪐴𪘚𪗱𪛅𡐚𡒊𡓈𡔍𡔔𡗊𡙧𡜺𥱫'),
            DbTableAccountAddress::USE_FOR => 0,
            DbTableAccountAddress::CREATED_AT => $created_at,
            DbTableAccountAddress::UPDATED_AT => $registered_at,
            DbTableAccountAddress::DELETED_AT => null,
        ];

        DB::table(DbTableAccountAddress::TABLE_NAME)->insert([$account_address1, $account_address2]);
    }
}
