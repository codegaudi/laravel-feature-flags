<?php

namespace Codegaudi\LaravelFeatureFlags\Tests;

use Codegaudi\LaravelFeatureFlags\Facades\Feature;

class FacadeTest extends TestCase
{
    protected $fake;

    public function setUp(): void
    {
        parent::setUp();

        $this->fake = Feature::fake();

        Feature::add('my-feature', false);
    }

    /** @test */
    public function it_adds_features()
    {
        $this->fake->assertFeatureExists('my-feature');
    }

    /** @test */
    public function it_removes_features()
    {
        Feature::remove('my-feature');

        $this->fake->assertFeatureMissing('my-feature');
    }

    /** @test */
    public function it_enables_features()
    {
        Feature::enable('my-feature');

        $this->fake->assertFeatureEnabled('my-feature');
    }

    /** @test */
    public function it_disables_features()
    {
        Feature::disable('my-feature');

        $this->fake->assertFeatureDisabled('my-feature');
    }

    /** @test */
    public function it_determines_if_features_are_enabled()
    {
        Feature::enable('my-feature');

        $this->assertTrue(Feature::isEnabled('my-feature'));
    }

    /** @test */
    public function it_determines_if_features_are_disabled()
    {
        Feature::disable('my-feature');

        $this->assertTrue(Feature::isDisabled('my-feature'));
    }
}