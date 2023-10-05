<?php

namespace App\Actions;

use App\Traits\AsAction;
use App\Models\Task;
use App\Data\TaskFiltersData;

class GetTasksAction
{
    use AsAction;

    public function __invoke(TaskFiltersData $filters)
    {
        return Task::query()
            ->latest('updated_at')
            ->when(
                $filters->completed,
                fn ($query) => $query->where('is_completed', true)
            )
            ->get();
    }
}

