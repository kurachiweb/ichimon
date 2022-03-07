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

        DB::table('user_auth')->insert([
            [
                'id' => 345678912,
                'user_id' => $user_id,
                'email' => 'eyJpdiI6Im0xSndNYmt2NWJpV0Y0Nmo5enozRVE9PSIsInZhbHVlIjoiTE9UVHZnMGhsYXNvM25xSldXamFVU2s0TDVwVk5VQXlsR1BRVFpaRWU2S041bXNlVkIxQXBNTEVEdXowejk1cEtBRUxYSjBlUG14c21oOTlzODJ3Y1B1YnNvOVRMeUhLRkVIdGw2b1I2RHdoWEY2MjIvVWtrT1ZnVEdCUlBFN1JFdVJuWmwrc0VlV25UNGkxc0psS3Z5R0pkVldhOHUrSDg5eWx4VDFGWTh6VmVMd3Rjc1VrelpRKy9iT1lSQW8yK0c0MXg3ZVRkdlhNUFFqdUoyRXlCZVY0VE5wcjJiTzVEV01ZSkY3YlM2b0FMNUpKOXJxRVJCMUJuUDJ3aGZDMy9zWVA5dS9aQ29XUE1ObHVYZFZPSW5NOER5T0xBNWg3a2V5eG9Vd2FmcjVPTWh0OFEwRDVCMGwxcERQbGhqenVtT096cnZOUXhsbEF3eHlFcy80YTNtYmRsWThEc09nQWJ3NzVQdXkreWhRPSIsIm1hYyI6ImY5NDIxNmU4ZWY2Nzg1OGI4MzRiNDA4NTFlYjUxZGQ4Y2NlMmE4NWNmY2M1MWFmMWNmMjVkZGZmZTE0NGNjYjkiLCJ0YWciOiIifQ==',
                // 'email_alter' => null,
                'password' => 'eyJpdiI6InFqWkhNTHg4cHNBUFdkcklyUlJia3c9PSIsInZhbHVlIjoiVWxBNEsrUXBIODFicjZSY1VWUlQzeStIYTlOQ0FjeXB2RlQyRSswUUErQT0iLCJtYWMiOiI4ZDBmYTZkYTI5MWMxOGVkOTU1MWFkN2RjOGM2NWQyODBkMzZlMmI0ZDkwYTA5NzQ1ZjllY2I0MmUzM2MxNWVmIiwidGFnIjoiIn0',
                'subscription_id' => 'sub_hogehoge',
                'created_at' => $created_at,
                'updated_at' => $registered_at,
                // 'deleted_at' => null,
            ],
        ]);
    }
}
