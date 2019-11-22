<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTTokenOptional
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
        try {
            if(array_key_exists('user_id', $request->toArray())){
                if (!isUUIDv4($request->user_id)) {
                    return response()->apiRetError('user id::Invalid', 400);
                }

                JWTAuth::parseToken()->authenticate();
                if($request->user_id != Auth::id()){
                    return response()->apiRetError('user id::Invalid', 400);
                }
            }
            return $next($request);
        } catch (\Exception $e) {
            Log::warning($e);
            return response()->apiRetError('auth_error', 401);
        }

    }
}
