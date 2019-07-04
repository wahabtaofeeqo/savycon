<?php

namespace SavyCon\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()) {
            if ($role === auth()->user()->getRole()) {
                return $next($request);
            }
        }

        return redirect('/login')->with(['message' => 'You are not authorized!']);
    }
}
