<?php

namespace App\Http\Middleware;


use App\Http\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPassword
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->api_password !== env('API_PASSWORD', 'COLgGMo6KEiaY3cFhysY920Kd33SHmGG5cXD')) {
            return $this->returnError('401', 'UnAuthenticated');
        }
        return $next($request);
    }
}
