<?php


namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\AbstractService;
use Illuminate\Database\Eloquent\Model;

class UserService extends AbstractService
{
    public $repository;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->repository = new UserRepository($model);
    }
}
