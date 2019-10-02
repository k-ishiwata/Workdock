@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="daily-report">
            <div class="daily-report-head l-row is-between mb10">
                <div class="daily-report-title">
                    <p class="name">{{ $user->display_name }}</p>
                    @php
                        $timeSum = $timeLogs->sum();  // 合計時間
                        $timeHour = floor($timeSum / 60);
                        $timeMin = $timeSum % 60;
                    @endphp
                    <p class="time">
                        {{ $requestDate->format('Y年n月') }} /
                        作業時間：
                        @if($timeHour)
                            <span class="font-en">{{ floor($timeSum / 60) }}</span>時間
                        @endif
                        <span class="font-en">{{ $timeSum % 60 }}</span>分
                    </p>
                </div>
            </div>
            @if(count($timeLogs) >= 1)
                <table class="table is-stripe time-table">
                    <thead>
                    <tr>
                        <th class="w10">日</th>
                        <th class="w10">時間</th>
                        <th class="time-bar">
                            <div class="cells">
                                @for ($i = 0; $i < 24; $i++)
                                    <div>{{ $i }}</div>
                                @endfor
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($timeLogs as $key => $timeLog)
                        <tr>
                            <td class="center"><a href="{{ $key }}/">{{ $key }}</a></td>
                            <td class="center">{{ $timeLog }}分</td>
                            <td class="time-bar">
                                <div class="cells">
                                    @for ($i = 0; $i < 24; $i++)
                                        <div></div>
                                    @endfor
                                </div>
                                <div class="bar" style="left: 0; width: {{ $timeLog / 60 * 30 }}px"></div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
