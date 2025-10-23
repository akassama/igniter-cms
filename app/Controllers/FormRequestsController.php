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

class FormRequestsController extends BaseController
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

        $forwardEmail = env('FORWARD_CONTACT_EMAIL');
        $forwardToEmail = env('FORWARD_CONTACT_EMAIL_TO');
        $returnUrl = $this->request->getPost('return_url');
        $formName = $this->request->getPost('form_name');
        $name = $this->request->getPost('name');
        $fromEmail = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $subject = $this->request->getPost('subject') ?? 'Contact Message';
        $message = $this->request->getPost('message');
        $company = $this->request->getPost('company');
        $website = $this->request->getPost('website');
        $siteName = getConfigData('SiteName');
        $siteAddress = getConfigData('SiteAddress');

        // Validate Captcha
        $captchaValidation = validateCaptcha();
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

            if($forwardEmail){
                //try to send email
                try {
                    $templateData = [
                        'preheader' => $subject,
                        'greeting' => 'New Contact Message',
                        'main_content' =>
                        '<p>You have received a new contact message.</p>'
                        .'<h4>Message Details</h4>'
                        .'<ul>'
                        .'<li><strong>Subject:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</li>'
                        .(!empty($message) ? '<li><strong>Message:</strong> ' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</li>' : '')
                        .'</ul>'
                        .'<h4>Sender Information</h4>'
                        .'<ul>'
                        .(!empty($name) ? '<li><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .'<li><strong>Email:</strong> ' . htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') . '</li>'
                        .(!empty($phone) ? '<li><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($company) ? '<li><strong>Company:</strong> ' . htmlspecialchars($company, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($website) ? '<li><strong>Website:</strong> ' . htmlspecialchars($website, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .'</ul>'
                        .'<p><small><strong>IP:</strong> ' . htmlspecialchars(getIPAddress(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Country:</strong> ' . htmlspecialchars(getCountry(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Submitted At:</strong> ' . htmlspecialchars(date('Y-m-d H:i:s'), ENT_QUOTES, 'UTF-8') . '</small></p>',
                        'cta_text' => '',
                        'cta_url' => '',
                        'footer_text' => 'Sent from <a href="'.base_url().'">'.$siteName.'</a>',
                        'company_address' => $siteAddress,
                        'unsubscribe_url' => base_url('services/unsubscribe?identifier='.urlencode($forwardToEmail))
                    ];
                    $result = $this->emailService->send($forwardToEmail, $subject, $templateData);
                } catch (Exception $e) {
                    //log activity
                    logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail);
                }
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

        // Validate Captcha
        $captchaValidation = validateCaptcha();
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

        $forwardEmail = env('FORWARD_SUBSCRIPTION_EMAIL');
        $forwardToEmail = env('FORWARD_SUBSCRIPTION_EMAIL_TO');
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
        $confirmationToken      = getGUID();
        $siteName = getConfigData('SiteName');
        $siteAddress = getConfigData('SiteAddress');

        //Check if record exists
        $tableName = 'subscription_form_submissions';
        $where = [
            'email' => $email,
            'form_name' => $formName
        ];

        if (checkRecordExists($tableName, $where)) {
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
                'status'           => env('DEFAULT_SUBSCRIPTION_STATUS'),
                'confirmation_token' => $confirmationToken,
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

            // notify user to confirm subscription
            try {
                $subject = 'Confirm your subscription';
                $templateData = [
                    'preheader'      => $subject,
                    'greeting'       => 'Please confirm your subscription',
                    'main_content'   => '<p>Thanks for subscribing. Please confirm your email address to complete your subscription.</p>',
                    'cta_text'       => 'Confirm Subscription',
                    'cta_url'        => base_url('services/confirm-subscription?email=' . urlencode($confirmationToken)),
                    'footer_text'    => '',
                    'company_address'=> '',
                    'unsubscribe_url'=> base_url('services/unsubscribe?identifier=' . urlencode($email)),
                ];
                $this->emailService->send($email, $subject, $templateData);
            } catch (Exception $e) {
                logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_FORM_SUBMISSION, 'Failed to send subscription confirmation to: ' . $email);
            }

            if($forwardEmail){
                //try to send email
                try {
                    $subject = 'New Subscription';
                    $templateData = [
                        'preheader' => $subject,
                        'greeting' => 'New Subscription',
                        'main_content' =>
                        '<p>You have received a new subscription request.</p>'
                        .'<h4>Subscriber Details</h4>'
                        .'<ul>'
                        .'<li><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</li>'
                        .(!empty($name) ? '<li><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($phone) ? '<li><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($formName) ? '<li><strong>Form:</strong> ' . htmlspecialchars($formName, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($source) ? '<li><strong>Source:</strong> ' . htmlspecialchars($source, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .'</ul>'
                        .'<p>The user has been sent a confirmation email. They will appear as "Active" in the system once they confirm.</p>'
                        .'<p><small><strong>IP:</strong> ' . htmlspecialchars(getIPAddress(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Country:</strong> ' . htmlspecialchars(getCountry(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Submitted At:</strong> ' . htmlspecialchars(date('Y-m-d H:i:s'), ENT_QUOTES, 'UTF-8') . '</small></p>',
                        'cta_text' => 'Manage Subscriptions',
                        'cta_url' => base_url('account/forms/subscription-forms'),
                        'footer_text' => 'Sent from <a href="'.base_url().'">'.$siteName.'</a>',
                        'company_address' => $siteAddress,
                        'unsubscribe_url' => base_url('services/unsubscribe?identifier='.urlencode($forwardToEmail))
                    ];
                    $result = $this->emailService->send($forwardToEmail, $subject, $templateData);
                } catch (Exception $e) {
                    //log activity
                    logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail);
                }
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

        // Validate Captcha
        $captchaValidation = validateCaptcha();
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

        $forwardEmail = env('FORWARD_BOOKING_EMAIL');
        $forwardToEmail = env('FORWARD_BOOKING_EMAIL_TO');
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
        $siteName = getConfigData('SiteName');
        $siteAddress = getConfigData('SiteAddress');

        // Auto-generate name if not provided
        if (empty($name) && (!empty($firstName) || !empty($lastName))) {
            $name = trim(($firstName ?? '') . ' ' . ($lastName ?? ''));
        }

        try {
            $bookingModel = new BookingFormsModel();

            $data = [
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
                'confirmation_code'   => null,
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

            // Send confirmation email to user
            try {
                $subject = 'Booking Request Received';
                $templateData = [
                    'preheader'      => $subject,
                    'greeting'       => 'Thank you for your booking request!',
                    'main_content'   => '<p>We’ve received your request for an appointment on <strong>' . htmlspecialchars($appointmentDate, ENT_QUOTES, 'UTF-8') . '</strong>.</p><p>We’ll review it and get back to you shortly.</p>',
                    'cta_text'       => 'Visit Site',
                    'cta_url'        => base_url(),
                    'footer_text'    => 'Sent from ' . $siteName,
                    'company_address'=> $siteAddress,
                    'unsubscribe_url'=> base_url('services/unsubscribe?identifier=' . urlencode($email)),
                ];
                $this->emailService->send($email, $subject, $templateData);
            } catch (Exception $e) {
                logActivity($email, ActivityTypes::FAILED_BOOKING_FORM_SUBMISSION, 'Failed to send booking confirmation to: ' . $email);
            }

            if($forwardEmail){
                //try to send email
                try {
                    $templateData = [
                        'preheader' => $subject,
                        'greeting' => 'New Booking',
                        'main_content' =>
                        '<p>You have received a new booking request.</p>'
                        .'<h4>Booking Details</h4>'
                        .'<ul>'
                        .'<li><strong>Date:</strong> ' . htmlspecialchars($appointmentDate, ENT_QUOTES, 'UTF-8') . '</li>'
                        .(!empty($appointmentTime) ? '<li><strong>Time:</strong> ' . htmlspecialchars($appointmentTime, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($serviceName) ? '<li><strong>Service:</strong> ' . htmlspecialchars($serviceName, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($duration) ? '<li><strong>Duration:</strong> ' . htmlspecialchars($duration, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($numberOfAttendees) ? '<li><strong>Attendees:</strong> ' . htmlspecialchars($numberOfAttendees, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($resourceName) ? '<li><strong>Resource:</strong> ' . htmlspecialchars($resourceName, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .(!empty($message) ? '<li><strong>Message:</strong> ' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</li>' : '')
                        .'</ul>'
                        .'<h4>Client Details</h4>'
                        .'<ul>'
                        .(!empty($name) ? '<li><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .'<li><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</li>'
                        .(!empty($phone) ? '<li><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</li>' : '')
                        .'</ul>'
                        .'<p><small><strong>IP:</strong> ' . htmlspecialchars(getIPAddress(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Country:</strong> ' . htmlspecialchars(getCountry(), ENT_QUOTES, 'UTF-8')
                        . ' &middot; <strong>Submitted At:</strong> ' . htmlspecialchars(date('Y-m-d H:i:s'), ENT_QUOTES, 'UTF-8') . '</small></p>',
                        'cta_text' => 'Manage Bookings',
                        'cta_url' => base_url('account/forms/subscription-forms'),
                        'footer_text' => 'Sent from <a href="'.base_url().'">'.$siteName.'</a>',
                        'company_address' => $siteAddress,
                        'unsubscribe_url' => base_url('services/unsubscribe?identifier='.urlencode($forwardToEmail))
                    ];
                    $result = $this->emailService->send($forwardToEmail, $subject, $templateData);
                } catch (Exception $e) {
                    //log activity
                    logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail);
                }
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
