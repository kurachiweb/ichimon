<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Utilities\Crypto;

class AccountAuthSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_id = 12345678901;
        $account_auth_id = 34567890123;
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        DB::table('account_auth')->insert([
            [
                'id' => $account_auth_id,
                'account_id' => $account_id,
                'email' => Crypto::toEncryptString('kurachiweb@gmail.com'),
                'email_hash' => Crypto::toHashString('kurachiweb@gmail.com'),
                'email_alter' => null,
                'verified_email' => 0,
                'verified_mobile_no' => 0,
                'password' => Crypto::toHashPassword('testpass1234kanazaWa'),
                'password_updated_at' => $created_at,
                'billing_token' => null,
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                'deleted_at' => null,
            ],
        ]);
    }
}
