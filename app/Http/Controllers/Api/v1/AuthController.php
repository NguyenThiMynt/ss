<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\UserProfile;
use App\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        try{
            $username = $request->username;
            $password = $request->password;

            // start validate params
            if(empty($username)){
                return response()->apiValidateError('username empty');
            }
            if(empty($password)){
                return response()->apiValidateError('$password empty');
            }
            //end validate params

            $credentials = ['user_name' => $username, 'password' => $password];
            $jwtToken = JWTAuth::attempt($credentials);

            if(!$jwtToken){
                return response()->apiRetError('invalid username or password', WRONG_EMAIL_PASSWORD);
            }
            $user = UserProfile::where('user_name',$username)->first();

            $userSession = UserSession::createNew($user->user_id, $jwtToken);

            $data = [
                "user" => [
                    "user_id" => $user->user_id,
                    "username" => $user->user_name,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name
                ],
                "token" => $jwtToken
            ];
            return response()->apiRet($data);
        }catch (\Exception $ex){
            Log::error($ex);
            return response()->apiRetError($ex->getMessage());
        }
    }

    public function signup(Request $request){
        try{
            $username = $request->user_name;
            $password = $request->password;
            $first_name = isset($request->first_name) ? $request->first_name : '';
            $last_name = isset($request->last_name) ? $request->last_name : '';
            // start validate params
            if(empty($username)){
                return response()->apiValidateError('username empty');
            }
            if(empty($password)){
                return response()->apiValidateError('password empty');
            }
            if(mb_strlen($username) >32 ) {
                return response()->apiValidateError('username > 32 characters');
            }
            if(mb_strlen($first_name) >32 ) {
                return response()->apiValidateError('first_name > 32 characters');
            }
            if(mb_strlen($last_name) >32 ) {
                return response()->apiValidateError('last_name > 32 characters');
            }
            if(mb_strlen($password) >32 ) {
                return response()->apiValidateError('password> 32 characters');
            }
            $check_user =  UserProfile::where('user_name',$username)->first();
            if($check_user){
                return response()->apiRetError('user registered', USER_NAME_EXISTED);
            }
            //end validate params
            $user = UserProfile::create([
                "user_id" => genUUIDv4(),
                "user_name" => $username,
                "password" => bcrypt($password),
                "first_name" => $first_name,
                "last_name" => $last_name
            ]);

            return response()->apiRet();
        }catch (\Exception $ex){
            Log::error($ex);
            return response()->apiRetError($ex->getMessage());
        }
    }

    public function refreshToken(Request $request)
    {
        Log::info("refreshToken start: ");
        $oldToken = $request->token;
        try {
            $newToken = JWTAuth::refresh($oldToken);
            JWTAuth::setToken($newToken)->toUser();
            Log::info("refreshed token $oldToken");
            return response()->apiRet(['token' => $newToken]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $ex) {
            Log::warning("token " . $oldToken . " is in black list");
            return response()->apiRetError('TokenBlacklistedException', TOKEN_BLACK_LIST);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $ex) {
            Log::warning("token " . $oldToken . " , error: " . $ex->getMessage());
            return response()->apiRetError('TOKEN_NO_LONGER_BE_REFRESH', TOKEN_NO_LONGER_BE_REFRESH);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $ex) {
            Log::warning("token " . $oldToken . " , error: " . $ex->getMessage());
            return response()->apiRetError('token invalid', INVALID_TOKEN);
        } catch (\Exception $ex) {
            Log::warning("token " . $oldToken . " , error: " . $ex->getMessage());
            Log::error($ex);
            return response()->apiRetError('token refresh fail');
        }
    }
}
