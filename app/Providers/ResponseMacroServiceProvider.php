<?php
/**
 * Created by PhpStorm.
 * User: sato1
 * Date: 1/2/18
 * Time: 9:34 PM
 */

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{

    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiRet', function ($data = null, $success = true, $message = null, $errorCode = 200) {
            $json = ['data' => $data, 'success' => $success, 'message' => $message, 'error_code' => $errorCode];
            return response()->json($json, $errorCode);
        });

        Response::macro('apiRetError', function ($message = null, $errorCode = UNKNOWN_EXCEPTION, $status = 400) {
            $json = ['data' => null, 'success' => false, 'message' => $message, 'error_code' => $errorCode];
            return response()->json($json, $status);
        });

        Response::macro('apiValidateError', function ($message) {
            $json = ['data' => null, 'success' => false, 'message' => $message, 'error_code' => ERROR_CODE_VALIDATION];
            return response()->json($json, 400);
        });

        Response::macro('internalError', function ($message = "Server internal error", $errorCode = 500) {
            $json = ['data' => null, 'success' => false, 'message' => $message, 'error_code' => $errorCode];
            return response()->json($json, 500);
        });
    }
}