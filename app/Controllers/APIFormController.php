<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BookingFormsModel;
use App\Models\ContactFormsModel;
use App\Models\SubscriptionFormsModel;
use App\Models\FormFieldsModel;
use App\Models\FormSettingsModel;
use App\Libraries\EmailService;
use Exception;

class APIFormController extends BaseController
{
    protected $emailService;
    protected $contactFormsModel;
    protected $bookingFormsModel;
    protected $subscriptionFormsModel;
    protected $formFieldsModel;
    protected $formSettingsModel;
    protected $currentSiteId;

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->contactFormsModel = new ContactFormsModel();
        $this->bookingFormsModel = new BookingFormsModel();
        $this->subscriptionFormsModel = new SubscriptionFormsModel();
        $this->formFieldsModel = new FormFieldsModel();
        $this->formSettingsModel = new FormSettingsModel();

        // Determine current site ID dynamically
        // Example: from session, subdomain, or a hidden field in the form itself
        // For now, defaulting to 1 as in FormsController example
        $this->currentSiteId = 1;
    }

    // Common method to validate honeypot and captcha
    private function preValidateForm($honeypotInput, $submittedTimestamp)
    {
        // Honeypot validator - Validate the inputs
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        // TODO - Implement Captcha Validation here
        // if (!$this->validateCaptcha()) {
        //     throw new Exception("Captcha validation failed.");
        // }
    }

    // Dynamically build validation rules from FormFieldsModel
    private function buildValidationRules($formType, $siteId)
    {
        $formFields = $this->formFieldsModel->getActiveFormFields($formType, $siteId);
        $rules = [];
        $messages = [];
        foreach ($formFields as $field) {
            if (!empty($field['validation_rules'])) {
                $rules[$field['field_name']] = $field['validation_rules'];
            }
            if (!empty($field['validation_messages'])) {
                $decodedMessages = json_decode($field['validation_messages'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $messages[$field['field_name']] = $decodedMessages;
                }
            }
        }
        return ['rules' => $rules, 'messages' => $messages, 'form_fields' => $formFields];
    }

    // Common method to send notification emails
    private function sendNotificationEmail($formType, $formSettings, $subject, $submissionData, $companyName, $companyAddress)
    {
        if (isset($formSettings['enable_notifications']) && $formSettings['enable_notifications'] == '1' && isset($formSettings['notification_email'])) {
            try {
                // Build email content dynamically from submission data
                $mainContent = '<h4>New ' . ucfirst($formType) . ' Form Submission:</h4>';
                $mainContent .= '<table cellpadding="5" cellspacing="0" border="1" style="width:100%; border-collapse: collapse;">';
                foreach ($submissionData as $key => $value) {
                    // Exclude internal fields or fields not meant for notification
                    if (!in_array($key, ['site_id', 'ip_address', 'user_agent', 'referrer', 'created_at', 'updated_at', 'form_name', 'status', 'notes', 'id'])) {
                        $label = ucwords(str_replace('_', ' ', $key)); // Basic label conversion
                        $displayValue = is_array($value) ? implode(', ', $value) : $value; // Handle array values
                        $mainContent .= '<tr><td style="width:30%;"><strong>' . esc($label) . ':</strong></td><td>' . esc($displayValue) . '</td></tr>';
                    }
                }
                $mainContent .= '</table>';


                $templateData = [
                    'preheader' => $subject,
                    'greeting' => 'New ' . ucfirst($formType) . ' Submission',
                    'main_content' => $mainContent,
                    'cta_text' => '',
                    'cta_url' => '',
                    'footer_text' => 'Sent from <a href="' . base_url() . '">' . $companyName . '</a>',
                    'company_address' => $companyAddress,
                    'unsubscribe_url' => site_url('services/unsubscribe?identifier='.$formSettings['notification_email'])
                ];
                $this->emailService->send($formSettings['notification_email'], $subject, $templateData);
            } catch (Exception $e) {
                // Log email sending failure, but don't stop the form submission process
                logActivity('system', ActivityTypes::EMAIL_SEND_FAILED, 'Failed to send ' . $formType . ' notification email to ' . $formSettings['notification_email'] . ': ' . $e->getMessage());
            }
        }
    }


    //############################//
    //      CONTACT MESSAGES      //
    //############################//
    public function sendContactMessage()
    {
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        $returnUrl = $this->request->getPost('return_url');
        $siteId = $this->currentSiteId; // Get the site ID

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // Fetch dynamic validation rules and form fields
            $validationInfo = $this->buildValidationRules('contact', $siteId);
            $validationRules = $validationInfo['rules'];
            $validationMessages = $validationInfo['messages'];
            $formFields = $validationInfo['form_fields'];

            // Perform dynamic validation
            if (!$this->validate($validationRules, $validationMessages)) {
                $errors = $this->validator->getErrors();
                // If it's an AJAX call, return JSON errors
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                // For non-AJAX, redirect back with input and errors
                session()->setFlashdata('errors', $errors);
                return redirect()->back()->withInput();
            }

            // Prepare submission data based on allowed fields and form field definitions
            $submissionData = [
                'site_id'       => $siteId,
                'ip_address'    => getIPAddress(),
                'user_agent'    => getUserDevice(), // Using getUserDevice as per your existing code
                'country'       => getCountry(),
                'form_name'     => $this->request->getPost('form_name') ?? 'General Contact',
                'status'        => 'New',
                'is_read'       => 0,
                'is_archived'   => 0,
            ];

            foreach ($formFields as $field) {
                // Ensure field_name exists as a column in the contact_form_submissions table
                // and then add it to submissionData from POST
                if (in_array($field['field_name'], $this->contactFormsModel->allowedFields)) {
                    $submissionData[$field['field_name']] = $this->request->getPost($field['field_name']);
                }
            }
            
            // Handle split name if 'name' is not present but 'first_name'/'last_name' are
            if (!isset($submissionData['name']) && isset($submissionData['first_name'])) {
                 $submissionData['name'] = trim(($submissionData['first_name'] ?? '') . ' ' . ($submissionData['last_name'] ?? ''));
            }

            // Save the contact form submission
            $submissionId = $this->contactFormsModel->saveSubmission($submissionData);

            if (!$submissionId) {
                throw new Exception('Failed to save contact form submission.');
            }

            // Record created successfully.
            $contactMessageSuccessful = config('CustomConfig')->contactMessageSuccessful;
            session()->setFlashdata('successAlert', $contactMessageSuccessful);

            // Log activity
            $fromEmail = $submissionData['email'] ?? 'unknown@example.com';
            logActivity($fromEmail, ActivityTypes::CONTACT_FORM_SUBMISSION, 'Contact message sent from user with email: ' . $fromEmail . ' (ID: ' . $submissionId . ')');

            // Fetch form settings for notifications
            $formSettings = $this->formSettingsModel->getFormSettings('contact', $siteId);
            $companyName = getConfigData("CompanyName");
            $companyAddress = getConfigData("CompanyAddress");
            $subject = $submissionData['subject'] ?? "New Contact Message";

            // Send notification email
            $this->sendNotificationEmail('contact', $formSettings, $subject, $submissionData, $companyName, $companyAddress);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Form submitted successfully']);

        } catch (Exception $e) {
            $fromEmail = $this->request->getPost('email') ?? 'unknown@example.com'; // Get email/default email for logging
            $contactMessageFailed = config('CustomConfig')->contactMessageFailed;
            session()->setFlashdata('errorAlert', $contactMessageFailed);

            logActivity($fromEmail, ActivityTypes::FAILED_CONTACT_FORM_SUBMISSION, 'Failed to send contact message from user with email: ' . $fromEmail . '. Error: ' . $e->getMessage());

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to submit form', 'error' => $e->getMessage()]);
        }
    }

    //############################//
    //       ADD SUBSCRIPTION     //
    //############################//
    public function addSubscription()
    {
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        $returnUrl = $this->request->getPost('return_url');
        $siteId = $this->currentSiteId;

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // If incoming is JSON, decode it
            $requestBody = $this->request->getBody();
            $postData = [];
            if ($requestBody && json_last_error() === JSON_ERROR_NONE) {
                $postData = json_decode($requestBody, true);
            }
            // Merge with regular POST data (might be empty if JSON)
            $allRequestData = array_merge($this->request->getPost(), $postData);


            // Fetch dynamic validation rules and form fields
            $validationInfo = $this->buildValidationRules('subscription', $siteId);
            $validationRules = $validationInfo['rules'];
            $validationMessages = $validationInfo['messages'];
            $formFields = $validationInfo['form_fields'];

            // Ensure email is always present for subscription
            if (empty($allRequestData['email'])) {
                throw new Exception('Email is required for subscription.');
            }

            // Perform dynamic validation
            if (!$this->validate($validationRules, $validationMessages)) {
                $errors = $this->validator->getErrors();
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                session()->setFlashdata('errors', $errors);
                return redirect()->back()->withInput();
            }

            $email = $allRequestData['email'];

            // Prepare submission data based on allowed fields and form field definitions
            $submissionData = [
                'site_id'       => $siteId,
                'ip_address'    => getIPAddress(),
                'country'       => getCountry(),
                'list_name'     => $allRequestData['list_name'] ?? 'General Newsletter', // Can be set via hidden field or form settings
                'status'        => 'Pending Confirmation', // Default status
            ];

            foreach ($formFields as $field) {
                if (in_array($field['field_name'], $this->subscriptionFormsModel->allowedFields) && isset($allRequestData[$field['field_name']])) {
                    $submissionData[$field['field_name']] = $allRequestData[$field['field_name']];
                }
            }

            // Fill 'name' from 'first_name'/'last_name' if 'name' is not submitted
            if (!isset($submissionData['name']) && isset($submissionData['first_name'])) {
                 $submissionData['name'] = trim(($submissionData['first_name'] ?? '') . ' ' . ($submissionData['last_name'] ?? ''));
            }

            // Fetch form settings
            $formSettings = $this->formSettingsModel->getFormSettings('subscription', $siteId);

            // Check for existing subscriber (now using model methods)
            $existingSubscriber = $this->subscriptionFormsModel->where('site_id', $siteId)->where('email', $email)->first();

            if ($existingSubscriber) {
                // Update status if they were previously unsubscribed or pending
                if ($existingSubscriber['status'] !== 'Active') {
                    $this->subscriptionFormsModel->update($existingSubscriber['subscription_form_id'], [
                        'status' => 'Active',
                        'unsubscribed_at' => null, // Resubscribed
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                $subscriptionId = $existingSubscriber['subscription_form_id'];
                $message = 'You are already subscribed, or your subscription has been reactivated.';
                $activityType = ActivityTypes::SUBSCRIPTION_REACTIVATED;
                $logMessage = 'User re-subscribed/active with email: ' . $email;
            } else {
                // New subscription
                $submissionId = $this->subscriptionFormsModel->saveSubmission($submissionData);
                if (!$submissionId) {
                    throw new Exception('Failed to save subscription.');
                }
                $subscriptionId = $submissionId;
                $message = config('CustomConfig')->subscriptionSuccessful;
                $activityType = ActivityTypes::SUBSCRIPTION_FORM_SUBMISSION;
                $logMessage = 'User subscribed with email: ' . $email . ' (ID: ' . $subscriptionId . ')';

                // Handle double opt-in
                if (isset($formSettings['enable_double_opt_in']) && $formSettings['enable_double_opt_in'] == '1') {
                    $token = bin2hex(random_bytes(32)); // Generate a unique token
                    $this->subscriptionFormsModel->update($subscriptionId, ['confirmation_token' => $token, 'status' => 'Pending Confirmation']);

                    // Send confirmation email
                    $confirmationLink = base_url('services/confirm-subscription?identifier=' . $token); // TODO: You'd need a public route for this
                    $emailSubject = $formSettings['welcome_email_subject'] ?? 'Confirm Your Subscription';
                    $templateData = [
                        'preheader' => $emailSubject,
                        'greeting' => 'Almost There!',
                        'main_content' => '<p>Please click the link below to confirm your subscription:</p><p><a href="' . esc($confirmationLink) . '">Confirm Subscription</a></p>',
                        'cta_text' => 'Confirm Subscription',
                        'cta_url' => $confirmationLink,
                        'footer_text' => '',
                        'company_address' => getConfigData("CompanyAddress"),
                    ];
                    $this->emailService->send($email, $emailSubject, $templateData);
                    $message = 'Please check your email to confirm your subscription.';
                } else {
                    // No double opt-in, set to active immediately
                    $this->subscriptionFormsModel->update($subscriptionId, ['status' => 'Active', 'confirmed_at' => date('Y-m-d H:i:s')]);
                    // Send welcome email if configured
                    if (isset($formSettings['welcome_email_subject']) && $formSettings['welcome_email_subject']) {
                        $emailSubject = $formSettings['welcome_email_subject'];
                        $templateData = [
                            'preheader' => $emailSubject,
                            'greeting' => 'Welcome!',
                            'main_content' => '<p>Thank you for subscribing to our newsletter!</p>',
                            'cta_text' => '',
                            'cta_url' => '',
                            'footer_text' => '',
                            'company_address' => getConfigData("CompanyAddress"),
                        ];
                        $this->emailService->send($email, $emailSubject, $templateData);
                    }
                }
            }
            
            session()->setFlashdata('successAlert', $message);
            logActivity($email, $activityType, $logMessage);

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'message' => $message
            ]);

        } catch (Exception $e) {
            $email = $allRequestData['email'] ?? 'unknown@example.com';
            $subscriptionFailed = config('CustomConfig')->subscriptionFailed;
            session()->setFlashdata('errorAlert', $subscriptionFailed);

            logActivity($email, ActivityTypes::FAILED_SUBSCRIPTION_FORM_SUBMISSION, 'Failed to process subscription with email: ' . $email . '. Error: ' . $e->getMessage());

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to subscribe',
                'error' => $e->getMessage()
            ]);
        }
    }

    //############################//
    //          BOOKINGS          //
    //############################//
    public function addBooking()
    {
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        $returnUrl = $this->request->getPost('return_url');
        $siteId = $this->currentSiteId;

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // Fetch dynamic validation rules and form fields
            $validationInfo = $this->buildValidationRules('booking', $siteId);
            $validationRules = $validationInfo['rules'];
            $validationMessages = $validationInfo['messages'];
            $formFields = $validationInfo['form_fields'];

            // Perform dynamic validation
            if (!$this->validate($validationRules, $validationMessages)) {
                $errors = $this->validator->getErrors();
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                session()->setFlashdata('errors', $errors);
                return redirect()->back()->withInput();
            }

            // Prepare submission data based on allowed fields and form field definitions
            $submissionData = [
                'site_id'       => $siteId,
                'ip_address'    => getIPAddress(),
                'user_agent'    => getUserDevice(),
                'country'       => getCountry(),
                'form_name'     => $this->request->getPost('form_name') ?? 'General Booking',
                'status'        => 'Pending', // Default status
                'payment_status' => 'Unpaid', // Default payment status
            ];

            foreach ($formFields as $field) {
                if (in_array($field['field_name'], $this->bookingFormsModel->allowedFields)) {
                    $submissionData[$field['field_name']] = $this->request->getPost($field['field_name']);
                }
            }

            // Fill 'name' from 'first_name'/'last_name' if 'name' is not submitted
            if (!isset($submissionData['name']) && isset($submissionData['first_name'])) {
                 $submissionData['name'] = trim(($submissionData['first_name'] ?? '') . ' ' . ($submissionData['last_name'] ?? ''));
            }

            // Save the booking submission
            $submissionId = $this->bookingFormsModel->saveSubmission($submissionData);

            if (!$submissionId) {
                throw new Exception('Failed to save booking submission.');
            }

            // Record created successfully.
            $bookingSuccessful = config('CustomConfig')->bookingSuccessful;
            session()->setFlashdata('successAlert', $bookingSuccessful);

            // Log activity
            $fromEmail = $submissionData['email'] ?? 'unknown@example.com';
            logActivity($fromEmail, ActivityTypes::BOOKING_FORM_SUBMISSION, 'Booking made from user with email: ' . $fromEmail . ' (ID: ' . $submissionId . ')');

            // Fetch form settings for notifications and auto-confirm
            $formSettings = $this->formSettingsModel->getFormSettings('booking', $siteId);
            $companyName = getConfigData("CompanyName");
            $companyAddress = getConfigData("CompanyAddress");
            $subject = "New Booking"; // TODO: You might want a dynamic subject from settings

            // Send notification email to admin
            $this->sendNotificationEmail('booking', $formSettings, $subject, $submissionData, $companyName, $companyAddress);

            // Handle auto-confirmation
            if (isset($formSettings['auto_confirm']) && $formSettings['auto_confirm'] == '1') {
                $this->bookingFormsModel->update($submissionId, ['status' => 'Confirmed']);
                // Optionally send a confirmation email to the user
                $userEmailSubject = 'Your Booking Confirmation';
                $templateData = [
                    'preheader' => $userEmailSubject,
                    'greeting' => 'Booking Confirmed!',
                    'main_content' => '<p>Dear ' . esc($submissionData['name'] ?? 'Customer') . ',</p><p>Your booking for ' . esc($submissionData['appointment_date']) . ' at ' . esc($submissionData['appointment_time']) . ' has been confirmed.</p><p>Thank you!</p>',
                    'cta_text' => '',
                    'cta_url' => '',
                    'footer_text' => '',
                    'company_address' => getConfigData("CompanyAddress"),
                ];
                $this->emailService->send($submissionData['email'], $userEmailSubject, $templateData);
            }

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Booking made successfully']);

        } catch (Exception $e) {
            $fromEmail = $this->request->getPost('email') ?? 'unknown@example.com';
            $bookingFailed = config('CustomConfig')->bookingFailed;
            session()->setFlashdata('errorAlert', $bookingFailed);

            logActivity($fromEmail, ActivityTypes::FAILED_BOOKING_FORM_SUBMISSION, 'Failed to make booking from user with email: ' . $fromEmail . '. Error: ' . $e->getMessage());

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to make booking', 'error' => $e->getMessage()]);
        }
    }
}