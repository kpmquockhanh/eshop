<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveAdmin
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
        $auth = Auth::guard('admin');
        if ($auth->check() && !$auth->user()->status) {
            $auth->logout();
            return redirect(route('admin.login'))->withErrors(['error' => "Tài khoản chưa được kích hoạt"]);
        }
        return $next($request);
    }
}
