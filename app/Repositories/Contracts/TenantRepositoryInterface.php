<?php

namespace App\Repositories\Contracts;

use App\Models\Tenant;

interface TenantRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug): ?Tenant;
}
