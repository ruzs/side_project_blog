<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // 使用者已登入，重新導向到登入頁面
            return redirect()->route('home.index');
            // return redirect()->url('/');
        }

        // 允許使用者存取功能
        return $next($request);
    }
}
