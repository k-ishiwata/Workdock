@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="project">
            <div class="daily-report-head l-row is-between mb10">
                <div class="daily-report-title">
                    <p class="name">{{ $project->title }}</p>
                    @php
                        $timeHour = floor($timeTotal / 60);
                        $timeMin = $timeTotal % 60;
                    @endphp
                    <p class="time">
                        合計時間：
                        @if($timeHour)
                            <span class="font-en">{{ floor($timeTotal / 60) }}</span>時間
                        @endif
                        <span class="font-en">{{ $timeTotal % 60 }}</span>分
                    </p>
                </div>
            </div>
            @if($timeTotal <= 0)
                <p>このプロジェクトの作業はしていません。</p>
            @else
            <table class="table is-stripe time-table">
                <thead>
                <tr>
                    <th>タイトル</th>
                    <th>担当</th>
                    <th>作業日</th>
                    <th>時間</th>
                    <th class="time-bar">
                        <div class="cells">
                            @for ($i = 0; $i < 10; $i++)
                                <div class="w10"></div>
                            @endfor
                        </div>
                    </th>
                </tr>
                </thead>
                @foreach($timeLogs as $log)
                    <tr>
                        <td>{{ $log->title }}</td>
                        <td>{{ $log->user->display_name }}</td>
                        <td>{{ $log->start_at->format('Y/m/d') }}</td>
                        <td>{{ $log->time }}分</td>
                        <td class="time-bar">
                            <div class="cells">
                                @for ($i = 0; $i < 10; $i++)
                                    <div class="w10"></div>
                                @endfor
                            </div>
                            <div class="bar" style="left: 0; width: {{ $log->time / $maxTime * 100 }}%"></div>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $timeLogs->render() }}
            @endif
        </div>
    </div>
@endsection
