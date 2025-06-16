<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->status !== 'aktif') {
                return redirect()->route('login')->with('error', 'Akun tidak aktif.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silakan masuk untuk melanjutkan.');
        }
        return $next($request);
    }
}
