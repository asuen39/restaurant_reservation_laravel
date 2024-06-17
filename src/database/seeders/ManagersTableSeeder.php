<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // managersに挿入するデータを定義
        $managers = [
            [
                'name' => 'テスト店舗代表者',
                'email' => 'testmanagers@example.com',
                'password' => Hash::make('password'),
                'email_verification_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
        ];

        // managersテーブルにデータを挿入
        DB::table('managers')->insert($managers);
    }
}
