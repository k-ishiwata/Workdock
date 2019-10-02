@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="daily-report">
            <div class="daily-report-head l-row is-between mb10">
                <div class="daily-report-title">
                    <p class="name">{{ $user->display_name }}</p>
                    @php
                    $timeSum = $timeLogs->sum('time');  // 合計時間
                    $timeHour = floor($timeSum / 60);
                    $timeMin = $timeSum % 60;
                    @endphp
                    <p class="time">
                        {{ $requestDate->format('Y年n月d日') }} /
                        作業時間：
                        @if($timeHour)
                        <span class="font-en">{{ floor($timeSum / 60) }}</span>時間
                        @endif
                        <span class="font-en">{{ $timeSum % 60 }}</span>分
                    </p>
                </div>
{{--                <div class="btn-group">--}}
{{--                    <button class="is-icon"><i class="remixicon-add-circle-line"></i>新規登録</button>--}}
{{--                </div>--}}

                <div class="l-row is-item-center">
                    <form class="form">
                        <div class="form-inline">
                            <div class="input-group">
                                <div class="select-box" data-placeholder="ユーザー選択">
                                    <select name="user_id" onChange="location.href=value;">
                                        <option value="">ユーザー選択</option>
                                        @foreach($users as $u)
                                            <option
                                                value="/reports/{{ $u->id }}"
                                                @if($user->id === $u->id)
                                                    selected
                                                @endif
                                            >{{ $u->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="input-group">
                                <input
                                    type="text"
                                    placeholder="日付選択"
                                    name="date_filter"
                                    class="data-input">
                            </div>
                        </div>
                    </form>
                    <div class="ml20">
                        <a href="{{ route('reports.create') }}?date={{ $requestDate->format('Y-m-d') }}&user={{ \Auth::id() }}" class="btn is-primary is-icon"><i class="remixicon-add-circle-line"></i>新規登録</a>
                    </div>
                </div>
            </div>
            @include('components.alert')
            @if(count($timeLogs) <= 0)
                <p>この日の作業はありません。</p>
            @else
            <table class="table is-stripe time-table">
                <thead>
                <tr>
                    <th class="w10">プロジェクト</th>
                    <th>件名</th>
                    <th class="cell-time">作業時間</th>
                    <th class="time-bar">
                        <div class="cells">
                            @for ($i = 0; $i < 24; $i++)
                                <div>{{ $i }}</div>
                            @endfor
                        </div>
                    </th>
                    <th class="w100px">アクション</th>
                </tr>
                </thead>
                <tbody>
                @foreach($timeLogs as $timeLog)
                    <tr>
                        <td>{{ $timeLog->project->title }}</td>
                        <td class="cell-title">{{ $timeLog->title }}</td>
                        <td class="cell-time">{{ $timeLog->time }}分</td>
                        <td class="time-bar">
                            <div class="cells">
                                @for ($i = 0; $i < 24; $i++)
                                    <div></div>
                                @endfor
                            </div>
                            <div class="bar" {{ $timeLog->barStyle }}></div>
                        </td>
                        <td class="cell-action">
                            <a href="{{ route('reports.edit', $timeLog->id) }}?date={{ $requestDate->format('Y-m-d') }}&user={{ $user->id }}" title="編集"><i class="remixicon-file-edit-line"></i></a>
                            <a href="#" title="削除"><i class="remixicon-delete-bin-line delete-btn" data-id="{{ $timeLog->id }}"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

    @include('components/delete-modal', ['url' => '/reports'])
@endsection
