<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserTimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userCountry = $request->country;
        switch ($userCountry) {
            case 'Egypt':
                date_default_timezone_set('Africa/Cairo');
                break;
            case 'Saudi Arabia':
                date_default_timezone_set('Asia/Riyadh');
                break;
            default:
                // Default timezone
                date_default_timezone_set('Africa/Cairo');
                break;
        }
        return $next($request);
    }
}
