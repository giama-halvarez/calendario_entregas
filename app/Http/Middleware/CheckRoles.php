<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $operator, $rol)
    {
        switch ($operator) {
            case '>':
                if (auth()->user()->rol > $rol) {
                    return $next($request);
                }
                break;
            
            case '<':
                if (auth()->user()->rol < $rol) {
                    return $next($request);
                }
                break;
            
            case '>=':
                if (auth()->user()->rol >= $rol) {
                    return $next($request);
                }
                break;
            
            case '<=':
                if (auth()->user()->rol <= $rol) {
                    return $next($request);
                }
                break;
            
            case '=':
                if (auth()->user()->rol == $rol) {
                    return $next($request);
                }
                break;
        }

        return redirect('/agenda/ver/pendientes');
    }
}
