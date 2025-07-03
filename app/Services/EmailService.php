<?php

declare(strict_types=1);

namespace App\Services;

use Mailjet\Client;
use Mailjet\Resources;

/**
 * The EmailService class handles sending different types of emails using Mailjet provider.
 */
final class EmailService
{
    private $mailjet;

    public function __construct()
    {
        // Initialize Mailjet client with API key and secret from .env
        $apiKey = env('MAILJET_API_KEY', '');
        $secretKey = env('MAILJET_SECRET_KEY', '');
        if (empty($apiKey) || empty($secretKey)) {
            throw new \Exception('Mailjet API key or secret key is not configured.');
        }
        $this->mailjet = new Client($apiKey, $secretKey, true, ['version' => 'v3.1']);
    }

    public function sendHtmlEmail(string $to, string $name, string $subject, array $templateData, string $from): bool
    {
        $from = env("EMAIL_FROM");
        $htmlContent = $this->generateHtmlContent($templateData);
        return $this->sendEmail($to, $name, $subject, $htmlContent, strip_tags($htmlContent), $from);
    }

    public function sendPasswordRecoveryHtmlEmail(string $toEmail, string $toName, string $subject, array $templateData, string $from): bool
    {
        $from = env("EMAIL_FROM");
        $htmlContent = $this->generateHtmlContent($templateData);
        return $this->sendEmail($toEmail, $toName, $subject, $htmlContent, strip_tags($htmlContent), $from);
    }

    private function sendEmail(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        if (empty($to) || empty($subject) || empty($from)) {
            log_message('error', 'Invalid email parameters: to, subject, or from is empty.');
            return false;
        }

        try {
            // Parse the from field to extract name and email (e.g., "Test Company <onboarding@test.yourdomain.com>")
            preg_match('/^(.*)<(.*)>$/', $from, $matches);
            $fromName = trim($matches[1] ?? '') ?: 'Default Sender';
            $fromEmail = trim($matches[2] ?? $from);

            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => $fromEmail,
                            'Name' => $fromName,
                        ],
                        'To' => [
                            [
                                'Email' => $to,
                                'Name' => $name,
                            ],
                        ],
                        'Subject' => $subject,
                        'TextPart' => $textContent,
                        'HTMLPart' => $htmlContent,
                    ],
                ],
            ];

            $response = $this->mailjet->post(Resources::$Email, ['body' => $body]);

            if ($response->success()) {
                log_message('info', 'Email sent successfully to: ' . $to);
                return true;
            } else {
                log_message('error', 'Failed to send email via Mailjet: ' . json_encode($response->getData()));
                return false;
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to send email via Mailjet: ' . $e->getMessage());
            return false;
        }
    }

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
            '{{FOOTER_TEXT}}' => $data['footer_text'] ?? '',
            '{{COMPANY_ADDRESS}}' => $data['company_address'] ?? 'Company Inc',
            '{{UNSUBSCRIBE_URL}}' => $data['unsubscribe_url'] ?? '#'
        ];

        return str_replace(array_keys($placeholders), array_values($placeholders), $template);
    }
}