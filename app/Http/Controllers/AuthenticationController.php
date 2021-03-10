<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthenticationService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationController extends Controller
{
    public function __construct(User $user){
        parent::__construct($user);
        $this->services = new AuthenticationService($user);
    }

    /**
     * Login with JWT
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            return $this->services->login($request->validated());
        } catch (Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }

    /**
     * @param RegisterRequest $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            return $this->services->register($request->validated());
        } catch (Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function profile(Request $request)
    {
        try {
            return response()->json(['data' => $request->data]);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }
}
