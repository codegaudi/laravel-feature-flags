<?php

namespace SamuelNitsche\LaravelFeatureFlags\Traits;

use SamuelNitsche\LaravelFeatureFlags\Models\Feature;

trait HasFeatures
{
    public function features()
    {
        return $this->morphToMany(Feature::class, 'featurable')->where('is_enabled', true);
    }

    public function enableFeature(Feature $feature)
    {
        $this->features()->attach($feature);
    }

    public function disableFeature(Feature $feature)
    {
        return $this->features()->detach($feature);
    }

    public function hasFeature(Feature $feature)
    {
        return $this->features->contains($feature);
    }
}