<?php

namespace App\Services;

use App\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Config\Definition\Exception\Exception;

class TaskService
{
    public function store($request)
    {
        try {
            DB::beginTransaction();

            $task = Task::create([
                'content' => Arr::get($request, 'content'),
            ]);

            DB::commit();
            return $task;
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    public function update($request, Task $task)
    {
        try {
            DB::beginTransaction();

            $task->update([
                'content' => Arr::get($request, 'content'),
            ]);

            DB::commit();
            return $task;
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    public function delete(Task $task)
    {
        try {
            DB::beginTransaction();

            $task->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }
}
