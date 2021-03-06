@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="user">
            <div class="panel w50 centered">
                <h3 class="panel-title">ユーザー情報の編集</h3>
                <form class="form is-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="panel-body">
                        @include('components/alert')
                        <div class="input-group">
                            <label class="form-label">ログインID</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-input">
                        </div>
                        <div class="input-group">
                            <label class="form-label">ユーザー名</label>
                            <input type="text" name="display_name" value="{{ $user->display_name }}" class="form-input">
                        </div>
                        <div class="input-group">
                            <label class="form-label">パスワード</label>
                            <div class="form-input">
                                <input type="text" name="password" value="">
                                <p class="input-help">パスワードは変更する場合のみ入力してください。</p>
                            </div>
                        </div>
                        <div class="input-group">
                            <label class="form-label">パスワード確認</label>
                            <input type="text" name="password_confirmation" value="" class="form-input">
                        </div>
                        <div class="input-group">
                            <label class="form-label">権限</label>
                            <div class="form-input">
                                <div class="select-box">
                                    <select name="role_id">
                                        @foreach(config('global.roles') as $key => $role)
                                            <option
                                                value="{{ $key }}"
                                                @if($user->role_id === $key) selected  @endif
                                            >{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn is-primary">保　存</button>
                        <a href="{{ route('users.index') }}" class="btn">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
