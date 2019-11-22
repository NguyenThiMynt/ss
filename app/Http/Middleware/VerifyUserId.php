<?php

namespace App\Http\Middleware;

use App\UserProfile;
use Closure;

class VerifyUserId
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
        if (empty($request->all())) {
            return response()->apiRetError('paramater::request paramater not found', 400);
        }

        $user_id = $request->user_id;
        if (!isUUIDv4($user_id)) {
            return response()->apiRetError('user id::Invalid', 400);
        }

        $user = UserProfile::find($user_id);
        if ($user == null) {
            return response()->apiRetError('user id::Invalid', 400);
        }
        return $next($request);
    }
}
