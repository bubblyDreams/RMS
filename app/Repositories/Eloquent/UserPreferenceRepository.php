<?php

namespace App\Repositories\Eloquent;

use App\Models\UserPreference;
use App\Repositories\Contracts\UserPreferenceRepositoryInterface;

class UserPreferenceRepository extends BaseRepository implements UserPreferenceRepositoryInterface
{
    public function __construct(UserPreference $model)
    {
        parent::__construct($model);
    }

    public function findForUser(int $userId): ?UserPreference
    {
        return $this->query()->where('user_id', $userId)->first();
    }

    public function upsertForUser(int $userId, array $attributes): UserPreference
    {
        return $this->model->newQuery()->updateOrCreate(
            ['user_id' => $userId],
            $attributes
        );
    }
}
