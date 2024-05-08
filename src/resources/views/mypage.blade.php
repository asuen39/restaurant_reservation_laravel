@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage__content">
    <section class="mypage__name">
        <h3>{{ Auth::user()->name }}さん</h3>
    </section>
    <section class="mypage__section">
        <div class="section__block">
            <h3>予約状況</h3>
            <div></div>
        </div>
        <div class="section__block">
            <h3>お気に入り店舗</h3>
        </div>
    </section>
</div>
@endsection