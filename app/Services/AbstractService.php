<?php

namespace App\Services;

use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class AbstractService
{
    public $repository;
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->repository = new AbstractRepository($model);
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update($request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }



}
