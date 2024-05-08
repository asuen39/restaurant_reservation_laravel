@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/font/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('content')
<div class="search__content">
    <div class="search__inner">
        <form id="searchForm" action="{{ route('search') }}" class="search__form" method="get">
            <div class="search_select-area">
                <select name="all_areas" class="search_select">
                    <option value="" selected disabled>All area</option>
                    @foreach($countrys as $country)
                    <option value="{{ $country -> countrys }}">{{ $country -> countrys }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_select-area">
                <select name=" all_genres" class="search_select">
                    <option value="" selected disabled>All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre -> genres }}">{{ $genre -> genres }}</option>
                    @endforeach
                </select>
            </div>
            <input class="search__item-input" type="text" name="keyword" value="" placeholder="Search...">
        </form>
    </div>
</div>
<div class="shop__content">
    <section class="shop__inner">
        <ul class="shop_list-area">
            @if(isset($searchResults))
            @foreach($searchResults as $shop)
            <!--検索結果-->
            <li class="shop_list">
                <div class="shop_list-box">
                    <div class="shop_image"><img src="{{ asset($shop->image_path) }}" class="shop_image-thumbnail" alt="Shop Image"></div>
                    <h4 class="shop_title">{{ $shop->shops_name }}</h4>
                    <p class="case_name"><span class="case_name-small">#{{ $shop->belongsToCountry->countrys }}</span><span class="case_name-small">#{{ $shop->belongsToGenres->genres }}</span></p>
                    <div class="shop_list-footer">
                        <p class="shop_list-button">
                            <a href="{{ route('detail', ['id' => $shop->id]) }}" class="shop_list-button-text">詳しくみる</a>
                        </p>
                        <div class="shop_favorite">
                            <form action="{{ route('favorite') }}" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                <button type="submit" class="shop_favorite-button">
                                    @if(in_array($shop->id, $favoriteShops))
                                    <i class="fa-solid fa-heart fa-2x shop_favorite-color-red"></i>
                                    @else
                                    <i class="fa-solid fa-heart fa-2x shop_favorite-color"></i>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            @else
            @foreach($shops as $shop)
            <!--全店舗表示-->
            <li class="shop_list">
                <div class="shop_list-box">
                    <div class="shop_image"><img src="{{ asset($shop->image_path) }}" class="shop_image-thumbnail" alt="Shop Image"></div>
                    <h4 class="shop_title">{{ $shop->shops_name }}</h4>
                    <p class="case_name"><span class="case_name-small">#{{ $shop->belongsToCountry->countrys }}</span><span class="case_name-small">#{{ $shop->belongsToGenres->genres }}</span></p>
                    <div class="shop_list-footer">
                        <p class="shop_list-button"><a href="/detail/{{ $shop->id }}" class="shop_list-button-text">詳しくみる</a></p>
                        <div class="shop_favorite">
                            <form action="{{ route('favorite') }}" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                <button type="submit" class="shop_favorite-button">
                                    @if(in_array($shop->id, $favoriteShops))
                                    <i class="fa-solid fa-heart fa-2x shop_favorite-color-red"></i>
                                    @else
                                    <i class="fa-solid fa-heart fa-2x shop_favorite-color"></i>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </section>
</div>

<script src="{{ asset('js/all.min.js') }}"></script>
@yield('scripts')
@endsection