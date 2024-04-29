<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check() || !(auth()->user()->isDoktor() || auth()->user()->isAdmin())) {
            return redirect('home')->with('error', 'Nemáte dostatočné oprávnenia na prístup k tejto stránke.');
        }

        return $next($request);
    }
}
