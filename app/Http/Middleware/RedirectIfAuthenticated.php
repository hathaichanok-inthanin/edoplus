<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.home');
              }
              break;
            case 'admin-store':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('admin-store.home');
              }
              break;
            case 'staff':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('staff.home');
              }
              break;
            case 'member':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('member.home');
              }
              break;
        }

        return $next($request);
    }
}
