<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;

/**
 * Custom session-based authentication service.
 *
 * We deliberately bypass Laravel's Auth facade / guards / providers so the
 * project can have a single, transparent auth path that the team owns end to
 * end. Everything funnels through this class:
 *
 *   - login()    : verify credentials, persist user_id in the session
 *   - logout()   : forget user_id and rotate the session id
 *   - check()    : is there an authenticated user in the session?
 *   - user()     : lazy-load the current user model (cached per-request)
 *
 * Tenancy: login() looks up the user GLOBALLY (no tenant scope), because the
 * tenant is *derived* from the user. After login the EnsureTenantContext
 * middleware reads $user->tenant_id and sets the request-scoped TenantContext.
 */
class AuthService
{
    public const SESSION_KEY = 'auth.user_id';

    protected ?User $cachedUser = null;

    public function __construct(
        protected UserRepositoryInterface $users,
        protected Session $session,
    ) {
    }

    /**
     * Attempt to log a user in by username + password.
     * Returns true on success, false on bad credentials or inactive account.
     */
    public function attempt(string $username, string $password): bool
    {
        // We must bypass the tenant scope here because no tenant is set yet.
        $user = User::withoutGlobalScopes()
            ->where('username', $username)
            ->first();

        if (! $user || ! $user->is_active) {
            return false;
        }

        if (! Hash::check($password, $user->password)) {
            return false;
        }

        $this->login($user);
        return true;
    }

    public function login(User $user): void
    {
        $this->session->put(self::SESSION_KEY, $user->id);
        $this->session->regenerate();
        $this->cachedUser = $user;
    }

    public function logout(): void
    {
        $this->session->forget(self::SESSION_KEY);
        $this->session->invalidate();
        $this->session->regenerateToken();
        $this->cachedUser = null;
    }

    public function check(): bool
    {
        return $this->session->has(self::SESSION_KEY);
    }

    public function id(): ?int
    {
        return $this->session->get(self::SESSION_KEY);
    }

    /**
     * Get the authenticated user (or null). Cached per-request after first call.
     * Uses withoutGlobalScopes() because the tenant context may not be set yet
     * (e.g. inside EnsureTenantContext middleware itself).
     */
    public function user(): ?User
    {
        if ($this->cachedUser) {
            return $this->cachedUser;
        }

        $id = $this->id();
        if ($id === null) {
            return null;
        }

        $user = User::withoutGlobalScopes()->find($id);

        return $this->cachedUser = $user;
    }
}
