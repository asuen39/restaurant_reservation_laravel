<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<section class="register__content">
    <div class="register__form-area">
        <div class="register__header">
            <p class="register__header-title">Registration</p>
        </div>
        <form class="register__form" action="{{ route('register') }}" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <img src="{{ asset('images/svg/user_icon.svg') }}" class="form__input-img" alt="ユーザー">
                        <input id="name" type="text" name="name" placeholder="名前" value="{{ old('name') }}">
                    </div>
                </div>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <img src="{{ asset('images/svg/mail_icon.svg') }}" class="form__input-img" alt="メール">
                        <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--text">
                        <img src="{{ asset('images/svg/key_icon.svg') }}" class="form__input-img" alt="パスワード">
                        <input id="password" type="password" name="password" placeholder="パスワード">
                    </div>
                </div>
            </div>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form__button">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</section>
@endsection