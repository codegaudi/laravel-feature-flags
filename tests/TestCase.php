<?php

namespace Codegaudi\LaravelFeatureFlags\Tests;

use Codegaudi\LaravelFeatureFlags\LaravelFeatureFlagsServiceProvider;
use Codegaudi\LaravelFeatureFlags\Tests\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Codegaudi\\LaravelFeatureFlags\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        User::create(['name' => 'Test User', 'email' => 'test@user.com']);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelFeatureFlagsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
        });

        include_once __DIR__ . '/../database/migrations/create_features_table.php.stub';
        (new \CreateFeaturesTable())->up();
        include_once __DIR__ . '/../database/migrations/create_featurables_table.php.stub';
        (new \CreateFeaturablesTable())->up();
    }
}
