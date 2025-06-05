<?php

declare(strict_types=1);

namespace RectitudeOpen\FilaPressCore\Commands;

use Illuminate\Console\Command;

class FilaPressCoreCommand extends Command
{
    public $signature = 'filapress-core';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
