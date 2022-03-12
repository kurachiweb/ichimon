<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserAuthSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user_id = 123456789;
        $created_at = new DateTime();
        $created_at->setDate(2006, 1, 2)->setTime(15, 4, 5);
        $registered_at = new DateTime();
        $registered_at->setDate(2016, 4, 5)->setTime(22, 0, 47);

        /** testmailaddress@supercalifragilisticexpialidocioustestmailaddresssupercalifragilisticexpialidocious.supercalifragilisticexpialidocioustestmailaddresssupercalifragilisticexpialidocious_example-supercalifragilisticexpialidocioustestmailaddresssupercalifr.com をaes-256-cbcで暗号化した文字列及びsha3-512でハッシュ化した文字列 */
        $encrypted_email = 'eyJpdiI6IjNVUWtib084QVI2bzlLbnRVVklrSXc9PSIsInZhbHVlIjoiaTNoNVkycTRRS0dnamo2ZTlGTWZxdHJRaEdEa0o5aEJ5SGVFTytoY28za2NNcHpYUFlVWHFQamF2MjFKMWxZT0g4OHdMUDlSZW9oSFhtN0YybVVpejVCMmd5UVhkR2t4MnVUS2Y5bytMc0taeUVoTDg2ZFVoRFFBSjluK205eGZ2RG1oR1pFVWlGUFdveTZwckU5a3BnV0VpSVZYT2Frd3l1RlEvcDNNellkV093OG5rL2ROeit2YlN1czQyQ2RnRkZuMGN2VndWOWFRRXBVUGVqTGt5Umh5NW51dUV1bEpWRVhod2FpL0VqSVpvQXY4d25lWjJsbllyQ1d3ejBoSDg2V1ROV3p2RTV0VDdiMU1PTk1uakJ2OTAxZHRCSTZ1YllhamN1MWxXbEVSWlkxZUo0NjJqbEpoTHp0ajUxWUIxMG81OW9BV0pRazdFZGlPdkd3b1RpQ1ZrVFlPVFE5bFpyZnZyN0toc2k4PSIsIm1hYyI6IjFjNDhmMGY0M2MzNDEyMjQwNzU3ZjRhYTVkOGUwYTBkMDc2MDI0NTRjNjVmYTVjMDFkZDdiNTNmNTAzN2M5YzMiLCJ0YWciOiIifQ==';
        $hashed_email = '57cee59b269049126ac9973af4c7daac04f408d4ee0fecfab340b3ca704dda675d4600bedb7657542ff927a2d2f69eb6e91a18503461882432e4f70fc826ef65';
        /** password_hash_challenge をsha3-512でハッシュ化した文字列 */
        $hashed_password = '358b0b50c4a5859323c2f020157781fdb0a2d7cdda8227160e7eecbc5b689f40c5a04564ad93f9533e433ebd707bb16a059322b1cb16fd88e376c33f175db67c';

        DB::table('user_auth')->insert([
            [
                'id' => 345678912,
                'user_id' => $user_id,
                'email' => $encrypted_email,
                'email_hash' => $hashed_email,
                // 'email_alter' => null,
                'password' => $hashed_password,
                'billing_token' => 'sub_hogehoge',
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                // 'deleted_at' => null,
            ],
        ]);
    }
}
