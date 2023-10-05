<?php

namespace App\Actions;

use App\Traits\AsAction;
use App\Models\Task;
use App\Data\TaskData;

class UpdateTaskAction
{
    use AsAction;

    public function __invoke(Task $task, TaskData $data): Task
    {
        Task::query()->where('id', $task->id)->update([
            'description' => $data->description ? $data->description : $task->description,
            'is_completed' => $data->isCompleted
        ]);

        return $task->refresh();
    }
}

