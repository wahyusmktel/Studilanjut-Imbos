<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('parent')->check()) {
            return $next($request);
        }

        return redirect()->route('parent.login');
    }
}
