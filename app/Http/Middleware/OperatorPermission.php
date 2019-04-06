<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OperatorPermission
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
//        dd(123123);
        if (!Auth::guard('admin')->user()->isOperator()) {
            return redirect(route('admin.dashboard'));
        }
        return $next($request);
    }
}
