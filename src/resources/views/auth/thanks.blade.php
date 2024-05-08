<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__content-area">
        <p class="thanks__text">会員登録ありがとうございます</p>
        <p class="thanks__login"><a href="/login" class="thanks__login-text">ログインする</a></p>
    </div>
</div>
@endsection