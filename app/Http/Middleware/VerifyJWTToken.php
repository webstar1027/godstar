<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Illuminate\Http\Response as HttpResponse;
//use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
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
        $credentials = Input::only('email', 'password');
        if ( ! $token = \JWTAuth::attempt($credentials)) {
            return response()->json(['success' => false], HttpResponse::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
