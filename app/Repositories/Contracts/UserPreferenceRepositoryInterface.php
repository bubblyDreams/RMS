<?php

namespace App\Repositories\Contracts;

use App\Models\UserPreference;

interface UserPreferenceRepositoryInterface extends BaseRepositoryInterface
{
    public function findForUser(int $userId): ?UserPreference;

    public function upsertForUser(int $userId, array $attributes): UserPreference;
}
