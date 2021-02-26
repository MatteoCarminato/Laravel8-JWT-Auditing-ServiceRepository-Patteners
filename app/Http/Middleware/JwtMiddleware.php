<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $header = $request->header('Authorization', $request->bearerToken());

        if (!$header) {
            return response()->json([
                'error' => 'Atenção. O Token inexistente na requisição.'
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            try {
                $credentials = JWT::decode($request->bearerToken(), env('JWT_SECRET'), ['HS256']);
            } catch (ExpiredException $e) {
                return response()->json([
                    'error' => 'Token expirado.'
                ], Response::HTTP_BAD_REQUEST);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Token com erro.'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
        $request->data = $credentials->data;

        return $next($request);
    }
}
