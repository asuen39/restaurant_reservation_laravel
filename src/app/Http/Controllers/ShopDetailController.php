<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\Genres;
use App\Models\Countrys;
use App\Models\Reservations;
use App\Http\Requests\UserFormRequest;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;

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

    // 決済画面の表示
    public function showPaymentForm(Request $request)
    {
        // フォームから送信されたデータを取得
        $shop_id = $request->input('shop_id');
        $reservation_date = $request->input('reservation_date');
        $reservation_time = $request->input('reservation_time');
        $reservation_number = $request->input('reservation_number');

        // セッションに値を一時的に保存
        session(['shop_id' => $shop_id, 'reservation_date' => $reservation_date, 'reservation_time' => $reservation_time, 'reservation_number' => $reservation_number]);

        return view('/payment');
    }

    // 決済処理
    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret_key'));

        try {
            \Stripe\Charge::create([
                'source' => $request->stripeToken,
                'amount' => 1000,
                'currency' => 'jpy',
            ]);
        } catch (Exception $e) {
            return back()->with('flash_alert', '決済に失敗しました！(' . $e->getMessage() . ')');
        }
        //決済が完了したらmakeReservationを実行。
        //払い処理が成功した後で予約を作成する
        $this->makeReservation($request);

        // 予約完了ページにリダイレクト
        return redirect()->route('done');
    }

    public function makeReservation()
    {
        // セッションからデータを取得
        $shop_id = session('shop_id');
        $reservation_date = session('reservation_date');
        $reservation_time = session('reservation_time');
        $reservation_number = session('reservation_number');

        // モデルを使用してデータベースに保存
        Reservations::create([
            'user_id' => auth()->user()->id,
            'shop_id' => $shop_id,
            'reservation_date' => $reservation_date,
            'reservation_time' => $reservation_time,
            'party_size' => $reservation_number,
        ]);
    }
}
