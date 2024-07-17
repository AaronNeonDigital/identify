<?php

namespace Neondigital\Identify\Actions;

abstract class BaseAction
{
    public static function make()
    {
        return app(static::class);
    }

    public static function run(...$arguments)
    {
        return static::make()->handle(...$arguments);
    }
}
