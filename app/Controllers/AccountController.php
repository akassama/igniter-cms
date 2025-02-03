<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AccountController extends BaseController
{
    public function index()
    {
        //redirect to dashboard
        return redirect()->to('/account/dashboard');
    }
}
