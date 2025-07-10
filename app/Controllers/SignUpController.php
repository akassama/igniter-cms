<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use Gregwar\Captcha\CaptchaBuilder;

class SignUpController extends BaseController
{
    public function index()
    {
        //show demo message
        if(boolval(env('DEMO_MODE', "false"))){
            $errorMsg = "Registration not available in the demo mode.";
            session()->setFlashdata('errorAlert', $errorMsg);
            return view('front-end/sign-up/index');
        }

        //get allow registration
        $allowRegistration = getConfigData("EnableRegistration");
        if(strtolower($allowRegistration) === "no"){
            // Not allowed to access signup page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }
        
        //get use captcha config
        $useCaptcha = env('APP_USE_CAPTCHA', "No");
        if(strtolower($useCaptcha) === "yes"){
            // Generate captcha
            $builder = new CaptchaBuilder;
            $builder->build();
            session()->set('captcha', $builder->getPhrase());
            $data['captcha_image'] = $builder->inline();

            return view('front-end/sign-up/index', $data);
        }

        return view('front-end/sign-up/index');
    }

    public function addRegistration()
    {
        //get allow registration
        $allowRegistration = getConfigData("EnableRegistration");
        if(strtolower($allowRegistration) === "no"){
            // Not allowed to access signup page
            $invalidAccessMsg = config('CustomConfig')->invalidAccessMsg;
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);
        
        // Load the UsersModel
        $usersModel = new UsersModel();

        // Validation rules from the model
        $validationRules = $usersModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('front-end/sign-up/index');
        }

        //get use captcha config
        $useCaptcha = env('APP_USE_CAPTCHA', "No");

        if(strtolower($useCaptcha) === "yes"){
            $captcha = $this->request->getPost('captcha');
            $captchaSession = session('captcha');
            // Verify captcha.
            if ($captcha !== $captchaSession) {
                session()->setFlashdata('errorAlert', 'Invalid captcha');
                return redirect()->to('/sign-up');
            }
        }

        // If validation passes, create the user
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'profile_picture'=> null,
            'twitter_link'=> null,
            'facebook_link'=> null,
            'instagram_link'=> null,
            'linkedin_link'=> null,
            'about_summary' => null
        ];

        // Call createUser method from the UsersModel
        if ($usersModel->createUser($userData)) {

            //inserted user_id
            $insertedId = $usersModel->getInsertID();

            // User created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Registration', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($insertedId, ActivityTypes::USER_REGISTRATION, 'User registered with id: ' . $insertedId);

            return redirect()->to('/sign-in');

        } else {
            // Failed to create user. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($this->request->getPost('email'), ActivityTypes::FAILED_USER_REGISTRATION, 'Failed to register user with id: ' . $this->request->getPost('email'));

            return view('front-end/sign-up/index');
        }
    }

}
