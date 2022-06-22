<?php

declare(strict_types=1);

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
        DB::table('account_session')->truncate();
        DB::table('verify_email_token')->truncate();

        $this->call([
            AccountSeeder::class,
            AccountAuthSeeder::class
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
