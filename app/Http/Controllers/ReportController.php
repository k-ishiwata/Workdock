<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\TimeLog;
use App\Http\Requests\TimeLogRequest;
use App\Services\ReportService;
use Carbon\Carbon;

class ReportController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::OrderBy('id', 'desc')->get();
        $projects = Project::OrderBy('id', 'desc')->get();
        $now = new Carbon();
        return view('reports.index', compact('users', 'projects', 'now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::OrderBy('id', 'desc')->get();
        return view('reports.create', compact('projects'));
    }

    /**
     * @param TimeLogRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TimeLogRequest $request)
    {
        // 開始時間と終了時間の差をtimeに入れる
        $diffHour = $request->end_time_hour - $request->start_time_hour;
        $diffMin = $request->end_time_min - $request->start_time_min;
        $time = ($diffHour * 60) + $diffMin;

        // 時間をリクエストの値に変更（日付はそのまま）
        $start_at = $request->start_at .' '. $request->start_time_hour .':'.$request->start_time_min;

        $request->merge([
            'start_at' => Carbon::create($start_at),
            'time' => $time,
            'user_id' => $request->user_id
        ]);

        TimeLog::create($request->all());

        return redirect()
            ->route('reports.show', [
                'user' => $request->input('user_id'),
                'date' => $request->start_at->format('Y-m-d')
            ])
            ->with('alert', 'レポート情報を登録しました。');
    }


    /**
     * @param User $user
     * @param string|null $year
     * @param string|null $month
     * @param string|null $day
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function show(User $user, string $year = null, string $month = null, string $day = null)
    {
        $users = User::all();
        $requestDate = $this->reportService->getDateRequest($year, $month, $day);

        if($day) {
            $timeLogs = $this->reportService->getLogs($user, $requestDate);

            return view('reports.show-day', compact('user', 'users', 'timeLogs', 'requestDate'));
        } elseif($month) {
            $timeLogs = $this->reportService->getTermSum('month', $user, $requestDate);

            return view('reports.show-month', compact('user', 'users', 'timeLogs', 'requestDate'));
        } elseif($year) {
            $timeLogs = $this->reportService->getTermSum('year', $user, $requestDate);
            $maxTime = $timeLogs->max();

            return view('reports.show-year', compact('user', 'users', 'timeLogs', 'requestDate', 'maxTime'));
        } else {
            $timeLogs = $this->reportService->getLogs($user, $requestDate);
            return view('reports.show-day', compact('user', 'users', 'timeLogs', 'requestDate'));
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $timeLog = TimeLog::findOrFail($id);
        $projects = Project::OrderBy('id', 'desc')->get();
//        $user_id = \Request::input('user');

        return view('reports.edit', compact('timeLog', 'projects'));
    }

    /**
     * @param TimeLogRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TimeLogRequest $request, int $id)
    {
        // 開始時間と終了時間の差をtimeに入れる
        $diffHour = $request->end_time_hour - $request->start_time_hour;
        $diffMin = $request->end_time_min - $request->start_time_min;
        $time = ($diffHour * 60) + $diffMin;

        $timeLog = TimeLog::findOrFail($id);

        // 時間をリクエストの値に変更（日付はそのまま）
//        $start_at = $timeLog->start_at->setTime($request->start_time_hour, $request->start_time_min);
        $start_at = $request->start_at .' '. $request->start_time_hour .':'.$request->start_time_min;

        $request->merge([
            'start_at' => Carbon::create($start_at),
            'time' => $time
        ]);

        $timeLog->update($request->all());

        return redirect()
            ->route('reports.show', [
                'user' => $request->input('user_id'),
                'date' => $request->start_at->format('Y/m/d')
            ])
            ->with('alert', 'レポート情報を更新しました。');
    }

    /**
     * @param TimeLog $timeLog
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $timeLog = TimeLog::findOrFail($id);
        $timeLog->delete();

        return redirect(url()->previous())
            ->with('alert', 'レポート情報を削除しました。');
    }
}
