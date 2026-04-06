<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasPassword
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Nếu đã login nhưng chưa có password
        if ($user && $user->password === null) {

            // Tránh loop
            if (
                !$request->routeIs('auth.password') &&
                !$request->routeIs('createPassword.handle')
            ) {

                return redirect()->route('auth.password');
            }
        }

        return $next($request);
    }
}