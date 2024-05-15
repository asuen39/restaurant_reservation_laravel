<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shops;
use App\Models\Genres;
use App\Models\Countrys;
use App\Models\Reservations;
use App\Models\Favorites;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopListController extends Controller
{
    protected $countrys; // 都道府県情報を格納するプロパティ
    protected $genres; // ジャンル情報を格納するプロパティ

    // コンストラクターで都道府県情報を取得し、プロパティにセットする
    public function __construct()
    {
        // すべての都道府県情報を取得
        $this->countrys = Countrys::all();

        // すべてのジャンル情報を取得
        $this->genres = Genres::all();
    }

    public function index(Request $request)
    {
        // ユーザーが検索を行った場合の処理
        if ($request->has('keyword')) {
            return $this->search($request);
        }

        // すべてのショップ情報を取得
        $shops = Shops::with('belongsToCountry', 'belongsToGenres')->get();

        // ユーザーIDごとにデータベースからお気に入り情報を取得
        $favoriteShops = Favorites::where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();

        return view('index', compact('shops', 'favoriteShops'))->with('countrys', $this->countrys)->with('genres', $this->genres);
    }

    public function favorite(Request $request)
    {

        //お気に入りの店情報の取得
        $shopId = $request->get('shop_id');

        // すでにお気に入りに追加されているかどうかを確認
        $existingFavorite = Favorites::where('user_id', auth()->user()->id)
            ->where('shop_id', $shopId)
            ->first();

        if ($existingFavorite) {
            // すでにお気に入りに追加されている場合は削除
            $existingFavorite->delete();
        } else {
            // お気に入りに追加されていない場合は追加
            Favorites::create([
                'user_id' => auth()->user()->id,
                'shop_id' => $shopId,
            ]);
        }

        //indexアクションを呼び出す
        return redirect('/');
    }

    public function search(Request $request)
    {
        $query = Shops::query();

        //検索ワードでの検索
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('shops_name', 'like', "%$keyword%");
            });
        }

        //都道府県検索
        if ($request->has('all_areas')) {
            $allAreas = $request->input('all_areas');
            $query->whereHas('belongsToCountry', function ($query) use ($allAreas) {
                $query->where('countrys', $allAreas);
            });
        }

        //ジャンル検索
        if ($request->has('all_genres')) {
            $allGenres = $request->input('all_genres');
            $query->whereHas('belongsToGenres', function ($query) use ($allGenres) {
                $query->where('genres', $allGenres);
            });
        }

        $searchResults = $query->paginate(10);

        // ユーザーIDごとにデータベースからお気に入り情報を取得
        $favoriteShops = Favorites::where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();

        return view('index', compact('searchResults', 'favoriteShops'))->with('countrys', $this->countrys)->with('genres', $this->genres);
    }
}
