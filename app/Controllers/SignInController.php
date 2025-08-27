<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use Gregwar\Captcha\CaptchaBuilder;

class SignInController extends BaseController
{
    public function index()
    {
        //get use captcha config
        $useCaptcha = env('APP_USE_CAPTCHA', "No");
        if(strtolower($useCaptcha) === "yes"){
            // Generate captcha
            $builder = new CaptchaBuilder;
            $builder->build();
            session()->set('captcha', $builder->getPhrase());
            $data['captcha_image'] = $builder->inline();
        }

        // Get the returnUrl parameter from the query string
        $returnUrl = $this->request->getGet('returnUrl');
        $data['returnUrl'] = $returnUrl;

        return view('front-end/sign-in/index', $data); 
    }

    public function login()
    {
        helper('cookie');

        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        // Get use captcha config
        $useCaptcha = env('APP_USE_CAPTCHA', "No");

        // Set validation rules
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|max_length[255]',
        ];

        // If valid
        if ($this->validate($rules)) {
            $emailOrUsername = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $returnUrl = $this->request->getPost('return_url');

            if (strtolower($useCaptcha) === "yes") {
                $captcha = $this->request->getPost('captcha');
                $captchaSession = session('captcha');
                // Verify captcha.
                if ($captcha !== $captchaSession) {
                    session()->setFlashdata('errorAlert', 'Invalid captcha');
                    return redirect()->to('/sign-in');
                }
            }

            // Load the UsersModel
            $usersModel = new UsersModel();

            // Attempt to log in the user
            $user = $usersModel->validateLogin($emailOrUsername, $password);

            if ($user) {
                // Check if user status is active
                if ($user['status'] != 1) {
                    // Login failed: Redirect back to login page with user not active error message
                    $pendingActivationMsg = config('CustomConfig')->pendingActivationMsg;
                    session()->setFlashdata('errorAlert', $pendingActivationMsg);
                    return redirect()->to('/sign-in');
                }

                //check if remember me selected
                $rememberMe = !empty($this->request->getPost('remember_me')) ? boolval($this->request->getPost('remember_me')) : false;
                // If 'remember me' is true, extend the session expiration to 3 days
                if ($rememberMe) {
                    $userId = $user['user_id'];
                    $cookieToken = getGUID()."-".getGUID();

                    $expiresAt = date('Y-m-d H:i:s', strtotime(' + 3 days'));
                    updateUserRememberMeTokens($userId, $cookieToken, $expiresAt);

                    $rememberMeCookie = env('REMEMBER_ME_COOKIE');
                    $cookieExpiresAt = time() + (3 * 24 * 60 * 60);
                    updateCookieRememberMeTokens($rememberMeCookie, $cookieToken, $cookieExpiresAt);
                }
    
                // User logged in successfully. Store user data in session
                session()->set([
                    'user_id' => $user['user_id'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'upload_directory' => $user['upload_directory'],
                    'is_logged_in' => TRUE
                ]);

                // Reset failed login attempts on successful login
                session()->remove('failed_login_attempts');

                // Redirect to dashboard
                $loginSuccessMsg = config('CustomConfig')->loginSuccessMsg;
                session()->setFlashdata('successAlert', $loginSuccessMsg);

                // Log activity
                logActivity($user['user_id'], ActivityTypes::USER_LOGIN, 'User logged in with id: ' . $user['user_id']);

                if (!empty($returnUrl)) {
                    return redirect()->to($returnUrl);
                }

                return redirect()->to('/account/dashboard');

            } else {
                // Increment failed login attempts
                $failedAttempts = session('failed_login_attempts') ?? 0;
                $failedAttempts++;
                session()->set('failed_login_attempts', $failedAttempts);

                // Check if the number of failed attempts exceeds the limit
                $maxFailedAttempts = intval(getConfigData("MaxFailedAttempts")); // max login limit
                if ($failedAttempts >= $maxFailedAttempts) {
                    // Block the IP address
                    $ipAddress = getDeviceIP();
                    $country = getCountry();
                    $pageVisitedUrl = current_url();
                    $reason = ActivityTypes::BLOCKED_IP_TOO_MANY_FAILED_LOGINS;
                    $blockEndTime = date('Y-m-d H:i:s', strtotime(getConfigData("FailedLoginsSuspensionPeriod")));
                    addBlockedIPAdress($ipAddress, $country, $pageVisitedUrl, $blockEndTime, $reason);

                    // Reset failed login attempts
                    session()->remove('failed_login_attempts');

                    // Set a flash message
                    $tooManyFailedLogins = config('CustomConfig')->tooManyFailedLogins;
                    session()->setFlashdata('errorAlert', $tooManyFailedLogins);

                    // Log activity
                    logActivity($this->request->getPost('email'), ActivityTypes::TOO_MANY_FAILED_USER_LOGIN, 'Too many failed login attempts for user with email: ' . $this->request->getPost('email'));

                    return redirect()->to('/sign-in');
                }

                // Login failed: Redirect back to login page with an error message
                $wrongCredentialsMsg = config('CustomConfig')->wrongCredentialsMsg;
                session()->setFlashdata('errorAlert', $wrongCredentialsMsg);

                // Log activity
                logActivity($this->request->getPost('email'), ActivityTypes::FAILED_USER_LOGIN, 'User failed to log in with email: ' . $this->request->getPost('email'));

                return view('front-end/sign-in/index');
            }
        } else {
            $data['validation'] = $this->validator;

            if (strtolower($useCaptcha) === "yes") {
                // Regenerate captcha for the next attempt
                $builder = new CaptchaBuilder;
                $builder->build();
                session()->set('captcha', $builder->getPhrase());
                $data['captcha_image'] = $builder->inline();
            }

            // Log activity
            logActivity($this->request->getPost('email'), ActivityTypes::FAILED_USER_LOGIN, 'User failed to log in with email: ' . $this->request->getPost('email'));

            return view('front-end/sign-in/index', $data); // with-captcha
        }
    }
}
