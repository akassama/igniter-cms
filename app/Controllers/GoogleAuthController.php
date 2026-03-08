<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Constants\ActivityTypes;
use Google\Client as GoogleClient;

class GoogleAuthController extends BaseController
{
    protected $googleClient;
    protected $usersModel;

    public function __construct()
    {
        $this->googleClient = new GoogleClient();
        $this->googleClient->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->googleClient->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->googleClient->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');

        $this->usersModel = new UsersModel();
    }

    public function login()
    {
        // Check if registration is enabled
        $allowRegistration = getConfigData("EnableRegistration");
        if(strtolower($allowRegistration) === "no"){
            $invalidAccessMsg = lang('App.invalid_access_msg');
            session()->setFlashdata('errorAlert', $invalidAccessMsg);
            return redirect()->to('/');
        }

        // Generate Google login URL
        $authUrl = $this->googleClient->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function callback()
    {
        helper('cookie');

        try {
            // Get the authorization code from the query string
            $code = $this->request->getGet('code');

            if (!$code) {
                // If there's an error, get the error message
                $error = $this->request->getGet('error');
                log_message('error', 'Google OAuth Error: ' . $error);
                
                session()->setFlashdata('errorAlert', 'Google authentication failed. Please try again.');
                return redirect()->to('/sign-in');
            }

            // Exchange authorization code for access token
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);
            
            if (isset($token['error'])) {
                log_message('error', 'Google Token Error: ' . json_encode($token['error']));
                session()->setFlashdata('errorAlert', 'Failed to authenticate with Google.');
                return redirect()->to('/sign-in');
            }

            // Set the access token
            $this->googleClient->setAccessToken($token['access_token']);

            // Get user profile data from Google
            $oauthService = new \Google\Service\Oauth2($this->googleClient);
            $googleUser = $oauthService->userinfo->get();

            // Process Google user data
            return $this->processGoogleUser($googleUser);

        } catch (\Exception $e) {
            log_message('error', 'Google Auth Exception: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            session()->setFlashdata('errorAlert', 'An error occurred during Google authentication.');
            return redirect()->to('/sign-in');
        }
    }

    private function processGoogleUser($googleUser)
    {
        $email = $googleUser->getEmail();
        $googleId = $googleUser->getId();
        $firstName = $googleUser->getGivenName();
        $lastName = $googleUser->getFamilyName();
        $fullName = $googleUser->getName();
        $profilePicture = $googleUser->getPicture();

        // Split full name if first/last name not provided
        if (empty($firstName) && empty($lastName) && !empty($fullName)) {
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';
        }

        // Check if user exists by email
        $existingUser = $this->usersModel->where('email', $email)->first();

        if ($existingUser) {
            // User exists - log them in
            return $this->loginExistingUser($existingUser);
        } else {
            // User doesn't exist - create new account
            return $this->createGoogleUser($email, $firstName, $lastName, $googleId, $profilePicture);
        }
    }

    private function loginExistingUser($user)
    {
        // Check if user status is active
        if ($user['status'] != 1) {
            session()->setFlashdata('errorAlert', lang('App.pending_activation_msg'));
            return redirect()->to('/sign-in');
        }

        // Set session data
        session()->set([
            'user_id' => $user['user_id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'upload_directory' => $user['upload_directory'],
            'is_social_login' => $user['is_social_login'],
            'is_logged_in' => TRUE
        ]);

        // Update last login
        $this->usersModel->update($user['user_id'], [
            'last_login' => date('Y-m-d H:i:s')
        ]);

        // Log activity
        logActivity($user['user_id'], ActivityTypes::USER_LOGIN, 'User logged in via Google with id: ' . $user['user_id']);

        session()->setFlashdata('toastrSuccessAlert', 'Successfully logged in with Google!');
        return redirect()->to('/account/dashboard');
    }

    private function createGoogleUser($email, $firstName, $lastName, $googleId, $profilePicture)
    {
        // Generate username from email
        $username = $this->generateUniqueUsername($email);
        
        // Generate a random password (user won't need it as they'll use Google login)
        $randomPassword = bin2hex(random_bytes(16));

        // Prepare user data for createUser method
        $userData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'email' => $email,
            'password' => $randomPassword,
            'profile_picture' => $profilePicture,
            'about_summary' => null,
            'twitter_link' => null,
            'facebook_link' => null,
            'instagram_link' => null,
            'linkedin_link' => null,
            'is_social_login' => true,
            'password_change_required' => false
        ];

        // Use the existing createUser method
        $creationResult = $this->usersModel->createUser($userData);

        if ($creationResult) {
            // Get the newly created user by email
            $newUser = $this->usersModel->where('email', $email)->first();
            
            if (!$newUser) {
                log_message('error', 'Failed to retrieve created Google user with email: ' . $email);
                session()->setFlashdata('errorAlert', 'Account created but login failed. Please try signing in manually.');
                return redirect()->to('/sign-in');
            }

            // Update the user status to active (since Google emails are verified)
            $this->usersModel->update($newUser['user_id'], [
                'status' => 1
            ]);

            // Refresh user data with updated status
            $newUser = $this->usersModel->where('email', $email)->first();

            // Log them in
            session()->set([
                'user_id' => $newUser['user_id'],
                'first_name' => $newUser['first_name'],
                'last_name' => $newUser['last_name'],
                'username' => $newUser['username'],
                'email' => $newUser['email'],
                'role' => $newUser['role'],
                'upload_directory' => $newUser['upload_directory'],
                'is_social_login' => $newUser['is_social_login'],
                'is_logged_in' => TRUE
            ]);

            // Update last login
            $this->usersModel->update($newUser['user_id'], [
                'last_login' => date('Y-m-d H:i:s')
            ]);

            // Log activity
            logActivity($newUser['user_id'], ActivityTypes::USER_REGISTRATION, 'User registered via Google with id: ' . $newUser['user_id']);

            session()->setFlashdata('toastrSuccessAlert', 'Account created successfully with Google!');
            return redirect()->to('/account/dashboard');
        } else {
            log_message('error', 'Failed to create Google user with email: ' . $email);
            session()->setFlashdata('errorAlert', 'Failed to create account. Please try again.');
            return redirect()->to('/sign-in');
        }
    }

    private function generateUniqueUsername($email)
    {
        // Extract base username from email
        $baseUsername = explode('@', $email)[0];
        $baseUsername = preg_replace('/[^a-zA-Z0-9]/', '', $baseUsername);
        $baseUsername = substr($baseUsername, 0, 20); // Limit length
        
        $username = $baseUsername;
        $counter = 1;

        // Check if username exists and generate unique one
        while ($this->usersModel->where('username', $username)->first()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}