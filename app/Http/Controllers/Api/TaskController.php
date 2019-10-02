<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TimeLog;
use App\Services\TimerService;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

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
     * 複数削除
     * @param string $taskIds
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletes(string $taskIds)
    {
        if (Task::destroy(explode(',',$taskIds))) {
            return response()->json(null, 204);
        } else {
            return response()->json(null, 409);
        }
    }

    /**
     * start_atに現在の時間を記録
     * @param Task $task
     */
    public function toggleTimer(Task $task, Request $request, TimerService $timerService)
    {
        $user = \Auth::user();

        // 別の担当のタスクは戻る
        if ($user->id !== $task->user->id) {
            return response()->json('他の担当者のタスクは実行できません。', 409);
        }

        // 他のタスクが実行中なら戻る
        if ($user->run_task_id) {
            if ($user->run_task_id !== $task->id) {
                return response()->json('タスクID:' . $user->run_task_id . 'が実行中です。', 409);
            }
        }

        // 時間を保存
        $task = $timerService->toggleTimer($user, $request->start_at, $task);

        return TaskResource::make($task);
    }
}
