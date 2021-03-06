<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(User $user){
        parent::__construct($user);
        $this->services = new UserService($user);
    }
}
