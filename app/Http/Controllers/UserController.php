<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(User $company){
        parent::__construct($company);
        $this->services = new UserService($company);
    }
}
