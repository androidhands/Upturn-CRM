<?php

namespace App\Http\Middleware;

use App\Http\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Lcobucci\JWT\Exception;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserToken
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
            //throw an exception

        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {

                http_response_code(498);
                return $this->returnError(http_response_code(498), 'INVALID _TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                http_response_code(419);
                return $this->returnError(http_response_code(419), 'EXPIRED_TOKEN');
            } else {
                http_response_code(500);
                return $this->returnError(http_response_code(500), 'UnAuthenticated');
            }
        } catch (\Throwable $e) {
            if ($e instanceof TokenInvalidException) {
                http_response_code(498);
                return $this->returnError(http_response_code(498), 'INVALID _TOKEN');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                http_response_code(419);
                return $this->returnError(http_response_code(419), 'EXPIRED_TOKEN');
            } else {
                http_response_code(500);
                return $this->returnError(http_response_code(500), 'UnAuthenticated');
            }
        }

        if (!$user) {
            http_response_code(401);
            return $this->returnError(http_response_code(401), 'UnAuthenticated');
        }
        return $next($request);
    }
}
