<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class SettingsController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
    }

    public function index()
    {
        return view('back-end/settings/index');
    }

    public function updateDetails()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');

        $usersModel = new UsersModel();

        // Fetch the data based on the id
        $user = $usersModel->where('user_id', $userId)->first();

        // Set data to pass in view
        $data = [
            'user_data' => $user
        ];

        return view('back-end/settings/update-details/index', $data);
    }

    public function updateUser()
    {
        $usersModel = new UsersModel();

        // Custom validation rules
        $rules = [
            'user_id' => 'required',
            'first_name' => 'required|max_length[50]|min_length[2]',
            'last_name' => 'required|max_length[50]|min_length[2]',
            'status' => 'required',
            'role' => 'required',
        ];
        
        $userId = $this->request->getVar('user_id');
        $data['user_data'] = $usersModel->where('user_id', $userId)->first();

        if($this->validate($rules))
        {
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name'  => $this->request->getVar('last_name'),
                'status'  => $this->request->getVar('status'),
                'role'  => $this->request->getVar('role'),
                'profile_picture' => $this->request->getPost('profile_picture') ?? getDefaultProfileImagePath(),
                'twitter_link' => $this->request->getPost('twitter_link'),
                'facebook_link' => $this->request->getPost('facebook_link'),
                'instagram_link' => $this->request->getPost('instagram_link'),
                'linkedin_link' => $this->request->getPost('linkedin_link'),
                'about_summary' => $this->request->getPost('about_summary')
            ];

            $builder->where('user_id', $userId);
            $builder->update($data);

            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'User', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);

            //log activity
            logActivity($userId, ActivityTypes::ACCOUNT_DETAILS_UPDATE, 'User with id: ' . $userId . ' updated account details');

            return redirect()->to('/account/settings');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($userId, ActivityTypes::FAILED_ACCOUNT_DETAILS_UPDATE, 'Failed to update user with id: ' . $userId);

            return view('back-end/settings/update-details/index', $data);
        }
    }

    public function changePassword()
    {
        // Access session data in this method
        $userId = $this->session->get('user_id');

        $usersModel = new UsersModel();

        // Fetch the data based on the id
        $user = $usersModel->where('user_id', $userId)->first();

        // Set data to pass in view
        $data = [
            'user_data' => $user
        ];

        return view('back-end/settings/change-password/index', $data);
    }

    public function updatePassword()
    {
        // Access session data in this method
        $userEmail = $this->session->get('email');

        $usersModel = new UsersModel();

        // Custom validation rules
        $rules = [
            'user_id' => 'required',
            'current_password' => 'required|max_length[50]|min_length[2]',
            'new_password' => 'required|max_length[50]|min_length[2]',
            'repeat_password' => 'required|max_length[50]|min_length[2]',
        ];

        $userId = $this->request->getVar('user_id');

        $data['user_data'] = $usersModel->where('user_id', $userId)->first();

        if($this->validate($rules))
        {
            $currentPassword = $this->request->getVar('current_password');
            $newPassword = $this->request->getVar('new_password');
            $repeatPassword = $this->request->getVar('repeat_password');

            //validate current login password
            $userData = $usersModel->validateLogin($userEmail, $currentPassword);
            if (!$userData)
            {
                //show current password not valid
                $errorMsg = config('CustomConfig')->currentPasswordMissMatch;
                session()->setFlashdata('errorAlert', $errorMsg);
                return view('back-end/settings/change-password/index', $data);
            }

            //check if new passwords match
            if($newPassword != $repeatPassword)
            {
                $errorMsg = config('CustomConfig')->currentNewPasswordMissMatch;
                session()->setFlashdata('errorAlert', $errorMsg);
                return view('back-end/settings/change-password/index', $data);
            }

            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $data = [
                'password'  => password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT),
                'password_change_required'  => false
            ];

            $builder->where('user_id', $userId);
            $builder->update($data);

            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'Password', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);

            //log activity
            logActivity($userId, ActivityTypes::PASSWORD_CHANGED, 'User with id: ' . $userId . ' updated password');

            return redirect()->to('/account/settings');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($userId, ActivityTypes::FAILED_PASSWORD_CHANGED, 'Failed to change password with id: ' . $userId);

            return view('back-end/settings/change-password/index', $data);
        }
    }
}
