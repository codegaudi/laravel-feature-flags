<?php

namespace SamuelNitsche\LaravelFeatureFlags\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded = [];

    public function enable($enable = true)
    {
        $this->update([
            'is_enabled' => $enable,
        ]);

        return $this;
    }

    public function disable()
    {
        return $this->enable(false);
    }

    public function isEnabled()
    {
        return $this->is_enabled;
    }
}
