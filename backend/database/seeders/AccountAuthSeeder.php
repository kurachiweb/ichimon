<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Seeder;

class AccountAuthSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_id = 123456789;
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        DB::table('account_auth')->insert([
            [
                'id' => 345678912,
                'account_id' => $account_id,
                'email' => Crypt::encryptString('kurachiweb@gmail.com'),
                'email_hash' => hash('sha3-512', 'kurachiweb@gmail.com'),
                'email_alter' => null,
                'verified_email' => 0,
                'verified_mobile_no' => 0,
                'password' => password_hash('testpass1234kanazaWa', PASSWORD_ARGON2ID),
                'password_updated_at' => $created_at,
                'billing_token' => null,
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                'deleted_at' => null,
            ],
        ]);
    }
}
