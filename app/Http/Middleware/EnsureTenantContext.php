<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Services\AuthService;
use App\Services\TenantContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resolves the current tenant for the request and stores it in TenantContext.
 *
 * Strategy: pull tenant_id from the authenticated user (session). If you later
 * add subdomain- or header-based resolution, do it here in front of the
 * user-based fallback so the URL acts as an authoritative tenant signal.
 */
class EnsureTenantContext
{
    public function __construct(
        protected AuthService $auth,
        protected TenantContext $context,
        protected TenantRepositoryInterface $tenants,
    ) {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->auth->user();

        if ($user) {
            $tenant = $this->tenants->find($user->tenant_id);
            if ($tenant && $tenant->is_active) {
                $this->context->set($tenant);
            } else {
                $this->auth->logout();
                return redirect()->route('login')
                    ->withErrors(['username' => 'Your tenant is inactive.']);
            }
        }

        return $next($request);
    }
}
