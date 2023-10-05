<?php

namespace App\Traits;

use App\Exceptions\InvalidActionException;

trait AsAction
{
    public static function make(): static
    {
        return app(static::class);
    }

    public static function run(...$params): mixed
    {
        $action = static::make();

        if (! $action) {
            throw new InvalidActionException(__CLASS__);
        }

        $method = method_exists($action, 'handle') ? 'handle' : '__invoke';

        return $action->{$method}(...$params);
    }
}
