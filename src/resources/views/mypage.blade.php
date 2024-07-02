@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection


@section('content')
<div class="mypage__content">
    <section class="mypage__section">
        <div class="section__block-left sp_margin0"></div>
        <div class="section__block-right">
            <div class="mypage__name">
                <h2>{{ Auth::user()->name }}さん</h2>
            </div>
        </div>
    </section>
    <section class="mypage__section">
        <div class="section__block-left">
            <h4>予約状況</h4>
            @php $count = 1; @endphp <!-- カウント変数を初期化 -->
            @foreach($reservations as $reservation)
            <div class="mypage__reservation-content">
                <!-- カウントを表示 -->
                <div class="mypage__reservation-head">
                    <p class="mypage__reservation-head-left">
                        <img src="{{ asset('images/clock_icon.png') }}" class="clock__icon" alt="clock">
                        <span class="mypage__reservation-head-left-text">予約{{ $count }}</span>
                    </p>
                    <div class="mypage__reservation-head-right">
                        <form action="{{ route('deleteReservation', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('images/close_icon.png') }}" class="close__icon" alt="close">
                            </button>
                        </form>
                    </div>
                </div>
                <ul class="mypage__reservation-area">
                    <li class="mypage__reservation-list">
                        <p class="mypage__reservation-list-text left">Shop</p>
                        <p class="mypage__reservation-list-text">{{ $reservation->shop->shops_name }}</p>
                    </li>
                    <li class="mypage__reservation-list">
                        <p class="mypage__reservation-list-text left">Date</p>
                        <p class="mypage__reservation-list-text">{{ $reservation->reservation_date }}</p>
                    </li>
                    <li class="mypage__reservation-list">
                        <p class="mypage__reservation-list-text left">Time</p>
                        <p class="mypage__reservation-list-text">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</p>
                    </li>
                    <li class="mypage__reservation-list">
                        <p class="mypage__reservation-list-text left">Number</p>
                        <p class="mypage__reservation-list-text">{{ $reservation->party_size }}人</p>
                    </li>
                </ul>
                <div class="mypage__reservation-content-qrCode">
                    @livewire('qrcode-modal', ['reservationId' => $reservation->id], key($reservation->id))
                </div>
                <div class="mypage__reservation-content-edit">
                    @livewire('modal', ['reservation' => $reservation], key($reservation->id))
                </div>
                <div class="mypage__reservation-content-reviews">
                    @livewire('reviews-modal', ['reservation' => $reservation], key($reservation->id))
                </div>
                @php $count++; @endphp
            </div>
            @endforeach
        </div>
        <div class="section__block-right">
            <h4>お気に入り店舗</h4>
            <ul class="mypage__favorite-shop-area">
                @foreach($favorites as $favorite)
                <li class="mypage__favorite-shop-list">
                    <div class="mypage__favorite-content">
                        <div class="mypage__favorite-shop-image"><img src="{{ asset($favorite->shop->image_path) }}" class="mypage_shop-image-thumbnail" alt="Shop Image"></div>
                        <h4 class="mypage__favorite-shop-title">{{ $favorite->shop->shops_name }}</h4>
                        <p class="mypage__favorite-case-name">
                            <span class="mypage__case-name-small">#{{ $favorite->shop->belongsToCountry->countrys }}</span>
                            <span class="mypage__case-name-small">#{{ $favorite->shop->belongsToGenres->genres }}</span>
                        </p>
                        <div class="mypage__shop-footer">
                            <div class="mypage__shop-fotter-button">
                                <a href="{{ route('detail', ['id' => $favorite->shop->id]) }}" class="mypage__shop-button-text">詳しくみる</a>
                            </div>
                            <div class="mypage__shop-favorite">
                                <i class="fa-solid fa-heart fa-2x mypage__shop-favorite-red"></i>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
@endsection