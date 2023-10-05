<?php

namespace App\Actions;

use App\Traits\AsAction;
use App\Models\Task;
use App\Data\TaskData;

class CreateTaskAction
{
    use AsAction;

    public function __invoke(TaskData $data): Task
    {
        $task = Task::query()->create([
            'description' => $data->description
        ]);

        return $task;

    }
}

