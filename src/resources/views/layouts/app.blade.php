<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>飲食店予約サービスアプリケーション</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    @livewireStyles
</head>

<body class="body__layout">
    <div class="container-lg">
        <header class="header">
            <div class="header__inner">
                <div class="header__openbtn">
                    <span class="header__openbtn-border"></span>
                    <span class="header__openbtn-border"></span>
                    <span class="header__openbtn-border"></span>
                </div>
                <h1 class="header__title">Rese</h1>
                <nav class="nav_global is_close">
                    <!--ログイン状態のチェック: ログイン状態なら下記を表示-->
                    <ul class="header__nav">
                        <li class="header__nav-item">
                            <a href="/" class="header__nav__button">Home</a>
                        </li>
                        @if (!Auth::check())
                        <li class="header__nav-item">
                            <a href="/register" class="header__nav__button">Registration</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="/login" class="header__nav__button">Login</a>
                        </li>
                        @endif
                        @if (Auth::check())
                        <li class="header__nav-item">
                            <form class="form" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="header__nav__button">Logout</button>
                            </form>
                        </li>
                        <li class="header__nav-item">
                            <a href="/mypage" class="header__nav__button">Mypage</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </header>
        <main class="main__layout">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/header.js') }}"></script>
    @yield('scripts')
    @livewireScripts
</body>

</html>