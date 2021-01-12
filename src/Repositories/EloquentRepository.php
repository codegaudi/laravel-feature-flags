<?php

namespace Codegaudi\LaravelFeatureFlags\Repositories;

use Codegaudi\LaravelFeatureFlags\Contracts\FeatureRepositoryInterface;
use Codegaudi\LaravelFeatureFlags\Models\Feature;

class EloquentRepository implements FeatureRepositoryInterface
{
    public function findByName($name): ?Feature
    {
        return Feature::where('name', $name)->firstOrFail();
    }

    public function save($name, $isEnabled): bool
    {
        return Feature::where('name', $name)
            ->firstOr(function () {
                return new Feature;
            })
            ->fill([
                'name' => $name,
                'is_enabled' => $isEnabled,
            ])->save();
    }

    public function remove($name): bool
    {
        return Feature::where('name', $name)
            ->firstOrFail()
            ->delete();
    }

    public function enable($name): bool
    {
        return Feature::where('name', $name)
            ->firstOrFail()
            ->fill([
                'is_enabled' => true,
            ])
            ->save();
    }

    public function disable($name): bool
    {
        return Feature::where('name', $name)
            ->firstOrFail()
            ->fill([
                'is_enabled' => false,
            ])
            ->save();
    }

    public function isEnabled($name): bool
    {
        return Feature::where('name', $name)
            ->firstOrFail()
            ->isEnabled();
    }

    public function isDisabled($name): bool
    {
        return $this->isEnabled($name) === false;
    }
}
