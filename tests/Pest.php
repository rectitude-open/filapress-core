<?php

declare(strict_types=1);

use RectitudeOpen\FilaPressCore\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class)->in(__DIR__);

uses(TestCase::class, RefreshDatabase::class)
    ->in('Feature');
