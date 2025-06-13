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
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $role = Auth::user()?->role;
        if ($role === 'monitoring') {
            return redirect()->route('monitoring.dashboard');
        } elseif ($role === 'user') {
            return redirect()->route('user.dashboard');
        } elseif ($role === 'guest') {
            return redirect()->route('guest.home');
        }

        if (Auth::guard($guards)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
