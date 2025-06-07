<?php

declare(strict_types=1);

use RectitudeOpen\FilaPressCore\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

pest()->extend(TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');
