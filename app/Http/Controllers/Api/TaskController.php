<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

use App\Http\Resources\TaskResource;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $tasks = Task::with('user')
                    ->orderBy('id', 'desc')
//                    ->where('status_id', '!=', 4)
                    ->get();
        return TaskResource::collection($tasks);
    }

    /**
     * @param TaskRequest $request
     * @return TaskResource
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());
        return TaskResource::make($task);
    }

    /**
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    /**
     * @param TaskRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return TaskResource::make($task);
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return response()->json(null, 204);
        } else {
            return response()->json(null, 409);
        }
    }

    /**
     * start_atに現在の時間を記録
     * @param Task $task
     */
    public function toggleTimer(Task $task)
    {
        // 別の担当のタスクは戻る
        if (\Auth::id() !== $task->user->id) {
            return response()->json('他の担当者のタスクは実行できません。', 409);
        }

        // 他のタスクが実行中なら戻る
        if ($runTaskID = \Auth::user()->run_task_id) {
            if ($runTaskID !== $task->id) {
                return response()->json('タスクID:' . $runTaskID . 'が実行中です。', 409);
            }
        }

        // タイマーが実行中の場合は停止して時間を加算
        if ($task->start_at) {
            // 開始と停止時間の差分を取得（分）
            $time = $task->start_at->diffInMinutes(Carbon::now());

            $task->time += $time;
            $task->start_at = null;

            $task->user->run_task_id = null;
        }
        // タイマーが実行されていない場合は開始
        else {
            $task->start_at = Carbon::now();
            $task->user->run_task_id = $task->id;
        }

        $task->save();
        $task->user->save();

        return TaskResource::make($task);
    }
}
