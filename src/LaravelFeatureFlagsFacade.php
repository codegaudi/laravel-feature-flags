<?php

namespace SamuelNitsche\LaravelFeatureFlags;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SamuelNitsche\LaravelFeatureFlags\LaravelFeatureFlags
 */
class LaravelFeatureFlagsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-feature-flags';
    }
}
