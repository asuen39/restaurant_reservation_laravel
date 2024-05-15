<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Favorites;
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

    public function updateProfile()
    {
    }
}
