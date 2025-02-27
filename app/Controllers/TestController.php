<?php

namespace App\Controllers;

use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use App\Models\FileUploadModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\EmailService;

class TestController extends BaseController
{
    private EmailService $emailService;

    public function __construct()
    {
        $this->emailService = new EmailService();
    }

    public function index()
    {
        return view('front-end/test/index');
    }

    public function uploadFile()
    {
        $dateToday = date('d-m-Y');
        $savePath = 'public/uploads/file-uploads/test/' .$dateToday;
        $file = $this->request->getFile('upload_file');

        if(isAllowedFileExtension($file)){
            //upload file
            $fileUploaded = uploadFile($file, $savePath);
            session()->setFlashdata('successAlert', "File (".$fileUploaded.") uploaded successfully");
        }
        else{
            session()->setFlashdata('errorAlert', "Failed to upload file. Invalid file extension");
        }

        return redirect()->to('test');
    }

    public function sendWelcomeEmail()
    {
        $fromEmail = "kassamadeveloper@gmail.com";//getConfigData("CompanyEmail", config('CustomConfig')->companyEmail);
        $to = 'abdoulie.s.kassama@gmail.com';
        $name = "Your Name";
        $subject = 'Welcome to Our Application';

        $templateData = [
            'preheader' => 'Welcome to our application!',
            'greeting' => 'Welcome aboard!',
            'main_content' => "We're excited to have you join our community. Here's what you can do next...",
            'cta_text' => 'Get Started',
            'cta_url' => 'https://yourapplication.com/get-started',
            'footer_text' => 'If you have any questions, just reply to this email.',
            'company_address' => 'Your Company, 123 Main St, Anytown, AN 12345',
            'unsubscribe_url' => 'https://yourapplication.com/unsubscribe'
        ];

        $result = $this->emailService->sendHtmlEmail($to, $name, $subject, $templateData, $fromEmail);

        if ($result) {
            return $this->response->setJSON(['message' => 'Welcome email sent successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to send welcome email']);
        }
    }

    public function sendWelcomeEmailPlain()
    {
        $fromEmail = "kassamadeveloper@gmail.com";//getConfigData("CompanyEmail");
        $to = 'abdoulie.s.kassama@gmail.com';
        $subject = 'Welcome to Our Application';
        $body = 'Thank you for joining our application!';

        $result = $this->emailService->sendEmail($to, $subject, $body, $fromEmail);

        if ($result) {
            return $this->response->setJSON(['message' => 'Email sent successfully']);
        } else {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Failed to send email']);
        }
    }

}