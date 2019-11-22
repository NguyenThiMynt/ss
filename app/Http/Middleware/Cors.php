<?php

namespace App\Http\Middleware;

use Closure;
class Cors
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
        if(array_has($_SERVER, 'HTTP_ORIGIN')){
            $origin = $_SERVER['HTTP_ORIGIN'];
            return $next($request)
                ->header("Access-Control-Allow-Origin", $origin)
                ->header("Access-Control-Allow-Methods", "OPTIONS, GET, POST, PUT, HEAD, PATCH, DELETE")
                ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
        }
        return $next($request);

    }
}
