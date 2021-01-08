<?php

namespace SamuelNitsche\LaravelFeatureFlags\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SamuelNitsche\LaravelFeatureFlags\Models\Feature;

class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'is_enabled' => true,
        ];
    }
}

