<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbstractCollection;
use App\Http\Resources\AbstractResource;
use App\Services\AbstractService;
use App\Traits\ApiResponser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $services;
    use ApiResponser;

    public function __construct(Model $model)
    {
        $this->services = new AbstractService($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function index()
    {
        try{
            return $this->successResponse(new AbstractCollection($this->services->getAll()));
        }catch(\Exception  $e){
            return $this->errorResponse($e->getMessage(),  $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function show($id)
    {
        try{
            return $this->successResponse( new AbstractResource($this->services->show($id)));
        }catch(\Exception  $e){
            return $this->errorResponse($e->getMessage(),  $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function destroy($id)
    {
        try{
            return $this->successResponse($this->services->delete($id));
        }catch(\Exception  $e){
            return $this->errorResponse($e->getMessage(),  $e->getCode());
        }
    }
}
