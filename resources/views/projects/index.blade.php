@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="project">
            <div class="l-row is-gutters-md">
                <div class="l-col is-40">
                    <div class="panel">
                        <h3 class="panel-title">新規登録</h3>
                        <form class="form is-horizontal" method="POST" action="{{ route('projects.store') }}">
                            @csrf
                            <div class="panel-body">
                                @include('components/alert')
                                <div class="input-group">
                                    <label class="form-label">プロジェクト名</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-input">
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
                            <th class="w10">ID</th>
                            <th>タイトル</th>
{{--                            <th class="w10">計測時間</th>--}}
                            <th class="w20">作成日</th>
                            <th class="w100px">アクション</th>
                        </tr>
                        </thead>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ sprintf('%04d', $project->id) }}</td>
                                <td>{{ $project->title }}</td>
{{--                                <td>{{ $project->timeFormat }}</td>--}}
                                <td>{{ $project->created_at->format('y/m/d') }}</td>
                                <td class="cell-action">
                                    <a href="{{ route('projects.show', $project->id) }}" title="詳細"><i class="remixicon-time-line"></i></a>
                                    <a href="{{ route('projects.edit', $project->id) }}" title="編集">
                                        <i class="remixicon-file-edit-line"></i>
                                    </a>
                                    <a title="削除"><i class="remixicon-delete-bin-line delete-btn" data-id="{{ $project->id }}"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    {!! $projects->links() !!}
                </div>
            </div>
        </div>
    </div>

    @include('components/delete-modal', ['url' => '/projects'])

@endsection
