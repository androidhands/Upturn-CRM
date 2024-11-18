<?php

namespace App\Http\Middleware;

use App\Http\ApiResponseTrait;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Exception;

class CheckVerifiedEmail
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = Auth::guard('user_api')->user();
            $userDb = User::find($user->id);
            if (!$userDb->hasVerifiedEmail()) {
                $array = [
                    'success' => false,
                    'result' => null,
                    'error' => [
                        'message' => 'Email is not verified',
                        'code' => '403',
                        'details' => 'Email is not verified'
                    ],
                ];
                return   response($array)->setStatusCode(Response::HTTP_FORBIDDEN, Response::$statusTexts[Response::HTTP_FORBIDDEN]);
            }
            return $next($request);
        } catch (Exception $ex) {
            return $this->returnError((string)$ex->getCode(), $ex->getMessage());
        }
    }
}
