<?php

namespace Database\Seeders;

use DateTime;
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
        $created_at = new DateTime();
        $created_at->setDate(2006, 1, 2)->setTime(15, 4, 5);
        $registered_at = new DateTime();
        $registered_at->setDate(2016, 4, 5)->setTime(22, 0, 47);

        DB::table('account_auth')->insert([
            [
                'id' => 345678912,
                'account_id' => $account_id,
                'email' => Crypt::encryptString('kurachiweb@gmail.com'),
                'email_hash' => hash('sha3-256', 'kurachiweb@gmail.com'),
                // 'email_alter' => null,
                'password' => hash('sha3-256', 'testpass1234kanazaWa'),
                // 'billing_token' => null, 
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                // 'deleted_at' => null,
            ],
        ]);
    }
}
