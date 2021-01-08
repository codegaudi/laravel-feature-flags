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

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-feature-flags'),
            ], 'views');

            $migrationFileName = 'create_laravel_feature_flags_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaravelFeatureFlagsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-feature-flags');
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
