<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SignOutController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        $loggedInUserId = $this->session->get('user_id');

        //log activity
        logActivity($loggedInUserId, ActivityTypes::USER_LOGOUT, 'User with id: ' . $loggedInUserId . ' logged out.');

        // Remove all session data
        session()->destroy();

        return redirect()->to('sign-in');
    }
}
