<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }
}
