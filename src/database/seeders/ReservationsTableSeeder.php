<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
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

        //shopsのID取得
        $shops = DB::table('shops')->where('shops_name', '仙人')->first();

        if ($user && $shops) {
            // reservationsに挿入するデータを定義
            $reservations = [
                [
                    'user_id' => $user->id,
                    'shop_id' => $shops->id,
                    'reservation_date' => '2024/04/22',
                    'reservation_time' => '10:20:30',
                    'party_size' => '3',
                ],
            ];

            // reservationsテーブルにデータを挿入
            DB::table('reservations')->insert($reservations);
        }
    }
}
