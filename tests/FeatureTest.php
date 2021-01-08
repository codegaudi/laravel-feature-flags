<?php

namespace Codegaudi\LaravelFeatureFlags\Tests;

use Codegaudi\LaravelFeatureFlags\Database\Factories\FeatureFactory;
use Codegaudi\LaravelFeatureFlags\Models\Feature;
use Codegaudi\LaravelFeatureFlags\Tests\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_features()
    {
        $feature = new Feature;

        $this->assertInstanceOf(Feature::class, $feature);
    }

    /** @test */
    public function features_can_be_enabled()
    {
        $feature = FeatureFactory::new()->create([
            'is_enabled' => false,
        ]);

        $this->assertFalse($feature->isEnabled());

        $feature->enable();

        $this->assertTrue($feature->isEnabled());
    }

    /** @test */
    public function features_can_be_disabled()
    {
        $feature = FeatureFactory::new()->create([
            'is_enabled' => true,
        ]);

        $this->assertTrue($feature->isEnabled());

        $feature->disable();

        $this->assertFalse($feature->isEnabled());
    }

    /** @test */
    public function features_can_be_enabled_per_user()
    {
        $feature = FeatureFactory::new()->create();
        $user = User::first();

        $user->enableFeature($feature);

        $this->assertTrue($user->hasFeature($feature));
    }

    /** @test */
    public function features_can_be_disabled_per_user()
    {
        $feature = FeatureFactory::new()->create();
        $user = User::first();

        $user->enableFeature($feature);

        $this->assertTrue($user->hasFeature($feature));

        $user->disableFeature($feature);

        $this->assertFalse($user->fresh()->hasFeature($feature));
    }

    /** @test */
    public function features_for_users_are_disabled_when_feature_is_globally_disabled()
    {
        $feature = FeatureFactory::new()->create();
        $user = User::first();

        $user->enableFeature($feature);

        $this->assertTrue($user->hasFeature($feature));

        $feature->disable();

        $this->assertFalse($user->fresh()->hasFeature($feature));
    }
}
