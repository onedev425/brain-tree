<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnsureDefaultPasswordIsChanged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->isLocal() && app()->hasDebugModeEnabled()) {
            return $next($request);
        }
        if (Hash::check('password', auth()->user()->password)) {
            session()->flash('notify', 'Please change your password to proceed.');

            //return redirect()->route('settings.index');
        }

        return $next($request);
    }
}
