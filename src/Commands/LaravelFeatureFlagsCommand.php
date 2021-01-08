<?php

namespace SamuelNitsche\LaravelFeatureFlags\Commands;

use Illuminate\Console\Command;

class LaravelFeatureFlagsCommand extends Command
{
    public $signature = 'laravel-feature-flags';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
