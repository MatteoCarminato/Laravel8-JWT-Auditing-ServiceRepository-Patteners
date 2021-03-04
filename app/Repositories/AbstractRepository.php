<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class AbstractRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        try {
            return $this->model = $model;
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    // Get all instances of model
    public function all()
    {
        try {
            return $this->model->all();
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    // create a new record in the database
    public function store($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    // update record in the database
    public function update($data, $id)
    {
        try {
            $record = $this->model->find($id);
            return $record->update($data);
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    // show the record with the given id
    public function show($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    // delete the record with the given id
    public function delete($id)
    {
        try {
            $data = $this->model->find($id);
            return $data->delete($id);
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

}
