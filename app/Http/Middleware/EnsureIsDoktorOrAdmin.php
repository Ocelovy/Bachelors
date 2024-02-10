<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsDoktorOrAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !(auth()->user()->isDoktor() || auth()->user()->isAdmin())) {
            return redirect('/')->with('error', 'Nemáte oprávnenie k prístupu na túto stránku.');
        }
        return $next($request);
    }
}
