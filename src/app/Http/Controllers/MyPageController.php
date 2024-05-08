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

        return view('mypage');
    }

    public function updateProfile()
    {
    }
}
