<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventLockAccountAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->locked && !auth()->user()->hasRole('super-admin')) {
            //log user out
            auth()->guard('web')->logout();
            session()->flush();

            return back()->with('danger', __('This Account was suspended. If this is an error, contact the administrator.'));
        }
        

        return $next($request);
    }
}
