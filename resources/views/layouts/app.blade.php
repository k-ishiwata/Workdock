<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Workdock</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width">
    <link href="http://cdn.remixicon.com/releases/v1.1.2/remixicon.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header id="l-header">
    <!-- <p class="brand-logo"><a href="/">Work<span>Dock</span></a></p> -->
    <nav class="header-nav">
        <ul>
            <li><a href="/">ダッシュボード</a></li>
            <li class="is-active"><a href="/tasks">タスク</a></li>
            <li><a href="#">プロジェクト</a></li>
            <li><a href="#">メンバー</a></li>
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
        <div class="user-panel">
            <div class="user-panel-toggle">
                <div class="image"><img src="assets/img/face.jpg" alt=""></div>
                <p>山田太郎</p>
            </div>
            <div class="user-panel-menu">
                <ul>
                    <li><a href="#">ユーザー設定</a></li>
                    <li><a href="#">ログアウト</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <ul class="head-nav">
        <li><a href="create.html" class="btn">新規作成</a></li>
        <li><a href="#" class="btn is-outline">ログアウト</a></li>
    </ul> -->
</header>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr@4.5.7/dist/l10n/ja.js"></script>
<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
