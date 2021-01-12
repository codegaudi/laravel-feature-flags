<?php

namespace Codegaudi\LaravelFeatureFlags;

use Codegaudi\LaravelFeatureFlags\Contracts\FeatureRepositoryInterface;
use Codegaudi\LaravelFeatureFlags\Repositories\EloquentRepository;
use Illuminate\Support\ServiceProvider;

class LaravelFeatureFlagsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishMigrations();
        }
    }

    public function register()
    {
        $this->app->singleton(FeatureRepositoryInterface::class, function () {
            return new EloquentRepository;
        });
    }

    protected function publishMigrations()
    {
        $migrationFileNames = [
            'create_features_table.php',
            'create_featurables_table.php',
        ];

        foreach ($migrationFileNames as $migrationFileName) {
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }
        }
    }

    protected function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
