<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Favorites;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function mypage()
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        //　ログインユーザーの予約情報取得
        $reservations = Reservations::where('user_id', $userId)->get();

        // お気に入りの店舗情報を取得
        $favorites = Favorites::where('user_id', $userId)->get();

        return view('mypage', compact('reservations', 'favorites'));
    }

    public function updateProfile(Request $request)
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        // 送信されたフォームデータを取得
        $data = $request->validate([
            'shop_id' => 'required|integer',
            'mypage_datepicker' => 'required|date',
            'mypage_reservation_time' => 'required',
            'mypage_reservation_number' => 'required|integer',
        ]);

        // 特定のshop_idとuser_idに該当する予約情報を取得
        $reservation = Reservations::where('user_id', $userId)
            ->where('shop_id', $data['shop_id'])
            ->firstOrFail();

        // 予約情報を更新
        $reservation->reservation_date = $data['mypage_datepicker'];
        $reservation->reservation_time = $data['mypage_reservation_time'];
        $reservation->party_size = $data['mypage_reservation_number'];

        // データベースに保存
        $reservation->save();

        return redirect()->route('mypage')->with('status', '予約が更新されました');
    }

    public function deleteReservation($id)
    {
        $userId = Auth::id();

        // 該当する予約情報を取得
        $reservation = Reservations::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // 予約情報を削除
        $reservation->delete();

        return redirect()->route('mypage')->with('status', '予約が削除されました');
    }

    public function submitReview(Request $request)
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        // 送信されたフォームデータを取得
        $revieData = $request->validate([
            'shop_id' => 'required|integer',
            'rating_star' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // モデルを使用してデータベースに保存
        Reviews::create([
            'user_id' => $userId,
            'reservation_id' => $revieData['shop_id'],
            'rating' => $revieData['rating_star'],
            'comment' => $revieData['comment'],
        ]);

        // マイページへ戻る
        return redirect()->route('mypage');
    }

    //qrコードを読み取った後の処理
    public function readQrCode($id)
    {
        // 該当の予約を取得
        $reservation = Reservations::find($id);

        // 存在するか確認
        if (!$reservation) {
            return response()->json(['message' => '予約が見つかりませんでした'], 404);
        }

        // qr_flag を true に更新
        $reservation->qr_flag = true;
        $reservation->save();

        return response()->json(['message' => 'QR コードが正常に読み取られ、フラグが更新されました']);
    }
}
