<?php

namespace App\Services;

use App\Task;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TaskService
{
    /**
     * タスク保存処理
     *
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        try {
            DB::beginTransaction();

            $task = Task::create([
                'content' => Arr::get($request, 'content'),
            ]);

            DB::commit();
            return $task;
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    /**
     * タスク更新処理
     *
     * @param $request
     * @param Task $task
     * @return Task
     */
    public function update($request, Task $task)
    {
        try {
            DB::beginTransaction();

            $task->update([
                'content' => Arr::get($request, 'content'),
            ]);

            DB::commit();
            return $task;
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }

    /**
     * タスク削除処理
     *
     * @param Task $task
     */
    public function delete(Task $task)
    {
        try {
            DB::beginTransaction();

            $task->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }
    }
}
