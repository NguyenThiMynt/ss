<?php

namespace App\Http\Middleware;

use App\UserProfile;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
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
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user){
                return response()->apiRetError('あなたのアカウントは管理者から削除されました。', USER_IS_DELETED);
            }

            return $next($request);
        } catch (\Exception $e) {

            Log::warning($e);
            return response()->apiRetError('auth_error', 401);
        }
    }
}
