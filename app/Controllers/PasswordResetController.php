<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use CodeIgniter\Controller;

class PasswordResetController extends Controller
{
    public function index($token)
    {
        if (!isValidResetToken($token)) {
            $invalidResetLinkMsg = config('CustomConfig')->invalidResetLinkMsg;
            session()->setFlashdata('errorAlert', $invalidResetLinkMsg);
            return redirect()->to('/forgot-password');
        }

        return view('front-end/password-reset/index', ['token' => $token]);
    }

    public function resetPassword()
    {
        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[6]|regex_match[/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$/]',
            'password_confirm' => 'required|matches[password]',
        ];

        if ($this->validate($rules)) {
            $token = $this->request->getPost('token');
            $password = $this->request->getPost('password');

            if (!isValidResetToken($token)) {
                $invalidResetLinkMsg = config('CustomConfig')->invalidResetLinkMsg;
                session()->setFlashdata('errorAlert', $invalidResetLinkMsg);
                return redirect()->to('/forgot-password');
            }

            $tableName = 'password_resets';
            $whereClause = ['token' => $token];
            $returnColumn = 'email';
            $email = getTableData($tableName, $whereClause, $returnColumn);

            $db = \Config\Database::connect();
            $user = $db->table('users')->where('email', $email)->get()->getRowArray();

            if ($user) {
                // Update the user's password
                $db->table('users')->update(['password' => password_hash($password, PASSWORD_DEFAULT)], ['email' => $email]);

                // Delete the used reset token
                $db->table('password_resets')->where('token', $token)->delete();

                logActivity($user['user_id'], ActivityTypes::PASSWORD_RESET_SUCCESS, 'Password reset successful for user with id: '. $user['user_id']);

                $passwordResetSuccessfulMsg = config('CustomConfig')->passwordResetSuccessfulMsg;
                session()->setFlashdata('successAlert', $passwordResetSuccessfulMsg);

                return redirect()->to('/sign-in');
            }
        }

        $token = $this->request->getPost('token');
        $passwordResetFailedMsg = config('CustomConfig')->passwordResetFailedMsg;
        session()->setFlashdata('errorAlert', $passwordResetFailedMsg);
        if(!empty($token)){
            return redirect()->to('/password-reset/' .$token);
        }
        return redirect()->to('/forgot-password');
    }
}