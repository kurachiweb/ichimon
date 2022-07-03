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
        $account_address_id = 't8ogk4gkco10fscufkswwcohk80ei1s';
        $account_id = 'nflannyhk3k0kswo804sck04gcso4ck';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        $account_address1 = [
            'id' => $account_address_id,
            'account_id' => $account_id,
            'post_code' => Crypto::toEncryptString('0000000'),
            'country' => 81,
            'region' => '石川県',
            'city' => Crypto::toEncryptString('金沢市'),
            'area1' => Crypto::toEncryptString('何渡河町'),
            'area2' => Crypto::toEncryptString('何渡河建物'),
            'use_for' => 0,
            'created_at' => $created_at,
            'updated_at' => $registered_at,
            'deleted_at' => null,
        ];

        $account_address_id = 'r7gr4z0jb6hsmhsvrd57yf8sbjtdbgc';
        $account_id = 'fqrvqr1uuxo2kzs70ff7mr6kxznzw7q';
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');

        $account_address2 = [
            'id' => $account_address_id,
            'account_id' => $account_id,
            // ロンドンに実在する英字入り郵便番号
            'post_code' => Crypto::toEncryptString('SW1W0NY'),
            'country' => 81,
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
