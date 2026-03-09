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
        helper('cookie');
        $loggedInUserId = $this->session->get('user_id');
        $actionUrl = $this->request->getUri()->getPath();
        $previousData = null;

        // log activity
        logActivity($loggedInUserId, ActivityTypes::USER_LOGOUT, 'User with id: ' . $loggedInUserId . ' logged out.', $actionUrl, null, null, json_encode($previousData), null);

        // remove all session data
        session()->destroy();

        updateUserRememberMeTokens($loggedInUserId);

        $rememberMeCookie = env('REMEMBER_ME_COOKIE');
        updateCookieRememberMeTokens($rememberMeCookie);

        // redirect
        return redirect()->to('sign-in');
    }

}
