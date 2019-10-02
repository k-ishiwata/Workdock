<div class="panel-body">
    @include('components/alert')
    <div class="input-group">
        <label class="form-label">タイトル</label>
        <input type="text" name="title" value="{{ old('title') ?? $timeLog->title ?? '' }}" class="form-input">
    </div>
    <div class="input-group">
        <label class="form-label">プロジェクト</label>
        <div class="select-box form-input">
            <select name="project_id">
                <option value="">プロジェクト選択</option>
                @foreach($projects as $project)
                    <option
                        value="{{ $project->id }}"
                        @if(isset($timeLog) &&$project->id === $timeLog->project_id)
                        selected
                        @endif
                    >{{ $project->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="input-group">
        <label class="form-label">作業日</label>
        <input type="text" name="start_at"
               value="{{ old('start_at') ?? request()->input('date') ?? $timeLog->start_at->format('Y-m-d') ?? '' }}"
               class="form-input">
    </div>
    <div class="input-group">
        <label class="form-label">作業時間</label>
        <div class="input-inline">
            <input type="text" name="start_time_hour"
                   value="{{
                       old('start_time_hour') ??
                       isset($timeLog->start_at) ? $timeLog->start_at->format('H') : ''
                   }}"
                   class="form-input">
            <span>　:　</span>
            <input type="text" name="start_time_min"
                   value="{{
                        old('start_time_min') ??
                        isset($timeLog->start_at) ? $timeLog->start_at->format('i') : ''
                   }}"
                   class="form-input">
            <span>　〜　</span>
            <input type="text" name="end_time_hour"
                   value="{{
                        old('end_time_hour') ??
                        isset($timeLog->end_at) ? $timeLog->end_at->format('H') : ''
                   }}"
                   class="form-input">
            <span>　:　</span>
            <input type="text" name="end_time_min"
                   value="{{
                        old('end_time_min') ??
                        isset($timeLog->end_at) ? $timeLog->end_at->format('i') : ''
                   }}"
                   class="form-input">
        </div>
    </div>
    <input type="hidden" name="user_id" value="{{ request()->input('user') }}">
</div>
<div class="panel-footer">
    <button class="btn is-primary">保　存</button>
    <a onClick="history.back(); return false;" class="btn">キャンセル</a>
</div>
