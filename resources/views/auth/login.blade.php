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
<div id="l-container">
    <div id="login">
        @if (Session::has('alert'))
            <div class="alert alert-success">{{ Session::get('alert') }}</div>
        @endif
        <div class="panel w500px centered">
            <h3 class="panel-title">ログイン</h3>
            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf
                <div class="panel-body">
                    <div class="input-group">
                        <label class="form-label">ログインID</label>
                        <div class="form-input">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('email') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="form-label">パスワード</label>
                        <div class="form-input">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn is-primary">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
