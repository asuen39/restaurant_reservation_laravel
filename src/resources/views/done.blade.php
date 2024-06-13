<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__content-area">
        <p class="thanks__text">決済完了しました。<br />ご予約ありがとうございます。</p>
        <p class="thanks__login"><a href="/" class="thanks__login-text">戻る</a></p>
    </div>
</div>
@endsection