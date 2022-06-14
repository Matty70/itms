<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->is('api/*')) {
            try {

                JWTAuth::parseToken()->authenticate();
                // return $next($request);
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                // $token = JWTAuth::parseToken()->refresh();
                abort( response()->json(['message' => 'Token Expired','exception' => $e->getMessage() ,'status' => false ],403));
                // do whatever you want to do if a token is expired

            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                abort( response()->json(['message' => 'Token Invalid','status' => false ], 403));
                // do whatever you want to do if a token is invalid

            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

                abort( response()->json(['message' => 'Token Exception','status' => false ,'error' => 'Token Exception: '.$e->getMessage() ], 403));
                // do whatever you want to do if a token is not present
            }

            abort(response()->json(['message' => 'Not Authenticated', 'status' => false,'token' => $request->bearerToken()], 403));
//            return response()->json(['error' => 'Not Authenticated'], 200);
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
