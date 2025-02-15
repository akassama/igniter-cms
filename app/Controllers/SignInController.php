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
        //get use captch config
        $useCaptcha = getDefaultConfigData("UseCaptcha", config('CustomConfig')->useCaptcha);
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
        //get use captch config
        $useCaptcha = getDefaultConfigData("UseCaptcha", config('CustomConfig')->useCaptcha);

        //set validation rules
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|max_length[255]',
            //'captcha'  => 'required|matches[captcha_session]',
        ];

        //if valid
        if($this->validate($rules)){
            $emailOrUsername = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $returnUrl = $this->request->getPost('return_url');

            if(strtolower($useCaptcha) === "yes"){
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

                // Redirect to dashboard
                $loginSuccessMsg = config('CustomConfig')->loginSuccessMsg;
                session()->setFlashdata('successAlert', $loginSuccessMsg);

                //log activity
                logActivity($user['user_id'], ActivityTypes::USER_LOGIN, 'User logged in with id: ' . $user['user_id']);

                if(!empty($returnUrl)){
                    return redirect()->to($returnUrl);
                }

                return redirect()->to('/account/dashboard');

            } else {
                // Login failed: Redirect back to login page with an error message
                $wrongCredentialsMsg = config('CustomConfig')->wrongCredentialsMsg;
                session()->setFlashdata('errorAlert', $wrongCredentialsMsg);

                //log activity
                logActivity($this->request->getPost('email'), ActivityTypes::FAILED_USER_LOGIN, 'User failed to log in with email: ' . $this->request->getPost('email'));

                return view('front-end/sign-in/index');
            }
        }else{
            $data['validation'] = $this->validator;

            if(strtolower($useCaptcha) === "yes"){
                // Regenerate captcha for the next attempt
                $builder = new CaptchaBuilder;
                $builder->build();
                session()->set('captcha', $builder->getPhrase());
                $data['captcha_image'] = $builder->inline();
            }

            //log activity
            logActivity($this->request->getPost('email'), ActivityTypes::FAILED_USER_LOGIN, 'User failed to log in with email: ' . $this->request->getPost('email'));

            //return view('front-end/sign-in/index', $data); //with-captcha
            return view('front-end/sign-in/index'); //non-captcha
        }
    }
}
