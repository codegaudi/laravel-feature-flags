<?php

namespace Codegaudi\LaravelFeatureFlags\Tests;

use Codegaudi\LaravelFeatureFlags\Repositories\EloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EloquentRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new EloquentRepository;
    }

    /** @test */
    public function it_adds_features()
    {
        $this->assertDatabaseMissing('features', [
            'name' => 'my-feature',
        ]);

        $this->repository->save('my-feature', true);

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
        ]);
    }

    /** @test */
    public function it_removes_features()
    {
        $this->repository->save('my-feature', true);

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
        ]);

        $this->repository->remove('my-feature');

        $this->assertDatabaseMissing('features', [
            'name' => 'my-feature',
        ]);
    }

    /** @test */
    public function it_enables_features()
    {
        $this->repository->save('my-feature', false);

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
            'is_enabled' => false,
        ]);

        $this->repository->enable('my-feature');

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
            'is_enabled' => true,
        ]);
    }

    /** @test */
    public function it_disables_features()
    {
        $this->repository->save('my-feature', true);

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
            'is_enabled' => true,
        ]);

        $this->repository->disable('my-feature');

        $this->assertDatabaseHas('features', [
            'name' => 'my-feature',
            'is_enabled' => false,
        ]);
    }

    /** @test */
    public function it_determines_if_feature_is_enabled()
    {
        $this->repository->save('my-feature', true);

        $this->assertTrue(
            $this->repository->isEnabled('my-feature')
        );
    }

    /** @test */
    public function it_determines_if_feature_is_disabled()
    {
        $this->repository->save('my-feature', false);

        $this->assertTrue(
            $this->repository->isDisabled('my-feature')
        );
    }
}