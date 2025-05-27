<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AIController extends BaseController
{
    public function index()
    {
        return view('back-end/ask-ai/index');
    }
}
