<?php

namespace SamuelNitsche\LaravelFeatureFlags;

use Illuminate\Support\ServiceProvider;
use SamuelNitsche\LaravelFeatureFlags\Commands\LaravelFeatureFlagsCommand;

class LaravelFeatureFlagsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-feature-flags.php' => config_path('laravel-feature-flags.php'),
            ], 'config');

            $migrationFileNames = [
                'create_features_table.php',
                'create_featurables_table.php',
            ];

            foreach ($migrationFileNames as $migrationFileName) {
                if (!$this->migrationFileExists($migrationFileName)) {
                    $this->publishes([
                        __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                    ], 'migrations');
                }
            }

            $this->commands([
                LaravelFeatureFlagsCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-feature-flags.php', 'laravel-feature-flags');
    }

    public static function migrationFileExists(string $migrationFileName): bool
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
