<?php

namespace App\Libraries;

use Config\Services;

/**
 * EmailService
 * A reusable service for sending emails using CodeIgniter's built-in email class.
 */
class EmailService
{
    /**
     * Sends an email using configured SMTP settings with error handling.
     *
     * @param string $to         Recipient email address.
     * @param string $subject    Subject of the email.
     * @param array  $message    Data array for the email template.
     * @param string|null $fromEmail Optional sender email address.
     * @param string|null $fromName  Optional sender name.
     *
     * @return bool|string True if email sent successfully, or error message string on failure.
     */
    public function send($to, $subject, $message, $fromEmail = null, $fromName = null)
    {
        try {
            // Get the email service instance from CodeIgniter
            $email = Services::email();

            // If custom sender details are provided, override the defaults
            if ($fromEmail && $fromName) {
                $email->setFrom($fromEmail, $fromName);
            }

            // Set recipient, subject, and message
            $htmlContent = $this->generateHtmlContent($message);
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($htmlContent);

            // Attempt to send the email
            if (!$email->send()) {
                // Return detailed error info if sending fails
                return $email->printDebugger(['headers']);
            }

            return true;
        } catch (\Exception $e) {
            // Catch any unexpected exceptions and return the error message
            log_message('error', 'Failed to send email: ' . $e->getMessage());
            return false;
        }
    }


    /**
     * Generates an HTML email body by injecting dynamic content into a predefined template.
     *
     * @param array $data Associative array containing keys for template placeholders:
     *                    - subject: string
     *                    - preheader: string
     *                    - greeting: string
     *                    - main_content: string
     *                    - cta_text: string
     *                    - cta_url: string
     *                    - footer_text: string
     *                    - company_address: string
     *                    - unsubscribe_url: string
     *
     * @return string The final HTML content with placeholders replaced.
     *
     * @throws \Exception If the email template file is not found.
     */

    private function generateHtmlContent(array $data): string
    {
        $templatePath = APPPATH . 'Views/back-end/emails/template.php';
        if (!file_exists($templatePath)) {
            throw new \Exception('Email template not found at: ' . $templatePath);
        }
        $template = file_get_contents($templatePath);

        $placeholders = [
            '{{SUBJECT}}' => $data['subject'] ?? '',
            '{{PREHEADER}}' => $data['preheader'] ?? '',
            '{{GREETING}}' => $data['greeting'] ?? 'Hi there',
            '{{MAIN_CONTENT}}' => $data['main_content'] ?? '',
            '{{CTA_TEXT}}' => $data['cta_text'] ?? 'Call To Action',
            '{{CTA_URL}}' => $data['cta_url'] ?? '#',
            '{{CTA_DISPLAY}}' =>  !empty($data['cta_url']) ? "block" : "none",
            '{{FOOTER_TEXT}}' => $data['footer_text'] ?? '',
            '{{COMPANY_ADDRESS}}' => $data['company_address'] ?? 'Company Inc',
            '{{UNSUBSCRIBE_URL}}' => $data['unsubscribe_url'] ?? '#'
        ];

        return str_replace(array_keys($placeholders), array_values($placeholders), $template);
    }
}
