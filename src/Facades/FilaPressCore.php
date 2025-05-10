<?php

namespace RectitudeOpen\FilaPressCore\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RectitudeOpen\FilaPressCore\FilaPressCore
 */
class FilaPressCore extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RectitudeOpen\FilaPressCore\FilaPressCore::class;
    }
}
