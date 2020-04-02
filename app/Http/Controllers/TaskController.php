<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request, TaskService $service)
    {
        $task = $service->store($request);

        return response(view('tasks.list', compact('task')));
    }

    public function update(Request $request, Task $task, TaskService $service)
    {
        $updatedTask = $service->update($request, $task);

        return response($updatedTask);
    }
}
