<?php

declare(strict_types=1);

namespace App\Services;

use Mailjet\Resources;
use Mailjet\Client as MailjetClient;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Mailgun\Mailgun;
use SendGrid;
use SendGrid\Mail\Mail;
use Postmark\PostmarkClient;

/**
 * EmailService handles sending different types of emails using various providers.
 */
final class EmailService
{
    private string $emailConfigType;
    private mixed $client;

    /**
     * Constructor initializes the email service based on configuration.
     * @throws \Exception If an invalid email provider is configured.
     */
    public function __construct()
    {
        $this->emailConfigType = getConfigData("EmailConfigType");

        switch ($this->emailConfigType) {
            case 'Mailjet':
                $this->client = new MailjetClient(getConfigData("MailjetApiKey"), getConfigData("MailjetApiSecret"), true, ['version' => 'v3.1']);
                break;
            case 'SMTP':
                $this->client = new PHPMailer(true);
                break;
            case 'Mailgun':
                $this->client = Mailgun::create(getConfigData("MailgunApiKey"));
                break;
            case 'SendGrid':
                $this->client = new SendGrid(getConfigData("SendGridApiKey"));
                break;
            case 'Postmark':
                $this->client = new PostmarkClient(getConfigData("PostmarkApiToken"));
                break;
            default:
                throw new \Exception("Invalid email configuration type.");
        }
    }

    /**
     * Sends an HTML email.
     * @param string $to Recipient email address.
     * @param string $name Recipient name.
     * @param string $subject Email subject.
     * @param array $templateData Data for the email template.
     * @param string $from Sender email (optional).
     * @return bool True if the email was sent successfully, false otherwise.
     */
    public function sendHtmlEmail(string $to, string $name, string $subject, array $templateData, string $from = 'example@mail.com'): bool
    {
        $htmlContent = $this->generateHtmlContent($templateData);
        return $this->sendEmail($to, $name, $subject, $htmlContent, strip_tags($htmlContent), $from);
    }

    /**
     * Sends a password recovery email.
     * @param string $toEmail Recipient email address.
     * @param string $toName Recipient name.
     * @param string $subject Email subject.
     * @param array $templateData Email template data.
     * @param string $from Sender email.
     * @return bool True on success, false on failure.
     */
    public function sendPasswordRecoveryHtmlEmail(string $toEmail, string $toName, string $subject, array $templateData, string $from = 'example@mail.com'): bool
    {
        return $this->sendHtmlEmail($toEmail, $toName, $subject, $templateData, $from);
    }

    /**
     * Sends an email using the configured provider.
     * @param string $to Recipient email.
     * @param string $name Recipient name.
     * @param string $subject Email subject.
     * @param string $htmlContent HTML body content.
     * @param string $textContent Plain text alternative.
     * @param string $from Sender email.
     * @return bool True on success, false on failure.
     */
    private function sendEmail(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        return match ($this->emailConfigType) {
            'Mailjet' => $this->sendViaMailjet($to, $name, $subject, $htmlContent, $textContent, $from),
            'SMTP' => $this->sendViaSMTP($to, $name, $subject, $htmlContent, $textContent, $from),
            'Mailgun' => $this->sendViaMailgun($to, $subject, $htmlContent, $textContent, $from),
            'SendGrid' => $this->sendViaSendGrid($to, $name, $subject, $htmlContent, $textContent, $from),
            'Postmark' => $this->sendViaPostmark($to, $name, $subject, $htmlContent, $textContent, $from),
            default => false,
        };
    }

    /**
     * Generates the HTML email content based on a template.
     * @param array $data Email template placeholders.
     * @return string The generated HTML email content.
     */
    private function generateHtmlContent(array $data): string
    {
        $template = file_get_contents(APPPATH . 'Views/back-end/emails/template.php');

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
