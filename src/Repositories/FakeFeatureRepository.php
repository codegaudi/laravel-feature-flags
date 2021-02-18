<?php

namespace Codegaudi\LaravelFeatureFlags\Repositories;

use Codegaudi\LaravelFeatureFlags\Contracts\FeatureRepositoryInterface;
use Codegaudi\LaravelFeatureFlags\Models\Feature;
use PHPUnit\Framework\Assert;

class FakeFeatureRepository implements FeatureRepositoryInterface
{
    public $features = [];

    public function findByName($name): ?Feature
    {
        return new Feature([
            'name' => $this->features[$name],
        ]);
    }

    public function save($name, $isEnabled): bool
    {
        $this->features[$name] = $isEnabled;

        return true;
    }

    public function remove($name): bool
    {
        unset($this->features[$name]);

        return true;
    }

    public function enable($name): bool
    {
        $this->save($name, true);

        return true;
    }

    public function disable($name): bool
    {
        $this->save($name, false);

        return true;
    }

    public function isEnabled($name): bool
    {
        return $this->features[$name];
    }

    public function isDisabled($name): bool
    {
        return ! $this->features[$name];
    }

    public function assertFeatureExists($name)
    {
        Assert::assertArrayHasKey($name, $this->features, "Expected feature {$name} was not found.");
    }

    public function assertFeatureMissing($name)
    {
        Assert::assertArrayNotHasKey($name, $this->features, "Unexpected feature {$name} was found.");
    }

    public function assertFeatureEnabled($name)
    {
        Assert::assertTrue($this->features[$name], "Failed asserting that the feature {$name} is enabled.");
    }

    public function assertFeatureDisabled($name)
    {
        Assert::assertFalse($this->features[$name], "Failed asserting that the feature {$name} is disabled.");
    }
}
