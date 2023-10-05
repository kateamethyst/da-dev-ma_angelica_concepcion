<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Testing\Fluent\AssertableJson;

class TaskControllerTest extends TestCase
{

    public function test_can_get_list_of_todos(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson('/api/tasks');

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'error_code' => null,
            'message'    => 'Ok',
            'success'    => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id'           => $task->id,
            'description'  => $task->description,
            'is_completed' => $task->is_completed
        ]);
    }

    public function test_can_add_todo(): void
    {
        $input = [
            'description' => 'Learn how to create banana cupcake.'
        ];

        $response = $this->postJson("api/tasks", $input);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'description'  => $input['description'],
            'is_completed' => false
        ]);


        $response = $this->postJson("api/tasks", [
            'description' => ''
        ]);

        $response->assertStatus(422);
    }

    public function test_can_complete_todo(): void
    {
        $task = Task::factory()->create();

        $response = $this->putJson("api/tasks/{$task->id}", [
            'isCompleted' => true
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'id'           => $task->id,
            'description'  => $task->description,
            'is_completed' => true
        ]);

        $response = $this->putJson("api/tasks/{$task->id}", [
            'isCompleted' => false,
            'description' => $newDescription = 'Watch onepiece episode 1078.',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'id'           => $task->id,
            'description'  => $newDescription,
            'is_completed' => false
        ]);
    }

    public function test_can_remove_todo(): void
    {
        $task = Task::factory()->create();
        $response = $this->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', [
            'id'           => $task->id
        ]);
    }
}
