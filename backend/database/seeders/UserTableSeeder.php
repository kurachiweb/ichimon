<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $created_at = new DateTime();
        $created_at->setDate(2006, 1, 2)->setTime(15, 4, 5);
        $registered_at = new DateTime();
        $registered_at->setDate(2016, 4, 5)->setTime(22, 0, 47);

        DB::table('user')->insert([
            [
                'id' => 123456789,
                'display_id' => 'kurachi',
                'name' => '倉地 俊輔',
                'mail_address' => 'kurachiweb@gmail.com',
                // 'mail_address_alter' => null,
                'password' => 'abc123-todo-crypto',
                'password_updated_at' => $created_at,
                'tel_no' => '09012345678',
                'address' => '○○県○○市○○町○○番地○○ ○○○○○建物',
                'address_bill' => '○○県○○市○○町○○番地○○ ○○○○○建物',
                'registered_at' => $registered_at,
                'subscription_id' => 'sub_hogehoge',
                'created_at' => $registered_at,
                'updated_at' => $created_at,
                // 'deleted_at' => null,
            ],
        ]);
    }
}
