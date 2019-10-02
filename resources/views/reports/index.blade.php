@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="reports">
            <div class="l-row is-gutters-md">
                <div class="l-col is-50">
                    <h2 class="title">ユーザー一覧</h2>
                    <table class="table is-stripe">
                        <thead>
                        <tr>
                            <th class="w10">番号</th>
                            <th>ユーザー名</th>
                            <th class="w20">登録日</th>
                            <th class="w200px">アクション</th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->display_name }}</td>
                                <td>{{ $user->created_at->format('y/m/d') }}</td>
                                <td class="cell-action">
                                    <a href="{{ route('reports.show', $user->id) }}" title="作業記録"><i class="remixicon-time-line"></i></a>
{{--                                    <a href="{{ route('reports.show', $user->id . '/' . $now->format('Y')) }}/" title="月別"><i class="remixicon-time-line"></i>月別作業時間</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.l-col -->
                <div class="l-col is-50">
                    <h2 class="title">プロジェクト一覧</h2>
                    <table class="table is-stripe">
                        <thead>
                        <tr>
                            <th class="w10">ID</th>
                            <th>タイトル</th>
                            <th class="w20">作成日</th>
                            <th class="w100px">アクション</th>
                        </tr>
                        </thead>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ sprintf('%04d', $project->id) }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->created_at->format('y/m/d') }}</td>
                                <td class="cell-action">
                                    <a href="{{ route('projects.show', $project->id) }}" title="詳細"><i class="remixicon-time-line"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div><!-- /.l-col -->
            </div><!-- /.l-row -->
        </div><!-- /#reports -->
    </div><!-- /#l-container -->
@endsection
