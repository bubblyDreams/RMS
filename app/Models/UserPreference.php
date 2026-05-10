<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Stores per-user UI preferences (theme, sidebar state, locale, etc.).
 *
 * Intentionally NOT tenant-scoped via the trait: it inherits scoping
 * indirectly through user_id, and we want the user-preference endpoints
 * to remain callable even before the tenant context is fully resolved.
 */
class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'theme',
        'sidebar_collapsed',
    ];

    protected function casts(): array
    {
        return [
            'sidebar_collapsed' => 'boolean',
        ];
    }

    public const THEME_LIGHT = 'light';
    public const THEME_DARK  = 'dark';

    public const ALLOWED_THEMES = [
        self::THEME_LIGHT,
        self::THEME_DARK,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
