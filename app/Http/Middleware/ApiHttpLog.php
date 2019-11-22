<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiHttpLog
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
            Log::info("");
            Log::info("");
            Log::info("[ACCESS]*********************************** HTTP START");
            Log::info("[ACCESS][" . $request->ip() . "][" . $request->method() . "][" . $request->url() . "]");
            $datas = $request->all();
            if(key_exists('password', $datas)){
                $datas['password'] = '******';
            }
            if(key_exists('passwd', $datas)){
                $datas['passwd'] = '******';
            }
            $header = $this->getHeaderCompat();
            Log::info("[ACCESS] HEADER: [" . json_encode($header) . "]");
            Log::info("[ACCESS] CONTENT: [" . json_encode($datas) . "]");
        }catch (\Exception $ex){

        }

        $response = $next($request);

        try {
            Log::info("[ACCESS]*********************************** HTTP END");
        }catch (\Exception $ex) {

        }

        return $response;
    }

    function getHeaderCompat(){
        if (!function_exists('getallheaders'))  {
            function getallheaders()
            {
                if (!is_array($_SERVER)) {
                    return array();
                }

                $headers = array();
                foreach ($_SERVER as $name => $value) {
                    if (substr($name, 0, 5) == 'HTTP_') {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }
                return $headers;
            }
        } else {
            return getallheaders();
        }
    }
}
