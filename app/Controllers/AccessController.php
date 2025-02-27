<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AccessController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    
    public function index()
    {
        return view('back-end/access/index');
    }
}
