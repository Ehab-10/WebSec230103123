<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::check()) {
            abort(403, 'غير مسموح بالدخول');
        }

        if (!Auth::user()->can($permission)) {
            abort(403, 'ليس لديك الصلاحية للوصول لهذه الصفحة');
        }

        return $next($request);
    }
}
