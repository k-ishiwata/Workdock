<?php

namespace App\Services;

use App\Models\TimeLog;
//use Carbon\Carbon;

class TimerService
{
    /**
     * 実行中はログを保存・未実行なら実行
     * @param $user
     * @param $startAt
     * @param $task
     * @return mixed
     */
    public function toggleTimer($user, $startAt, $task)
    {
        // 実行中のタスクがある場合停止
        if ($user->run_task_id) {

            // 開始と停止時間の差分を取得（分）
//            $time = $task->start_at->diffInMinutes(Carbon::now());
            $time = $task->start_at->diffInMinutes($startAt);

            // ログを記録
            TimeLog::create([
                'title' => $task->title,
                'start_at' => $task->start_at,
                'time' => $time,
                'user_id' => $user->id,
                'project_id' => $task->project->id ?? null
            ]);

            $task->start_at = null;
            $task->time += $time;
            $user->run_task_id = null;
        }
        // タイマーが実行されていない場合は開始
        else {
//            $task->start_at = Carbon::now();
            $task->start_at = $startAt;
            $user->run_task_id = $task->id;
        }

        $task->save();
        $user->save();

        return $task;
    }

}
