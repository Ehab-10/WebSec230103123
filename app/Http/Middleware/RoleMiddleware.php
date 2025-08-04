<?php

// App\Http\Middleware\RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || !$user->roles()->where('name', $role)->exists()) {
            abort(403, 'User does not have the right roles.');
        }

        return $next($request);
    }
}
