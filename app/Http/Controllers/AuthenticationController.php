<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationController extends Controller
{
    /**
     * Login with JWT
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!is_null($user)) {
                if ($user->password != md5($request['password'])) {
                    return response()->json([
                        'error' => 'Senha incorreta.'
                    ], 401);
                } else {
                    return response()->json([
                        'token' => $this->createToken($user)
                    ], 200);
                }
            }

            return response()->json([
                'error' => 'Usuario não encontrado'
            ], 401);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ], 401);
        }
    }

    /**
     * Convert date in JWT
     *
     * @return string
     */
    protected function createToken($data)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'data' => $data, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + (7 * 24 * 60 * 60)// Expiration time
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] = md5($data['password']);

            $user = User::create($data);
            return response(['user' => $user, 'message' => 'Usuário cadastrado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e
            ], 401);
        }
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function profile(Request $request)
    {
        return response()->json(['data' => $request->data], 200);
    }
}
