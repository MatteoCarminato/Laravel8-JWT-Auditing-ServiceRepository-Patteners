<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    public function __construct(Company $company){
        parent::__construct($company);
        $this->services = new CompanyService($company);
    }
}
