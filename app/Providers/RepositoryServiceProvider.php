<?php

namespace App\Providers;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\UserPreferenceRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\TenantRepository;
use App\Repositories\Eloquent\UserPreferenceRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Binds repository contracts to their Eloquent implementations.
 *
 * Add new bindings here as features grow. Controllers and services should
 * always type-hint the *Interface, never the concrete class — that is what
 * lets us swap storage drivers (e.g. for tests) without touching callers.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array<class-string, class-string> */
    public array $bindings = [
        TenantRepositoryInterface::class         => TenantRepository::class,
        UserRepositoryInterface::class           => UserRepository::class,
        UserPreferenceRepositoryInterface::class => UserPreferenceRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    public function boot(): void
    {
    }
}
