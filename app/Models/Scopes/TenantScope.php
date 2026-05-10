<?php

namespace App\Models\Scopes;

use App\Services\TenantContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Global scope: every query on a tenant-aware model is automatically filtered
 * to the current tenant. Bypass it intentionally with ->withoutGlobalScope(...)
 * (e.g. for super-admin tools or background jobs that span tenants).
 */
class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $tenantId = app(TenantContext::class)->id();

        if ($tenantId !== null) {
            $builder->where(
                $model->getTable() . '.' . $model->getTenantColumn(),
                $tenantId
            );
        }
    }
}
