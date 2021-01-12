<?php

namespace Codegaudi\LaravelFeatureFlags;

use Codegaudi\LaravelFeatureFlags\Contracts\FeatureRepositoryInterface;

class FeatureManager
{
    protected FeatureRepositoryInterface $repository;

    public function __construct(FeatureRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function add($name, $isEnabled = true): bool
    {
        return $this->repository->save($name, $isEnabled);
    }

    public function remove($name): bool
    {
        return $this->repository->remove($name);
    }

    public function enable($name): bool
    {
        return $this->repository->enable($name);
    }

    public function disable($name): bool
    {
        return $this->repository->disable($name);
    }

    public function isEnabled($name): bool
    {
        return $this->repository->isEnabled($name);
    }

    public function isDisabled($name): bool
    {
        return $this->repository->isDisabled($name);
    }
}