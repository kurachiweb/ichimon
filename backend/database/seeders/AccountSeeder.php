<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Utilities\StringEncrypt;

class AccountSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_id = 12345678901;
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');

        DB::table('account')->insert([
            [
                'id' => $account_id,
                'display_id' => 'kurachi',
                'name' => '倉地 俊輔',
                'tel_no' => StringEncrypt::encrypt('0123123456'),
                'mobile_no' => StringEncrypt::encrypt('09012345678'),
                'address' => StringEncrypt::encrypt('石川県○○市○○町○○番地○○ ○○○○○建物'),
                'address_bill' => StringEncrypt::encrypt('石川県○○市○○町○○番地○○ ○○○○○建物'),
                'registered_at' => $registered_at,
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                'deleted_at' => null,
            ],
        ]);
    }
}
