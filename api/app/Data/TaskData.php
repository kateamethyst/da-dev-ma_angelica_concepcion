<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TaskData extends Data
{
    public function __construct(
        public ?string $description,
        public ?bool $isCompleted,
    ) {
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            isCompleted: $request->bool('is_completed', false),
            description: $request->input('description'),
        );
    }
}
