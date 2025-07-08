<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\ContactMessagesModel;
use App\Models\SubscribersModel;
use App\Services\EmailService;

class APIFormController extends BaseController
{
    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    //CONTACT MESSAGES
    public function sendContactMessage()
    {
        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        $returnUrl = $this->request->getPost('return_url');
        $toEmail = getConfigData("CompanyEmail");
        $name = $this->request->getPost('name');
        $fromEmail = $this->request->getPost('email');
        $subject = $this->request->getPost('subject') ?? "Contact Message";
        $message = $this->request->getPost('message');
        $companyName = getConfigData("CompanyName");
        $companyAddress = getConfigData("CompanyAddress");

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            // CAPTCHA validation failed
            $errorMessage = $captchaValidation; // Error message returned by the helper function
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        try {
            //add client feedback data
            $contactMessagesModel = new ContactMessagesModel();
            $data = [
                'name' => $name,
                'email' => $this->request->getPost('email'),
                'subject' => $subject,
                'message' => $message,
                'ip_address' => getIPAddress(),
                'country' => getCountry(),
                'device' => getUserDevice(),
            ];
            $contactMessagesModel->createContactMessage($data);

            // Record created successfully.
            $contactMessageSuccessful = config('CustomConfig')->contactMessageSuccessful;
            session()->setFlashdata('successAlert', $contactMessageSuccessful);

            //log activity
            logActivity($fromEmail, ActivityTypes::CONTACT_MESSAGE_CREATION, 'Contact message sent from user with email: ' . $fromEmail);

            //try to send email
            try {
                $templateData = [
                    'preheader' => $subject,
                    'greeting' => 'New Contact Message',
                    'main_content' => '<p>'.$message.'</p>',
                    'cta_text' => '',
                    'cta_url' => '',
                    'footer_text' => 'Sent from <a href="'.base_url().'">'.$companyName.'</a>',
                    'company_address' => $companyAddress,
                    'unsubscribe_url' => base_url('/unsubscribe/'.$toEmail)
                ];
                $result = $this->emailService->sendHtmlEmail($toEmail, $name, $subject, $templateData, $fromEmail);
            } catch (Exception $e) {
                //log activity
                logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_MESSAGE_CREATION, 'Failed to send contact message from user with email: ' . $fromEmail);
            }


            if(!empty($returnUrl)){
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Email sent successfully']);
        } catch(Exception $e) {

            // Failed to create record.
            $contactMessageFailed = config('CustomConfig')->contactMessageFailed;
            session()->setFlashdata('errorAlert', $contactMessageFailed);

            //log activity
            logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_MESSAGE_CREATION, 'Failed to send contact message from user with email: ' . $fromEmail);

            if(!empty($returnUrl)){
                return redirect()->to($returnUrl);      
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to send email']);
        }
    }

    //ADD SUBSCRIPTION
    public function addSubscription()
    {
        // Retrieve the honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        //Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);
        
        // Get POST data - using input stream since it might be coming from fetch/ajax
        $json = $this->request->getBody();
        $postData = json_decode($json, true);
        
        // If json decode failed, try getting regular POST data
        if (json_last_error() !== JSON_ERROR_NONE) {
            $email = $this->request->getPost('email');
            $returnUrl = $this->request->getPost('return_url');
        } else {
            $email = $postData['email'] ?? '';
            $returnUrl = $postData['return_url'] ?? '';
        }

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            // CAPTCHA validation failed
            $errorMessage = $captchaValidation; // Error message returned by the helper function
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        // Validate email
        if (empty($email)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Email is required'
            ]);
        }

        $subscribersModel = new SubscribersModel();
        $data = [
            'name' => ucfirst(strtok($email, '@')), // Get name from email
            'email' => $email,
            'status' => 1,
            'ip_address' => getIPAddress(),
            'country' => getCountry(),
        ];

        $tableName = 'subscribers';
        //Check if record exists
        if (recordExists($tableName, "email", $email)) {
            //update status as well
            $updateColumn = "'status' = '1'";
            $updateWhereClause = "email = '$email'";
            updateRecordColumn("subscribers", $updateColumn, $updateWhereClause);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => 'Subscribed successfully'
            ]);
        }

        // Attempt to create the subscriber
        if ($subscribersModel->createSubscriber($data)) {
            // Record created successfully.
            $subscriptionSuccessful = config('CustomConfig')->subscriptionSuccessful;
            session()->setFlashdata('successAlert', $subscriptionSuccessful);

            //log activity
            logActivity($email, ActivityTypes::SUBSCRIPTION_CREATION, 'User subscribed with email: ' . $email);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => $subscriptionSuccessful
            ]);
        } else {
            // Failed to create record.
            $subscriptionFailed = config('CustomConfig')->subscriptionFailed;
            session()->setFlashdata('errorAlert', $subscriptionFailed);

            //log activity
            logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_CREATION, 'Failed to create subscription with email: ' . $email);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => $subscriptionFailed
            ]);
        }
    }
}
