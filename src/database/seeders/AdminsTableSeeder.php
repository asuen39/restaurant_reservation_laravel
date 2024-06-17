<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // adminsに挿入するデータを定義
        $admins = [
            [
                'name' => 'テスト管理者',
                'email' => 'testadmin@example.com',
                'password' => Hash::make('password'),
                'email_verification_token' => Str::random(10),
                'email_verified_at' => now(),
            ],
        ];

        // adminsテーブルにデータを挿入
        DB::table('admins')->insert($admins);
    }
}
