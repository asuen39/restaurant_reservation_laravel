<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // genresに挿入するデータを定義
        $genres = [
            ['genres' => '寿司'],
            ['genres' => '焼肉'],
            ['genres' => '居酒屋'],
            ['genres' => 'イタリアン'],
            ['genres' => 'ラーメン'],
        ];

        // genresテーブルにデータを挿入
        DB::table('genres')->insert($genres);
    }
}
