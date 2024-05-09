<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countrys;
use App\Models\Genres;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Shops;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function mypage()
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();

        //　ログインユーザーの予約情報取得
        $reservations = Reservation::where('user_id', $userId)->get();

        // お気に入りの店舗情報を取得
        $favorites = Favorite::where('user_id', $userId)->get();

        return view('mypage', compact('reservations', 'favorites'));
    }

    public function updateProfile()
    {
    }
}
