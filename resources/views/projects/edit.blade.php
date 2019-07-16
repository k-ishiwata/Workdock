@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="project">
            <div class="panel w50 centered">
                <h3 class="panel-title">編集</h3>
                <form class="form is-horizontal" method="POST" action="{{ route('projects.update', $project->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="panel-body">
                        @include('components/alert')
                        <div class="input-group">
                            <label class="form-label">プロジェクト名</label>
                            <input type="text" name="title" value="{{ $project->title }}" class="form-input">
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn is-primary">保　存</button>
                        <a href="{{ route('projects.index') }}" class="btn">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
