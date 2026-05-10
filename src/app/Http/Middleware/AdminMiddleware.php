<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra: Nếu chưa đăng nhập HOẶC không phải là admin (role 2)
        if (!Auth::check() || Auth::user()->role_id != 2) {
            // Chuyển hướng về trang chủ người dùng với thông báo lỗi
            return redirect()->route('user.home')->with('error', 'Bạn không có quyền truy cập vào khu vực Quản trị.');
        }

        return $next($request);
    }
}

