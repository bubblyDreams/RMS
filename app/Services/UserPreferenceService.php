<?php

namespace App\Services;

use App\Models\UserPreference;
use App\Repositories\Contracts\UserPreferenceRepositoryInterface;
use InvalidArgumentException;

class UserPreferenceService
{
    /** Defaults used when a user has no row yet. */
    public const DEFAULTS = [
        'theme'             => UserPreference::THEME_LIGHT,
        'sidebar_collapsed' => false,
    ];

    public function __construct(
        protected UserPreferenceRepositoryInterface $preferences,
    ) {
    }

    public function forUser(int $userId): array
    {
        $row = $this->preferences->findForUser($userId);

        return $row
            ? [
                'theme'             => $row->theme,
                'sidebar_collapsed' => (bool) $row->sidebar_collapsed,
            ]
            : self::DEFAULTS;
    }

    public function update(int $userId, array $attributes): UserPreference
    {
        if (isset($attributes['theme'])
            && ! in_array($attributes['theme'], UserPreference::ALLOWED_THEMES, true)) {
            throw new InvalidArgumentException('Unsupported theme value.');
        }

        // Whitelist — never trust the request body to set arbitrary columns.
        $clean = array_intersect_key($attributes, [
            'theme'             => true,
            'sidebar_collapsed' => true,
        ]);

        return $this->preferences->upsertForUser($userId, $clean);
    }
}
