<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

//        $tasks = Task::with(['user' => function($q) {
//            $q->select('id', display_name');
//        }])->orderBy('id', 'desc')->get();

        $tasks = Task::with('user')->orderBy('id', 'desc')->get();
        return TaskResource::collection($tasks);
    }

    /**
     * @param Request $request
     * @return TaskResource
     */
    public function store(Request $request)
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
//        return $task;
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return TaskResource
     */
    public function update(Request $request, Task $task)
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
}
