<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( Auth::user()->admin == false ){
            return redirect('/')->with('message' , 'only admin can access the page');
        }
        return $next($request);
    }
}
