<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ChangeSaler
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

        if ($request->id == Auth::guard('admin')->id() || Auth::guard('admin')->user()->type == 3)
            return $next($request);

        return redirect()->intended(route('admin.salers.list'));


    }
}
