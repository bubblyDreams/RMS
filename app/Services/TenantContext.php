<?php

namespace App\Services;

use App\Models\Tenant;

/**
 * Holds the current tenant for the lifetime of a single request (or job).
 *
 * Bound as a singleton in AppServiceProvider so every consumer in the
 * container — repositories, models (via trait), middleware — sees the
 * same instance per request.
 *
 * Set by EnsureTenantContext middleware (web) or explicitly in queue jobs.
 */
class TenantContext
{
    protected ?Tenant $tenant = null;

    public function set(Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function clear(): void
    {
        $this->tenant = null;
    }

    public function get(): ?Tenant
    {
        return $this->tenant;
    }

    public function id(): ?int
    {
        return $this->tenant?->id;
    }

    public function isResolved(): bool
    {
        return $this->tenant !== null;
    }
}
