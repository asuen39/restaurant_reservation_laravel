<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shops;
use App\Models\Genres;
use App\Models\Countries;
use App\Models\Favorites;
use Illuminate\Pagination\Paginator;

class ShopListController extends Controller
{
    protected $countries; // 都道府県情報を格納するプロパティ
    protected $genres; // ジャンル情報を格納するプロパティ

    public function boot()
    {
        // Bootstrapを使ってページネーションをスタイリングする場合
        Paginator::useBootstrap();
    }

    // コンストラクターで都道府県情報を取得し、プロパティにセットする
    public function __construct()
    {
        // すべての都道府県情報を取得
        $this->countries = Countries::all();

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
        $shops = Shops::with('belongsToCountry', 'belongsToGenre')->paginate(12);

        // boot メソッドを呼び出し
        $this->boot();

        // ユーザーIDごとにデータベースからお気に入り情報を取得
        $favoriteShops = Favorites::where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();

        return view('index', compact('shops', 'favoriteShops'))->with('countries', $this->countries)->with('genres', $this->genres);
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
                $query->where('countries', $allAreas);
            });
        }

        //ジャンル検索
        if ($request->has('all_genres')) {
            $allGenres = $request->input('all_genres');
            $query->whereHas('belongsToGenre', function ($query) use ($allGenres) {
                $query->where('genres', $allGenres);
            });
        }

        // 検索結果をページネーションで取得
        $searchResults = $query->paginate(12);

        // boot メソッドを呼び出し
        $this->boot();

        // ユーザーIDごとにデータベースからお気に入り情報を取得
        $favoriteShops = Favorites::where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();

        // ビューに変数を渡す
        return view('index', compact('searchResults', 'favoriteShops'))->with('countries', $this->countries)->with('genres', $this->genres);
    }
}
