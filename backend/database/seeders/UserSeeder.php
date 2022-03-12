<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Seeder;

use DateTime;

class UserSeeder extends Seeder {
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

        DB::table('user')->insert([
            [
                'id' => $user_id,
                'display_id' => 'kurachi',
                'name' => '倉地 俊輔',
                'password_updated_at' => $created_at,
                'tel_no' => Crypt::encryptString('09012345678'),
                'address' => Crypt::encryptString('石川県○○市○○町○○番地○○ ○○○○○建物'),
                'address_bill' => Crypt::encryptString('石川県○○市○○町○○番地○○ ○○○○○建物'),
                'registered_at' => $registered_at,
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                // 'deleted_at' => null,
            ],
        ]);
    }
}
