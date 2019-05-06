<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Workdock</title>
    </head>
    <body>
{{--    <nav>--}}
{{--        <a href="/">タスク一覧</a>--}}
{{--        <a href="/projects">プロジェクト一覧</a>--}}
{{--        @guest--}}
{{--            <a href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--            @if (Route::has('register'))--}}
{{--                <a href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--            @endif--}}
{{--        @else--}}
{{--            <a href="#">{{ Auth::user()->name }}</a>--}}

{{--            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                {{ __('Logout') }}--}}
{{--            </a>--}}

{{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                @csrf--}}
{{--            </form>--}}
{{--        @endguest--}}
{{--    </nav>--}}
    @yield('content')
    </body>
    <script src="{{ asset('js/app.js')}}"></script>
</html>

