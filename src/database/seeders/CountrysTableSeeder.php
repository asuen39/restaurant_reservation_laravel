<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // countrysに挿入するデータを定義
        $countrys = [
            ['countrys' => '東京都'],
            ['countrys' => '大阪府'],
            ['countrys' => '福岡県'],
        ];

        // countrysテーブルにデータを挿入
        DB::table('countrys')->insert($countrys);
    }
}
