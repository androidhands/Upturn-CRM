<?php

namespace App\Http\Middleware;

use App\Http\ApiResponseTrait;
use Closure;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Sanctum\Events\TokenAuthenticated;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AssignGuard extends BaseMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard != null) {
            auth()->shouldUse($guard); //shoud you user guard / table
            $userAgent = $request->header('User-Agent');
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer ' . $token, true);
            try {
                // $user = $this->auth->authenticate();  //check authenticted user
                JWTAuth::parseToken()->authenticate();
                $user = Auth::guard($guard)->user();
                if (!$user) {
                    $array = [
                        'success' => false,
                        'result' => null,
                        'error' => [
                            'message' => 'Unauthorized user',
                            'code' => '401',
                            'details' => 'Unauthorized user'
                        ],
                    ];
                    return   response($array)->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);
                }
            } catch (TokenExpiredException $e) {
                return  $this->returnError($this->getErrorCode('401'), 'Unauthenticated user');
            } catch (UnauthorizedException $e) {
                return  $this->returnError('401', 'Unauthenticated user');
            } catch (JWTException $e) {

                return  $this->returnError('', 'token_invalid' . $e->getMessage());
            }
        }
        return $next($request);
    }
}
