<?php

namespace App\Providers;

use App\Services\TenantContext;
use App\View\Composers\PreferenceComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Single TenantContext instance per request. Critical: every consumer
        // (middleware, repositories, the BelongsToTenant trait) must look at
        // the same object, so this MUST be a singleton.
        $this->app->singleton(TenantContext::class, fn () => new TenantContext);
    }

    public function boot(): void
    {
        View::composer(['layouts.app'], PreferenceComposer::class);
    }
}
