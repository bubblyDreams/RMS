<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Custom auth gate — does NOT use Laravel's Auth facade or guards.
 * Routes that require a logged-in user should use the alias `auth`.
 */
class Authenticate
{
    public function __construct(protected AuthService $auth)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->auth->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}
