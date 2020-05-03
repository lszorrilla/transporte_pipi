<?php

namespace App\Http\Middleware;

use Closure;

class MustBeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$rol)
    {
        $user = $request->user();

        if ($user && $user->rol($rol)) {
            return $next($request);
        }
        
        return redirect('/');
    }
}
