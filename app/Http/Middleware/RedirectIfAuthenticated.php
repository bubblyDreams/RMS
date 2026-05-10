<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bounce already-logged-in users away from guest-only pages (login, etc.).
 */
class RedirectIfAuthenticated
{
    public function __construct(protected AuthService $auth)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->auth->check()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
