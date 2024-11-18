<?php

namespace App\Http\Middleware;

use App\Http\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVerifyPassword
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->verify_password !== env('VERIFY_PASSWORD', '2FPFIZefWzuMh9eyzqSvfnOCfitoa9e2rBjKsR2fpboU4ACW7V0odLrsLJZni2IMlMZ2biXRKFLjjKWyhZtmtqVqZXiLtwMN5rQEP9bXIr2DXdG')) {
            return $this->returnError('422', 'Unprocessable');
        }
        return $next($request);
    }
}
