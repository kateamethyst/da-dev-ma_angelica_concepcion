<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class TaskFiltersData extends Data
{
    public function __construct(
        public ?bool $completed = false,
    ) {
    }

    public static function fromRequest(Request $request): static
    {
        return new static(
            completed: $request->boolean('completed'),
        );
    }
}
