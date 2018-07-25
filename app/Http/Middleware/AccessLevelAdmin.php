<?php

namespace App\Http\Middleware;

use Closure;

class AccessLevelAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $namarole)
    {
        if(auth()->check() && !auth()->user()->viewRole($namarole)){
          return redirect('accesserror');
        }
        return $next($request);
    }
}
