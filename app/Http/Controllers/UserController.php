<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbstractResource;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->services = new UserService($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function store(Request $request)
    {
        try {
            return $this->successResponse(new AbstractResource($this->services->store($request->validated())));
        } catch (Exception  $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->successResponse(new AbstractResource($this->services->update($request->validated(), $id)));
        } catch (Exception  $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
