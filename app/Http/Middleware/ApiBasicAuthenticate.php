<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;

class ApiBasicAuthenticate
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
        // back door for PostMan Dev
        if ($request->header('Postman-Token') == env('POSTMAN_TOKEN')) {
            return $next($request);
        }

        // API authenticate info
        $apiKey = env('API_KEY');

        $requestApiKey = $request->header('Authenticate-Key');
        $requestSignature = $request->header('Authenticate-Signature');

        //check api_key
        if(!empty($requestSignature)){
          $check = Helper::getUsernameAccount($requestSignature);
          if(!empty($check)){
            $tokenNotOK= 0;
          }else{
			  $tokenNotOK = 1;
          }
        }else{
			$tokenNotOK = 1;
        }
        // API authenticate
        if ((empty($requestApiKey) || ($requestApiKey != $apiKey)) || $tokenNotOK ==1 ) {
            return response()->json([
                    'status' => 401,
                    'messages'    => 'Unauthorized',
                    'data'        => array()
                    ],401);
        }

        return $next($request);
    }
}
