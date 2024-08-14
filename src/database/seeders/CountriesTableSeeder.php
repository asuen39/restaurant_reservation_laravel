<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // countriesに挿入するデータを定義
        $countries = [
            ['countries' => '東京都'],
            ['countries' => '大阪府'],
            ['countries' => '福岡県'],
        ];

        // countriesテーブルにデータを挿入
        DB::table('countries')->insert($countries);
    }
}
