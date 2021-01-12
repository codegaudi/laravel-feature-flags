<?php

namespace Codegaudi\LaravelFeatureFlags\Contracts;

interface FeatureRepositoryInterface
{
    public function save($name, $isEnabled): bool;

    public function remove($name): bool;

    public function enable($name): bool;

    public function disable($name): bool;

    public function isEnabled($name): bool;

    public function isDisabled($name): bool;
}