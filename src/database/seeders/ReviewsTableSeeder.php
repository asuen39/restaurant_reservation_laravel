<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーのIDを取得
        $user = DB::table('users')->where('name', 'テスト太郎')->first();

        //reservationsのID取得
        $reservations = DB::table('reservations')->where('id', '1')->first();

        if ($user && $reservations) {
            // reviewsに挿入するデータを定義
            $reviews = [
                [
                    'user_id' => $user->id,
                    'reservation_id' => $reservations->id,
                    'rating' => '5',
                    'comment' => 'とてもよかったです。',
                ],
            ];

            // reviewsテーブルにデータを挿入
            DB::table('reviews')->insert($reviews);
        }
    }
}
