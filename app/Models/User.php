<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App-level User model.
 *
 * Note: this app uses *custom* session-based auth (see App\Services\AuthService),
 * so this model intentionally does NOT extend Illuminate\Foundation\Auth\User.
 * That keeps us off the Auth facade / guard machinery while still letting us
 * use Eloquent features (mass assignment, casts, relations, scopes).
 *
 * Passwords are still hashed transparently via the `hashed` attribute cast.
 */
class User extends Model
{
    use HasFactory;
    use BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'name',
        'username',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password'  => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function preference(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }
}
