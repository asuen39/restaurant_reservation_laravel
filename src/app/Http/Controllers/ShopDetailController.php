<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\Genres;
use App\Models\Countrys;
use App\Models\Reservation;

class ShopDetailController extends Controller
{
    //詳細ページ表示
    public function detail($id)
    {
        // すべてのショップ情報を取得
        $shops = Shops::with('belongsToCountry', 'belongsToGenres')->find($id);

        // すべての都道府県情報を取得
        $countrys = Countrys::all();

        // すべてのジャンル情報を取得
        $genres = Genres::all();

        // $id を使って詳細データを取得し、詳細ビューに渡す
        return view('detail')->with('shops', $shops, 'id', $id);
    }

    public function makeReservation(Request $request)
    {
        // フォームから送信されたデータを取得
        $shop_id = $request->input('shop_id');
        $reservation_date = $request->input('reservation_date');
        $reservation_time = $request->input('reservation_time');
        $reservation_number = $request->input('reservation_number');

        // モデルを使用してデータベースに保存
        Reservation::create([
            'user_id' => auth()->user()->id,
            'shop_id' => $shop_id,
            'reservation_date' => $reservation_date,
            'reservation_time' => $reservation_time,
            'party_size' => $reservation_number,
        ]);

        // 予約完了ページにリダイレクト
        return redirect()->route('done');
    }
}
