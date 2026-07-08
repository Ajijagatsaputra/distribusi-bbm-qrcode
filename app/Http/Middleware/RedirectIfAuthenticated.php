<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check() && $request->routeIs('login')) {
            return match (Auth::user()->role) {
                'admin_pusat' => redirect()->route('superadmin.dashboard'),
                'admin_depo'  => redirect()->route('admin.dashboard'),
                'driver'      => redirect()->route('operator.dashboard'),
                'admin_spbu'  => redirect()->route('spbu.dashboard'),
                default      => redirect('/'),
            };
        }

        return $next($request);
    }
}
