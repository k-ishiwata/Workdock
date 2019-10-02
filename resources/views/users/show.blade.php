@extends('layouts.app')
@section('content')
    <div id="l-container">
        <div id="daily-report">
            <div class="daily-report-head l-row is-between mb10">
                <div class="daily-report-title">
                    <p class="name">{{ $user->display_name }}</p>
                    @php
                    $timeHour = floor($timeLog->sum('time') / 60);
                    $timeMin = $timeLog->sum('time') % 60;
                    @endphp
                    @if($timeMin)
                    <p class="time">
                        作業時間：
                        @if($timeHour)
                        <span class="font-en">{{ floor($timeLog->sum('time') / 60) }}</span>時間
                        @endif
                        <span class="font-en">{{ $timeLog->sum('time') % 60 }}</span>分
                    </p>
                    @endif
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
                                                value="/users/{{ $u->id }}"
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
                        <a href="{{ route('reports.create') }}" class="btn is-primary is-icon"><i class="remixicon-add-circle-line"></i>新規登録</a>
                    </div>
                </div>
            </div>
            @if(count($timeLog) < 1)
                <p>{{ $requestDate->format('n月d日') }}は作業していません。</p>
            @else
            <table class="table is-stripe time-table">
                <thead>
                <tr>
                    <th class="w10">プロジェクト</th>
                    <th>件名</th>
                    <th class="cell-time">作業時間</th>
                    <th class="time-bar">
                        <div class="cells">
                            <div>0</div>
                            <div>1</div>
                            <div>2</div>
                            <div>3</div>
                            <div>4</div>
                            <div>5</div>
                            <div>6</div>
                            <div>7</div>
                            <div>8</div>
                            <div>9</div>
                            <div>10</div>
                            <div>11</div>
                            <div>12</div>
                            <div>13</div>
                            <div>14</div>
                            <div>15</div>
                            <div>16</div>
                            <div>17</div>
                            <div>18</div>
                            <div>19</div>
                            <div>20</div>
                            <div>21</div>
                            <div>22</div>
                            <div>23</div>
                        </div>
                    </th>
                    <th class="w100px">アクション</th>
                </tr>
                </thead>
                <tbody>
                @foreach($timeLog as $log)
                    <tr>
                        <td>{{ $log->project->title }}</td>
                        <td class="cell-title">{{ $log->title }}</td>
                        <td class="cell-time">{{ $log->time }}分</td>
                        <td class="time-bar">
                            <div class="cells">
                                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                            </div>
                            <div class="bar" {{ $log->barStyle }}></div>
                        </td>
                        <td class="cell-action">
                            <a title="編集"><i class="remixicon-file-edit-line"></i></a>
                            <a title="削除"><i class="remixicon-delete-bin-line"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
