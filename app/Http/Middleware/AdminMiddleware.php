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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Kiểm tra xem người dùng đã đăng nhập và có phải là admin
        if (!Auth::check() || Auth::user()->is_admin !== 1) {
            // Nếu không, chuyển hướng về trang home với thông báo lỗi
            return redirect()->route('user')->with('error', 'Bạn không có quyền vào trang này');
        }

        return $next($request);
    }
}
