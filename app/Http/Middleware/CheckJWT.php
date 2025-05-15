<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class CheckJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return redirect()->route('login'); 
            }
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['message' => 'Token không hợp lệ hoặc đã hết hạn. Vui lòng đăng nhập lại.']);
        }
        return $next($request);
    }
}
