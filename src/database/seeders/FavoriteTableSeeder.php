<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteTableSeeder extends Seeder
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

        //shopのID取得
        $shops = DB::table('shops')->where('shops_name', '牛助')->first();

        if ($user && $shops) {
            // favoriteに挿入するデータを定義
            $favorite = [
                [
                    'user_id' => $user->id,
                    'shop_id' => $shops->id,
                ],
            ];

            // favoriteテーブルにデータを挿入
            DB::table('favorite')->insert($favorite);
        }
    }
}
