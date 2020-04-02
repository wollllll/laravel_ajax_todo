<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Task;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * メイン画面
     *
     * @return Factory|View
     */
    public function index()
    {
        $tasks = Task::latest()->take(10)->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * タスク保存処理
     *
     * @param Request $request
     * @param TaskService $service
     * @return ResponseFactory|Response
     */
    public function store(Request $request, TaskService $service)
    {
        $task = $service->store($request);

        return response(view('tasks.list', compact('task')));
    }

    /**
     * タスク更新処理
     *
     * @param Request $request
     * @param Task $task
     * @param TaskService $service
     * @return ResponseFactory|Response
     */
    public function update(Request $request, Task $task, TaskService $service)
    {
        $updatedTask = $service->update($request, $task);

        return response($updatedTask);
    }

    /**
     * タスク削除処理
     *
     * @param Task $task
     * @param TaskService $service
     * @return ResponseFactory|Response
     */
    public function destroy(Task $task, TaskService $service)
    {
        $service->delete($task);

        return response($task);
    }
}
