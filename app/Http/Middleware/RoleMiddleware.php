<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role, ?string $permission = null): Response
    {
        $roles = explode('|', $role);

        if (!$request->user()->hasRole(...$roles)) {
            abort(403, 'Unauthorized');
        }

        if ($permission != null && !$request->user()->can($permission)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
