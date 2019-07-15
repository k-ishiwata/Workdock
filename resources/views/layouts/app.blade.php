<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Workdock</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header id="l-header">
    <!-- <p class="brand-logo"><a href="/">Work<span>Dock</span></a></p> -->
    <nav class="header-nav">
        <ul>
            <li><a href="/">ダッシュボード</a></li>
            <li><a href="/tasks">タスク</a></li>
            <li><a href="/projects">プロジェクト</a></li>
            <li><a href="/users">ユーザー</a></li>
        </ul>
    </nav>

    <!-- <div id="global-search">
        <form action="#" class="form">
            <input type="text" placeholder="キーワード検索">
            <button type="submit" class="search-btn">
                <img src="assets/img/icon-search.svg" alt="">
            </button>
        </form>
    </div> -->
    <div class="header-right">
        <div class="user-panel dropdown">
            <div class="user-panel-toggle dropdown-toggle">
{{--                <div class="image"><img src="assets/img/face.jpg" alt=""></div>--}}
                <span>{{ Auth::user()->display_name }}</span>
            </div>
            <div class="user-panel-menu dropdown-menu">
                <ul>
                    <li><a href="#">ユーザー情報</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a></li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</header>

@yield('content')

<div id="notice">
    <p id="notice-message">データを更新しました。</p>
    <button id="notice-close-btn">
        <span>&times;</span>
    </button>
</div>

<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
