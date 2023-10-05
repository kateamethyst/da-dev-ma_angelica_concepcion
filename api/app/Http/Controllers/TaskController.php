<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Actions\GetTasksAction;
use App\Actions\CreateTaskAction;
use App\Actions\UpdateTaskAction;
use App\Actions\RemoveTaskAction;
use App\Http\Resources\TaskResource;
use App\Data\TaskFiltersData;
use App\Data\TaskData;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TaskFiltersData $filters):  Response|JsonResponse
    {
        return $this->successResourceResponse(
            TaskResource::collection(
                GetTasksAction::run($filters)
            ),
            'Ok',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, TaskData $data): Response|JsonResponse
    {
        return $this->successResourceResponse(
            TaskResource::make(
                CreateTaskAction::run($data),
            ),
            'Task successfully created.'
        );
    }

    public function update(UpdateTaskRequest $request, Task $task, TaskData $data): Response|JsonResponse
    {
        return $this->successResourceResponse(
            TaskResource::make(
                UpdateTaskAction::run($task, $data),
            ),
            'Task successfully updated.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        return $this->successResourceResponse(
            TaskResource::make(
                RemoveTaskAction::run($task),
            ),
            'Task successfully removed.'
        );
    }
}
