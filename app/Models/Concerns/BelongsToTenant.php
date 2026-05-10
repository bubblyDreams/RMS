<?php

namespace App\Models\Concerns;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use App\Services\TenantContext;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Use this trait on any tenant-owned Eloquent model. It does two things:
 *  1. Adds a global TenantScope so all queries are filtered by tenant_id.
 *  2. Auto-fills tenant_id from the current TenantContext when creating rows.
 *
 * Override getTenantColumn() if your column is not literally `tenant_id`.
 */
trait BelongsToTenant
{
    protected static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            $column = $model->getTenantColumn();
            if (empty($model->{$column})) {
                $model->{$column} = app(TenantContext::class)->id();
            }
        });
    }

    public function getTenantColumn(): string
    {
        return 'tenant_id';
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, $this->getTenantColumn());
    }
}
