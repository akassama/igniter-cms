<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BookingFormsModel;
use App\Models\ContactFormsModel;
use App\Models\SubscriptionFormsModel;
use App\Libraries\EmailService;
use Exception;

class APIFormController extends BaseController
{
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
        $formName = $this->request->getPost('form_name');
        $toEmail = env('FORWARD_CONTACT_EMAIL_TO');
        $name = $this->request->getPost('name');
        $fromEmail = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $subject = $this->request->getPost('subject') ?? 'Contact Message';
        $message = $this->request->getPost('message');
        $company = $this->request->getPost('company');
        $website = $this->request->getPost('website');
        $companyName = getConfigData('CompanyName');
        $companyAddress = getConfigData('CompanyAddress');

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
            //add contact data
            $contactMessagesModel = new ContactFormsModel();
            $data = [
                'site_id' => getCurrentDomain(),
                'form_name' => $formName,
                'name' => $name,
                'email' => $fromEmail,
                'phone' => $phone,
                'subject' => $subject,
                'message' => $message,
                'company' => $company,
                'website' => $website,
                'ip_address' => getIPAddress(),
                'country' => getCountry(),
                'user_agent' => getUserDevice(),
                'referrer' => getReferrer(),
                'is_read' => 0,
                'is_archived' => 0,
                'status' => 'New',
                'notes' => null,
                'last_updated_by' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
            ];
            $contactMessagesModel->createContactFormSubmission($data);

            // Record created successfully.
            $contactMessageSuccessful = config('CustomConfig')->contactMessageSuccessful;
            session()->setFlashdata('successAlert', $contactMessageSuccessful);

            //log activity
            logActivity($fromEmail, ActivityTypes::CONTACT_FORM_SUBMISSION, 'Contact message sent from user with email: ' . $fromEmail);

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
                    'unsubscribe_url' => base_url('services/unsubscribe?identifier='.$toEmail)
                ];
                $result = $this->emailService->send($toEmail, $subject, $templateData);
            } catch (Exception $e) {
                //log activity
                logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail);
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
            logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail);

            if(!empty($returnUrl)){
                return redirect()->to($returnUrl);      
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to send email']);
        }
    }

    //ADD SUBSCRIPTION
    public function addSubscription()
    {
        // Retrieve honeypot and timestamp
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            $errorMessage = $captchaValidation;
            $returnUrl = $this->request->getPost('return_url');
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        // Validation
        $rules = [
            'email' => 'required|valid_email', 
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errorMessage = implode(' ', $errors);

            $returnUrl = $this->request->getPost('return_url');
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(400)->setJSON(['message' => $errorMessage]);
        }

        // Extract data
        $returnUrl   = $this->request->getPost('return_url');
        $formName    = $this->request->getPost('form_name');
        $email       = $this->request->getPost('email');
        $name        = $this->request->getPost('name');
        $name        = $name ?? ucfirst(strtok($email, '@'));
        $firstName   = $this->request->getPost('first_name');
        $lastName    = $this->request->getPost('last_name');
        $phone       = $this->request->getPost('phone');
        $source      = $this->request->getPost('source');

        $tableName = 'subscription_form_submissions';
        //Check if record exists
        if (recordExists($tableName, "email", $email)) {
            //Resubscribe user email
            $updateColumn =  "'status' = 'Active'";
            $updateWhereClause = "email = '$email'";
            $result = updateRecordColumn($tableName, $updateColumn, $updateWhereClause);

            $infoMsg = str_replace('[Record]', 'Email', config('CustomConfig')->alreadyExistMsg). " Your subscription has been re-activated.";
            session()->setFlashdata('infoAlert', $infoMsg);
            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $infoMsg]);
        }

        try {
            $subscriptionModel = new SubscriptionFormsModel();
            $data = [
                'site_id'          => getCurrentDomain(),
                'form_name'        => $formName,
                'email'            => $email,
                'name'             => $name,
                'first_name'       => $firstName,
                'last_name'        => $lastName,
                'phone'            => $phone,
                'source'           => $source,
                'status'           => 'Pending Confirmation',
                'unsubscribed_at'  => null,
                'ip_address'       => getIPAddress(),
                'country'          => getCountry(),
                'last_updated_by'  => null,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => null,
            ];
            $subscriptionModel->createSubscriptionSubmission($data);

            $subscriptionSuccessful = config('CustomConfig')->subscriptionSuccessful ?? 'Subscription received. Please check your email to confirm.';
            session()->setFlashdata('successAlert', $subscriptionSuccessful);

            logActivity($email, ActivityTypes::SUBSCRIPTION_FORM_SUBMISSION, 'Subscription request received for: ' . $email);

            try {
                $subject = 'Confirm your subscription';
                $templateData = [
                    'preheader'      => $subject,
                    'greeting'       => 'Please confirm your subscription',
                    'main_content'   => '<p>Thanks for subscribing. Please confirm your email address to complete your subscription.</p>',
                    'cta_text'       => 'Confirm Subscription',
                    'cta_url'        => base_url('services/confirm-subscription?email=' . urlencode($email)),
                    'footer_text'    => '',
                    'company_address'=> '',
                    'unsubscribe_url'=> base_url('services/unsubscribe?identifier=' . urlencode($email)),
                ];
                $this->emailService->send($email, $subject, $templateData);
            } catch (Exception $e) {
                logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_FORM_SUBMISSION, 'Failed to send subscription confirmation to: ' . $email);
            }

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Subscription recorded. Please confirm via email.']);
        } catch (Exception $e) {
            $subscriptionFailed = config('CustomConfig')->subscriptionFailed ?? 'Failed to process subscription.';
            session()->setFlashdata('errorAlert', $subscriptionFailed);
            logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_FORM_SUBMISSION, 'Failed to process subscription for: ' . $email);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to process subscription']);
        }
    }

    // BOOKINGS
    public function addBooking()
    {
        // Retrieve honeypot and timestamp values
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        // Validate hCaptcha
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            $errorMessage = $captchaValidation;
            $returnUrl = $this->request->getPost('return_url');
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => $errorMessage]);
        }

        // VALIDATION: email and appointment_date are required
        $rules = [
            'email'              => 'required|valid_email',
            'appointment_date'   => 'required',
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $errorMessage = implode(' ', $errors);

            $returnUrl = $this->request->getPost('return_url');
            if (!empty($returnUrl)) {
                session()->setFlashdata('errorAlert', $errorMessage);
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(400)->setJSON(['message' => $errorMessage]);
        }

        // Extract and sanitize input
        $returnUrl          = $this->request->getPost('return_url');
        $formName           = $this->request->getPost('form_name') ?? 'Default Booking Form';
        $name               = $this->request->getPost('name');
        $firstName          = $this->request->getPost('first_name');
        $lastName           = $this->request->getPost('last_name');
        $email              = $this->request->getPost('email');
        $phone              = $this->request->getPost('phone');
        $serviceId          = $this->request->getPost('service_id');
        $serviceName        = $this->request->getPost('service_name');
        $appointmentDate    = $this->request->getPost('appointment_date');
        $appointmentTime    = $this->request->getPost('appointment_time');
        $duration           = $this->request->getPost('duration');
        $numberOfAttendees  = $this->request->getPost('number_of_attendees');
        $message            = $this->request->getPost('message');
        $resourceId         = $this->request->getPost('resource_id');
        $resourceName       = $this->request->getPost('resource_name');

        // Optional: auto-generate name if not provided
        if (empty($name) && (!empty($firstName) || !empty($lastName))) {
            $name = trim(($firstName ?? '') . ' ' . ($lastName ?? ''));
        }

        try {
            $bookingModel = new BookingFormsModel();

            $data = [
                'booking_form_id'     => getGUID(), // assuming this helper exists
                'site_id'             => getCurrentDomain(),
                'form_name'           => $formName,
                'name'                => $name,
                'first_name'          => $firstName,
                'last_name'           => $lastName,
                'email'               => $email,
                'phone'               => $phone,
                'service_id'          => $serviceId,
                'service_name'        => $serviceName,
                'appointment_date'    => $appointmentDate,
                'appointment_time'    => $appointmentTime,
                'duration'            => $duration,
                'number_of_attendees' => $numberOfAttendees,
                'message'             => $message,
                'status'              => 'Pending',
                'confirmation_code'   => null, // can be generated later if needed
                'notes'               => null,
                'resource_id'         => $resourceId,
                'resource_name'       => $resourceName,
                'payment_status'      => 'None',
                'payment_amount'      => null,
                'ip_address'          => getIPAddress(),
                'country'             => getCountry(),
                'last_updated_by'     => null,
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => null,
            ];

            $bookingModel->createBookingSubmission($data);

            // Success message
            $bookingSuccessful = config('CustomConfig')->bookingSuccessful ?? 'Booking request received. We’ll contact you soon.';
            session()->setFlashdata('successAlert', $bookingSuccessful);

            // Log activity
            logActivity($email, ActivityTypes::BOOKING_FORM_SUBMISSION, 'Booking request submitted for: ' . $email . ' on ' . $appointmentDate);

            // Optional: Send confirmation email to user
            try {
                $companyName = getConfigData('CompanyName');
                $subject = 'Booking Request Received';
                $templateData = [
                    'preheader'      => $subject,
                    'greeting'       => 'Thank you for your booking request!',
                    'main_content'   => '<p>We’ve received your request for an appointment on <strong>' . htmlspecialchars($appointmentDate, ENT_QUOTES, 'UTF-8') . '</strong>.</p><p>We’ll review it and get back to you shortly.</p>',
                    'cta_text'       => 'View Our Services',
                    'cta_url'        => base_url('services'),
                    'footer_text'    => 'Sent from ' . $companyName,
                    'company_address'=> getConfigData('CompanyAddress'),
                    'unsubscribe_url'=> base_url('services/unsubscribe?identifier=' . urlencode($email)),
                ];
                $this->emailService->send($email, $subject, $templateData);
            } catch (Exception $e) {
                logActivity($email, ActivityTypes::FAILED_BOOKING_FORM_SUBMISSION, 'Failed to send booking confirmation to: ' . $email);
            }

            // Redirect or return JSON
            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Booking request submitted successfully.']);

        } catch (Exception $e) {
            $bookingFailed = config('CustomConfig')->bookingFailed ?? 'Failed to process booking request.';
            session()->setFlashdata('errorAlert', $bookingFailed);
            logActivity($email ?? 'unknown', ActivityTypes::FAILED_BOOKING_FORM_SUBMISSION, 'Booking submission failed: ' . $e->getMessage());

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to process booking']);
        }
    }
}
