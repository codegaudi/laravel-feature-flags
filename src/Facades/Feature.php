<?php

namespace Codegaudi\LaravelFeatureFlags\Facades;

use Codegaudi\LaravelFeatureFlags\FeatureManager;
use Codegaudi\LaravelFeatureFlags\Repositories\FakeFeatureRepository;
use Illuminate\Support\Facades\Facade;

class Feature extends Facade
{
    public static function fake()
    {
        static::swap(new FeatureManager($fake = new FakeFeatureRepository()));

        return $fake;
    }

    protected static function getFacadeAccessor()
    {
        return FeatureManager::class;
    }
}
