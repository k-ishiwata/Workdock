@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="project">
            <div class="l-row is-gutters-md">
                <div class="l-col is-40">
                    @include('components/alert')
                    <div class="panel">
                        <h3 class="panel-title">新規登録</h3>
                        <form class="form is-horizontal" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="panel-body">
                                <div class="input-group">
                                    <label class="form-label">ログインID</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">ユーザー名</label>
                                    <input type="text" name="display_name" value="{{ old('display_name') }}" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">パスワード</label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">パスワード確認</label>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label class="form-label">権限</label>
                                    <div class="form-input">

                                        <div class="select-box">
                                            <select name="role_id">
                                                @foreach(config('global.roles') as $key => $role)
                                                <option
                                                    value="{{ $key }}"
                                                    @if((int)old('role_id') === $key) selected @endif
                                                >{{ $role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn is-primary">登　録</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="l-col is-60">
                    <table class="table is-stripe">
                        <thead>
                        <tr>
                            <th class="w10">番号</th>
                            <th>ログインID</th>
                            <th>ユーザー名</th>
                            <th>権限</th>
                            <th class="w20">登録日</th>
                            <th class="w100px">アクション</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->display_name }}</td>
                                <td>{{ config('global.roles')[$user->role_id] }}</td>
                                <td>{{ $user->created_at->format('y/m/d') }}</td>
                                <td class="cell-action">
{{--                                    <a title="詳細"><i class="remixicon-file-text-line"></i></a>--}}
                                    <a href="{{ route('users.edit', $user->id) }}" title="編集">
                                        <i class="remixicon-file-edit-line"></i>
                                    </a>
                                    <a title="削除"><i class="remixicon-close-line delete-btn" data-id="{{ $user->id }}"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    </div>

    @include('components/delete-modal', ['url' => '/users'])
@endsection
