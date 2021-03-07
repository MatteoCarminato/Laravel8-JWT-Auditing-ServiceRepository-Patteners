<?php


namespace App\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends AbstractService
{
    public $repository;

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->repository = new CompanyRepository($model);
    }
}
