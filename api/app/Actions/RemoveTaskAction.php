<?php

namespace App\Actions;

use App\Traits\AsAction;
use App\Models\Task;
use App\Data\TaskData;

class RemoveTaskAction
{
    use AsAction;

    public function __invoke(Task $task): Task
    {
        Task::query()->find($task->id)->delete();

        return $task;
    }
}

