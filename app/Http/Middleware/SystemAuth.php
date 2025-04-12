<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SystemAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $systemSecret = Config::get('system-auth.system_secret');

        $token = $request->headers->get("Authorization");

        if ($token === 'System ' .  $systemSecret) {
            return $next($request);
        }

        $token = $request->system_secret;

        if ($token === $systemSecret) {
            return $next($request);
        }

        abort(401);
    }
}
