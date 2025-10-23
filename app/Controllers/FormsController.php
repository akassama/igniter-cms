<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BookingFormsModel;
use App\Models\ContactFormsModel;
use App\Models\SubscriptionFormsModel;
use App\Libraries\EmailService;
use Exception; // Ensure Exception is imported

class APIFormController extends BaseController
{
    protected $emailService;
    protected $contactFormsModel;
    protected $bookingFormsModel;
    protected $subscriptionFormsModel;
    protected $currentSiteId; // Will be determined dynamically

    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->contactFormsModel = new ContactFormsModel();
        $this->bookingFormsModel = new BookingFormsModel();
        $this->subscriptionFormsModel = new SubscriptionFormsModel();

        // Determine current site ID dynamically.
        // For a simpler setup, you might hardcode it to '1' or retrieve from a global config.
        // For production, consider using a site detection mechanism (e.g., from request, database).
        $this->currentSiteId = 1; // Placeholder: Replace with actual site ID logic
    }

    /**
     * Common method to validate honeypot and hCaptcha.
     * Throws an exception if validation fails.
     *
     * @param string $honeypotInput The honeypot field value.
     * @param string $submittedTimestamp The honeypot timestamp value.
     * @return void
     * @throws Exception If honeypot or hCaptcha validation fails.
     */
    private function preValidateForm(string $honeypotInput, string $submittedTimestamp)
    {
        // Honeypot validator
        validateHoneypotInput($honeypotInput, $submittedTimestamp);

        // hCaptcha validation
        $captchaValidation = validateHcaptcha();
        if ($captchaValidation !== true) {
            throw new Exception($captchaValidation); // $captchaValidation contains the error message
        }
    }

    /**
     * Common method to build email content for notifications.
     *
     * @param array $submissionData The data submitted by the form.
     * @param string $formType The type of form (e.g., 'Contact', 'Booking', 'Subscription').
     * @param array $excludeFields Fields to exclude from the email content.
     * @return string HTML content for the email body.
     */
    private function buildNotificationEmailContent(array $submissionData, string $formType, array $excludeFields = []): string
    {
        $content = '<h4>New ' . esc($formType) . ' Form Submission:</h4>';
        $content .= '<table cellpadding="5" cellspacing="0" border="1" style="width:100%; border-collapse: collapse;">';
        foreach ($submissionData as $key => $value) {
            if (in_array($key, $excludeFields)) {
                continue; // Skip excluded fields
            }
            $label = ucwords(str_replace('_', ' ', $key));
            $displayValue = is_array($value) ? implode(', ', $value) : $value;
            $content .= '<tr><td style="width:30%;"><strong>' . esc($label) . ':</strong></td><td>' . esc($displayValue) . '</td></tr>';
        }
        $content .= '</table>';
        return $content;
    }

    //############################//
    //      CONTACT MESSAGES      //
    //############################//
    public function sendContactMessage()
    {
        $honeypotInput = $this->request->getPost(getConfigData("HoneypotKey"));
        $submittedTimestamp = $this->request->getPost(getConfigData("TimestampKey"));
        $returnUrl = $this->request->getPost('return_url') ?? base_url();
        $siteId = $this->currentSiteId;

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // Define validation rules for Contact Form
            $rules = [
                'name'    => 'permit_empty|max_length[255]',
                'email'   => 'required|valid_email|max_length[255]',
                'phone'   => 'permit_empty|max_length[50]',
                'subject' => 'permit_empty|max_length[255]',
                'message' => 'required|max_length[1000]',
                'company' => 'permit_empty|max_length[255]',
                'website' => 'permit_empty|valid_url_strict|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                $errors = $this->validator->getErrors();
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                session()->setFlashdata('errors', $errors);
                return redirect()->to($returnUrl)->withInput();
            }

            // Prepare data for ContactFormsModel
            $submissionData = [
                'site_id'         => $siteId,
                'form_name'       => $this->request->getPost('form_name') ?? 'General Contact',
                'name'            => $this->request->getPost('name'),
                'email'           => $this->request->getPost('email'),
                'phone'           => $this->request->getPost('phone'),
                'subject'         => $this->request->getPost('subject'),
                'message'         => $this->request->getPost('message'),
                'company'         => $this->request->getPost('company'),
                'website'         => $this->request->getPost('website'),
                'ip_address'      => getIPAddress(),
                'country'         => getCountry(),
                'user_agent'      => getUserDevice(),
                'referrer'        => $this->request->getPost('referrer') ?? $_SERVER['HTTP_REFERER'] ?? null,
                'is_read'         => 0,
                'is_archived'     => 0,
                'status'          => 'New',
                'notes'           => null,
                'last_updated_by' => null,
            ];

            $submissionId = $this->contactFormsModel->createContactFormSubmission($submissionData); // Assuming this returns the GUID

            if (!$submissionId) {
                throw new Exception('Failed to save contact form submission.');
            }

            $contactMessageSuccessful = config('CustomConfig')->contactMessageSuccessful;
            session()->setFlashdata('successAlert', $contactMessageSuccessful);

            $fromEmail = $submissionData['email'];
            $subject = $submissionData['subject'] ?? "New Contact Message";
            logActivity($fromEmail, ActivityTypes::CONTACT_FORM_SUBMISSION, 'Contact message sent from user with email: ' . $fromEmail . ' (ID: ' . $submissionId . ')');

            // Send notification email based on .env settings
            if (filter_var(env('FORWARD_CONTACT_EMAIL', false), FILTER_VALIDATE_BOOLEAN)) {
                $toEmail = env('FORWARD_CONTACT_EMAIL_TO', getConfigData("CompanyEmail")); // Fallback to CompanyEmail
                $companyName = getConfigData("CompanyName");
                $companyAddress = getConfigData("CompanyAddress");

                $emailContent = $this->buildNotificationEmailContent(
                    $submissionData,
                    'Contact',
                    ['site_id', 'contact_form_id', 'ip_address', 'user_agent', 'referrer', 'is_read', 'is_archived', 'status', 'notes', 'last_updated_by', 'created_at', 'updated_at', 'form_name']
                );

                $templateData = [
                    'preheader'       => $subject,
                    'greeting'        => 'New Contact Message',
                    'main_content'    => $emailContent,
                    'cta_text'        => '',
                    'cta_url'         => '',
                    'footer_text'     => 'Sent from <a href="' . base_url() . '">' . $companyName . '</a>',
                    'company_address' => $companyAddress,
                    'unsubscribe_url' => base_url('/unsubscribe/' . $toEmail) // Use the notification email for unsubscribe
                ];
                $this->emailService->send($toEmail, $subject, $templateData);
            }

            if (!empty($returnUrl)) {
                return redirect()->to($returnUrl);
            }
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Form submitted successfully']);

        } catch (Exception $e) {
            $fromEmail = $this->request->getPost('email') ?? 'unknown@example.com';
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
        $returnUrl = $this->request->getPost('return_url') ?? base_url();
        $siteId = $this->currentSiteId;

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // Handle both JSON and regular POST data
            $requestBody = $this->request->getBody();
            $postData = json_decode($requestBody, true) ?? [];
            $allRequestData = array_merge($this->request->getPost(), $postData);

            // Define validation rules for Subscription Form
            $rules = [
                'email'      => 'required|valid_email|max_length[255]',
                'name'       => 'permit_empty|max_length[255]',
                'first_name' => 'permit_empty|max_length[100]',
                'last_name'  => 'permit_empty|max_length[100]',
                'phone'      => 'permit_empty|max_length[50]',
                'source'     => 'permit_empty|max_length[255]',
                'form_name'  => 'permit_empty|max_length[255]',
            ];

            if (!$this->validate($rules, [], $allRequestData)) { // Pass $allRequestData for validation
                $errors = $this->validator->getErrors();
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                session()->setFlashdata('errors', $errors);
                return redirect()->to($returnUrl)->withInput();
            }

            $email = $allRequestData['email'];

            // Prepare data for SubscriptionFormsModel
            $submissionData = [
                'site_id'         => $siteId,
                'form_name'       => $allRequestData['form_name'] ?? 'Newsletter Subscription',
                'email'           => $email,
                'name'            => $allRequestData['name'],
                'first_name'      => $allRequestData['first_name'],
                'last_name'       => $allRequestData['last_name'],
                'phone'           => $allRequestData['phone'],
                'source'          => $allRequestData['source'],
                'status'          => 'Pending Confirmation', // Default
                'unsubscribed_at' => null,
                'ip_address'      => getIPAddress(),
                'country'         => getCountry(),
                'last_updated_by' => null,
            ];

            // Fill 'name' from 'first_name'/'last_name' if 'name' is empty
            if (empty($submissionData['name']) && (!empty($submissionData['first_name']) || !empty($submissionData['last_name']))) {
                $submissionData['name'] = trim(($submissionData['first_name'] ?? '') . ' ' . ($submissionData['last_name'] ?? ''));
            }

            // Check for existing subscriber
            $existingSubscriber = $this->subscriptionFormsModel->where('site_id', $siteId)->where('email', $email)->first();

            $message = '';
            $activityType = '';
            $logMessage = '';
            $subscriptionId = null;

            if ($existingSubscriber) {
                // If existing, update status if not active
                if ($existingSubscriber['status'] !== 'Active') {
                    $this->subscriptionFormsModel->update($existingSubscriber['subscription_form_id'], [
                        'status'          => 'Active',
                        'unsubscribed_at' => null, // Resubscribed
                        'updated_at'      => date('Y-m-d H:i:s'),
                        'ip_address'      => getIPAddress(),
                        'country'         => getCountry(),
                    ]);
                    $message      = 'You have been re-subscribed successfully.';
                    $activityType = ActivityTypes::SUBSCRIPTION_REACTIVATED;
                    $logMessage   = 'User re-subscribed with email: ' . $email;
                } else {
                    $message      = 'You are already subscribed.';
                    $activityType = ActivityTypes::SUBSCRIPTION_FORM_SUBMISSION; // Still a submission
                    $logMessage   = 'User tried to subscribe but is already active with email: ' . $email;
                }
                $subscriptionId = $existingSubscriber['subscription_form_id'];
            } else {
                // New subscription
                $submissionId = $this->subscriptionFormsModel->createSubscriptionSubmission($submissionData); // Assuming this returns the GUID
                if (!$submissionId) {
                    throw new Exception('Failed to save subscription.');
                }
                $subscriptionId = $submissionId;
                $message      = config('CustomConfig')->subscriptionSuccessful;
                $activityType = ActivityTypes::SUBSCRIPTION_FORM_SUBMISSION;
                $logMessage   = 'User subscribed with email: ' . $email . ' (ID: ' . $subscriptionId . ')';

                // Implement double opt-in logic (as per original requirements, not specific to .env settings)
                // For simplicity, let's assume double opt-in is always preferred for public subscription forms
                $token = bin2hex(random_bytes(32)); // Generate a unique token
                $this->subscriptionFormsModel->update($subscriptionId, ['confirmation_token' => $token, 'status' => 'Pending Confirmation']);

                // Send confirmation email
                $confirmationLink = base_url('services/subscribe?identifier=' . urlencode($token)); // Use your actual confirm route
                $emailSubject = 'Confirm Your Subscription to ' . getConfigData("CompanyName");
                $templateData = [
                    'preheader'       => $emailSubject,
                    'greeting'        => 'Almost There!',
                    'main_content'    => '<p>Please click the link below to confirm your subscription:</p><p><a href="' . esc($confirmationLink) . '">Confirm Subscription</a></p>',
                    'cta_text'        => 'Confirm Subscription',
                    'cta_url'         => $confirmationLink,
                    'footer_text'     => 'Sent from <a href="' . base_url() . '">' . getConfigData("CompanyName") . '</a>',
                    'company_address' => getConfigData("CompanyAddress"),
                    'unsubscribe_url' => base_url('/services/unsubscribe?identifier=' . urlencode($email))
                ];
                $this->emailService->send($email, $emailSubject, $templateData);
                $message = 'Please check your email to confirm your subscription.';
            }

            session()->setFlashdata('successAlert', $message);
            logActivity($email, $activityType, $logMessage);

            // Send notification email to admin based on .env settings
            if (filter_var(env('FORWARD_SUBSCRIPTION_EMAIL', false), FILTER_VALIDATE_BOOLEAN)) {
                $toEmail = env('FORWARD_SUBSCRIPTION_EMAIL_TO', getConfigData("CompanyEmail"));
                $companyName = getConfigData("CompanyName");
                $companyAddress = getConfigData("CompanyAddress");

                $emailContent = $this->buildNotificationEmailContent(
                    $submissionData,
                    'Subscription',
                    ['site_id', 'subscription_form_id', 'ip_address', 'confirmation_token', 'confirmed_at', 'unsubscribed_at', 'last_updated_by', 'created_at', 'updated_at']
                );

                $templateData = [
                    'preheader'       => 'New Subscription',
                    'greeting'        => 'New Subscription Received',
                    'main_content'    => $emailContent,
                    'cta_text'        => '',
                    'cta_url'         => '',
                    'footer_text'     => 'Sent from <a href="' . base_url() . '">' . $companyName . '</a>',
                    'company_address' => $companyAddress,
                    'unsubscribe_url' => base_url('/unsubscribe/' . $toEmail)
                ];
                $this->emailService->send($toEmail, 'New Subscription Received', $templateData);
            }

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
        $returnUrl = $this->request->getPost('return_url') ?? base_url();
        $siteId = $this->currentSiteId;

        try {
            $this->preValidateForm($honeypotInput, $submittedTimestamp);

            // Define validation rules for Booking Form
            $rules = [
                'name'              => 'permit_empty|max_length[255]',
                'first_name'        => 'permit_empty|max_length[100]',
                'last_name'         => 'permit_empty|max_length[100]',
                'email'             => 'required|valid_email|max_length[255]',
                'phone'             => 'permit_empty|max_length[50]',
                'service_id'        => 'permit_empty|integer',
                'service_name'      => 'permit_empty|max_length[255]',
                'appointment_date'  => 'required|valid_date',
                'appointment_time'  => 'permit_empty', // Add more specific time validation if needed
                'duration'          => 'permit_empty|integer',
                'number_of_attendees' => 'permit_empty|integer',
                'message'           => 'permit_empty|max_length[1000]',
                'resource_id'       => 'permit_empty|integer',
                'resource_name'     => 'permit_empty|max_length[255]',
                'form_name'         => 'permit_empty|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                $errors = $this->validator->getErrors();
                if ($this->request->isAJAX()) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $errors
                    ]);
                }
                session()->setFlashdata('errors', $errors);
                return redirect()->to($returnUrl)->withInput();
            }

            // Prepare data for BookingFormsModel
            $submissionData = [
                'site_id'             => $siteId,
                'form_name'           => $this->request->getPost('form_name') ?? 'General Booking',
                'name'                => $this->request->getPost('name'),
                'first_name'          => $this->request->getPost('first_name'),
                'last_name'           => $this->request->getPost('last_name'),
                'email'               => $this->request->getPost('email'),
                'phone'               => $this->request->getPost('phone'),
                'service_id'          => $this->request->getPost('service_id'),
                'service_name'        => $this->request->getPost('service_name'),
                'appointment_date'    => $this->request->getPost('appointment_date'),
                'appointment_time'    => $this->request->getPost('appointment_time'),
                'duration'            => $this->request->getPost('duration'),
                'number_of_attendees' => $this->request->getPost('number_of_attendees'),
                'message'             => $this->request->getPost('message'),
                'status'              => 'Pending', // Default
                'confirmation_code'   => null,
                'notes'               => null,
                'resource_id'         => $this->request->getPost('resource_id'),
                'resource_name'       => $this->request->getPost('resource_name'),
                'payment_status'      => 'None', // Default
                'payment_amount'      => null,
                'ip_address'          => getIPAddress(),
                'country'             => getCountry(),
                'last_updated_by'     => null,
            ];

            // Fill 'name' from 'first_name'/'last_name' if 'name' is empty
            if (empty($submissionData['name']) && (!empty($submissionData['first_name']) || !empty($submissionData['last_name']))) {
                $submissionData['name'] = trim(($submissionData['first_name'] ?? '') . ' ' . ($submissionData['last_name'] ?? ''));
            }

            $submissionId = $this->bookingFormsModel->createBookingSubmission($submissionData); // Assuming this returns the GUID

            if (!$submissionId) {
                throw new Exception('Failed to save booking submission.');
            }

            $bookingSuccessful = config('CustomConfig')->bookingSuccessful;
            session()->setFlashdata('successAlert', $bookingSuccessful);

            $fromEmail = $submissionData['email'];
            logActivity($fromEmail, ActivityTypes::BOOKING_FORM_SUBMISSION, 'Booking made from user with email: ' . $fromEmail . ' (ID: ' . $submissionId . ')');

            // Send notification email based on .env settings
            if (filter_var(env('FORWARD_BOOKING_EMAIL', false), FILTER_VALIDATE_BOOLEAN)) {
                $toEmail = env('FORWARD_BOOKING_EMAIL_TO', getConfigData("CompanyEmail"));
                $companyName = getConfigData("CompanyName");
                $companyAddress = getConfigData("CompanyAddress");
                $subject = "New Booking Request";

                $emailContent = $this->buildNotificationEmailContent(
                    $submissionData,
                    'Booking',
                    ['site_id', 'booking_form_id', 'ip_address', 'country', 'status', 'confirmation_code', 'notes', 'payment_status', 'payment_amount', 'last_updated_by', 'created_at', 'updated_at', 'form_name']
                );

                $templateData = [
                    'preheader'       => $subject,
                    'greeting'        => 'New Booking Received',
                    'main_content'    => $emailContent,
                    'cta_text'        => '',
                    'cta_url'         => '',
                    'footer_text'     => 'Sent from <a href="' . base_url() . '">' . $companyName . '</a>',
                    'company_address' => $companyAddress,
                    'unsubscribe_url' => base_url('/unsubscribe/' . $toEmail)
                ];
                $this->emailService->send($toEmail, $subject, $templateData);
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