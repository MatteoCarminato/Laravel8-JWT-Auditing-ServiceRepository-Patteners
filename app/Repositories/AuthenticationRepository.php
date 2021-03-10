<?php


namespace App\Repositories;


class AuthenticationRepository extends AbstractRepository
{
    public function getUser($email)
    {
        return $this->model->where('email',$email)->first();
    }
}
