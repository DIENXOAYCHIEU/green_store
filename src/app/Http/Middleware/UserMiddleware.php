<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Nếu là Admin mà cố tình vào trang của User
        if (Auth::check() && Auth::user()->role_id == 2) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}