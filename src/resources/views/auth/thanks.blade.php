<!-- resources/views/index.blade.php -->
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<section class="thanks__content">
    <div class="thanks__content-area">
        <p class="thanks__text">会員登録ありがとうございます。<br />現在、仮登録の状態です。</p>
        <p class="thanks__text-small">登録されたメールアドレス宛てに認証メールが送られています。
            <br />認証を完了してください。
        </p>
    </div>
</section>
@endsection