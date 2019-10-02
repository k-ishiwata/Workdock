<?php

namespace App\Services;

use App\Models\User;
use App\Models\TimeLog;
use Carbon\Carbon;

class ReportService
{

    /**
     * 日にちのログ一覧
     * @param User $user
     * @param Carbon $requestDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLogs(User $user, Carbon $requestDate)
    {
        // レポートを取得
        return TimeLog::with('project')
            ->where('user_id', $user->id)
            ->whereDate('start_at', $requestDate->format('Y-m-d'))
//            ->whereDay('start_at', $requestDate)
            ->orderBy('start_at', 'asc')
            ->get();
    }

    /**
     * 期間の時間合計
     * @param string $type 取得する範囲(year 年/month 月)
     * @param User $user
     * @param Carbon $requestDate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTermSum(string $type, User $user, Carbon $requestDate)
    {
        $query = TimeLog::where('user_id', $user->id)
            ->whereYear('start_at', $requestDate);

        if ($type === 'month') {
            $query = $query->whereMonth('start_at', $requestDate);
        }

        $query = $query
            ->orderBy('start_at')
            ->get()
            ->groupBy(function ($row) use ($type) {
                if ($type === 'month') {
                    return $row->start_at->format('d');
                } else {
                    return $row->start_at->format('m');
                }
            })
            ->map(function ($day) {
                return $day->sum('time');
            });

        return $query;
    }

    /**
     * 文字列をフォーマットしてCarbonを返す
     *
     * @param string|null $year
     * @param string|null $month
     * @param string|null $day
     * @return Carbon
     * @throws \Exception
     */
    public function getDateRequest(string $year = null, string $month = null, string $day = null)
    {
        if ($year) {
            $request = $year . '-';

            if ($month) {
                $request .= $month . '-';
            } else {
                $request .= '01-';
            }

            if ($day) {
                $request .= $day;
            } else {
                $request .= '01';
            }

            $date = new Carbon($request);
        } else {
            $date = new Carbon();
        }

        return $date;
    }
}
