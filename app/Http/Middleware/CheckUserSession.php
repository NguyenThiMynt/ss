<?php

namespace App\Http\Middleware;

use App\UserSession;
use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserSession
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
        $token = JWTAuth::getToken();
        $userAuth = Auth::user();
        $userSession = UserSession::where(['user_id' => $userAuth->user_id])->first();

        if (!empty($userSession)) {
            if ($userSession->token != $token) {
                return response()->apiRetError('session is replaced by other login', 401);
            }
        } else {
            // for case old user app still login
            UserSession::createNew($userAuth->user_id, $token);
        }
        return $next($request);
    }
}
