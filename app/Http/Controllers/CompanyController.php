<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct(Company $company)
    {
        parent::__construct($company);
        $this->services = new CompanyService($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function store(CompanyStoreRequest $request)
    {
        try {
            return $this->successResponse(new CompanyResource($this->services->store($request->validated())));
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
    public function update(CompanyUpdateRequest $request, Company $id)
    {
        try {
            return $this->successResponse(new CompanyResource($this->services->update($request->validated(), $id)));
        } catch (Exception  $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
