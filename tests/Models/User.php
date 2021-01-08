<?php

namespace SamuelNitsche\LaravelFeatureFlags\Tests\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use SamuelNitsche\LaravelFeatureFlags\Traits\HasFeatures;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use HasFeatures, Authorizable, Authenticatable;

    protected $guarded = [];

    public $timestamps = false;
}