<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\EmailService;

class ForgotPasswordController extends BaseController
{
    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    public function index()
    {
        $result = $this->emailService->sendHtmlEmail($toEmail, $name, $subject, $templateData, $fromEmail);

        return view('front-end/forgot-password/index');
    }

    public function sendResetLinkEmail()
    {
        //show demo message
        if(boolval(env('DEMO_MODE', "false"))){
            $errorMsg = "Reset password not available in the demo mode.";
            session()->setFlashdata('errorAlert', $errorMsg);
            return view('front-end/sign-up/index');
        }

        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);
        
        $rules = [
            'email' => 'required|valid_email',
        ];

        if ($this->validate($rules)) {
            $fromEmail = getConfigData("SiteEmail");
            $toEmail = $this->request->getPost('email');
            $tableName = 'users';

            if (recordExists($tableName, "email", $toEmail)) {
                $whereClause = ['email' => $toEmail];
                $firstName = getTableData($tableName, $whereClause, 'first_name');
                $lastName = getTableData($tableName, $whereClause, 'last_name');
                $userId = getTableData($tableName, $whereClause, 'user_id');
                $fullName = $firstName . " " . $lastName;

                $resetToken = generateResetLink($toEmail);
                $siteAddress = getConfigData("SiteAddress");
                $subject = 'Password Reset Request';

                $templateData = [
                    'preheader' => 'Password reset request for your account',
                    'greeting' => 'Hi ' . $fullName . ',',
                    'main_content' => "We received a request to reset your password. Click the link below to choose a new password:",
                    'cta_text' => 'Reset Password',
                    'cta_url' => site_url("password-reset/{$resetToken}"),
                    'footer_text' => '<p>If you did not request a password reset, please ignore this email or contact support if you have any questions.</p><br/><p>Password reset links are valid for 30 minutes.</p>',
                    'company_address' => $siteAddress,
                    'unsubscribe_url' => site_url('unsubscribe')
                ];

                //send email
                $result = $this->emailService->sendPasswordRecoveryHtmlEmail($toEmail, $fullName, $subject, $templateData, $fromEmail);

                if ($result) {
                    $resetLinkMsg = config('CustomConfig')->resetLinkMsg;
                    session()->setFlashdata('successAlert', $resetLinkMsg);
                    logActivity($userId, ActivityTypes::PASSWORD_RESET_SENT, 'Password reset link sent for user with id: ' . $userId);
                } else {
                    $nonExistingResetEmailMsg = config('CustomConfig')->nonExistingResetEmailMsg;
                    session()->setFlashdata('errorAlert', $nonExistingResetEmailMsg);
                    logActivity($userId, ActivityTypes::PASSWORD_RESET_FAILED, 'Failed to send reset link for user with id: ' . $userId);
                }
            } else {
                $nonExistingResetEmailMsg = config('CustomConfig')->nonExistingResetEmailMsg;
                session()->setFlashdata('errorAlert', $nonExistingResetEmailMsg);
            }

            return redirect()->to('/sign-in');
        } else {
            $data['validation'] = $this->validator;
            logActivity($this->request->getPost('email'), ActivityTypes::PASSWORD_RESET_FAILED, 'Invalid email provided for password reset');
            return view('front-end/forgot-password/index', $data);
        }
    }
}
