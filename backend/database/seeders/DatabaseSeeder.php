<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // truncate時、外部キー制約の検証を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('account')->truncate();
        DB::table('account_auth')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            AccountSeeder::class,
            AccountAuthSeeder::class
        ]);
    }
}
