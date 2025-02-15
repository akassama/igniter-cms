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
 * The EmailService class handles sending different types of emails using multiple providers.
 */
final class EmailService
{
    private string $emailConfigType;
    private mixed $client;

    public function __construct()
    {        
        $this->emailConfigType = getConfigData("EmailConfigType");

        switch ($this->emailConfigType) {
            case 'Mailjet':
                $mailjetApiKey = getConfigData("MailjetApiKey");
                $mailjetApiSecret = getConfigData("MailjetApiSecret");
                $this->client = new MailjetClient($mailjetApiKey, $mailjetApiSecret, true, ['version' => 'v3.1']);
                break;

            case 'SMTP':
                $this->client = new PHPMailer(true);
                break;

            case 'Mailgun':
                $mailgunApiKey = getConfigData("MailgunApiKey");
                $this->client = Mailgun::create($mailgunApiKey);
                break;

            case 'SendGrid':
                $sendGridApiKey = getConfigData("SendGridApiKey");
                $this->client = new SendGrid($sendGridApiKey);
                break;

            case 'Postmark':
                $postmarkApiToken = getConfigData("PostmarkApiToken");
                $this->client = new PostmarkClient($postmarkApiToken);
                break;

            default:
                throw new \Exception("Invalid email configuration type.");
        }
    }

    public function sendHtmlEmail(string $to, string $name, string $subject, array $templateData, string $from = 'example@mail.com'): bool
    {
        $htmlContent = $this->generateHtmlContent($templateData);
        return $this->sendEmail($to, $name, $subject, $htmlContent, strip_tags($htmlContent), $from);
    }

    public function sendPasswordRecoveryHtmlEmail(string $toEmail, string $toName, string $subject, array $templateData, string $from = 'example@mail.com'): bool
    {
        $htmlContent = $this->generateHtmlContent($templateData);
        return $this->sendEmail($toEmail, $toName, $subject, $htmlContent, strip_tags($htmlContent), $from);
    }

    private function sendEmail(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        switch ($this->emailConfigType) {
            case 'Mailjet':
                return $this->sendViaMailjet($to, $name, $subject, $htmlContent, $textContent, $from);
            case 'SMTP':
                return $this->sendViaSMTP($to, $name, $subject, $htmlContent, $textContent, $from);
            case 'Mailgun':
                return $this->sendViaMailgun($to, $subject, $htmlContent, $textContent, $from);
            case 'SendGrid':
                return $this->sendViaSendGrid($to, $name, $subject, $htmlContent, $textContent, $from);
            case 'Postmark':
                return $this->sendViaPostmark($to, $name, $subject, $htmlContent, $textContent, $from);
            default:
                return false;
        }
    }

    private function sendViaMailjet(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        $body = [
            'Messages' => [
                [
                    'From' => ['Email' => $from, 'Name' => $name],
                    'To' => [['Email' => $to]],
                    'Subject' => $subject,
                    'HTMLPart' => $htmlContent,
                    'TextPart' => $textContent
                ]
            ]
        ];

        $response = $this->client->post(Resources::$Email, ['body' => $body]);
        return $response->success();
    }

    private function sendViaSMTP(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        try {
            $this->client->isSMTP();
            $this->client->Host = getConfigData("SMTPHost");
            $this->client->SMTPAuth = true;
            $this->client->Username = getConfigData("SMTPUsername");
            $this->client->Password = getConfigData("SMTPPassword");
            $this->client->SMTPSecure = getConfigData("SMTPEncryption");
            $this->client->Port = (int)getConfigData("SMTPPort");

            $this->client->setFrom($from, $name);
            $this->client->addAddress($to);

            $this->client->isHTML(true);
            $this->client->Subject = $subject;
            $this->client->Body = $htmlContent;
            $this->client->AltBody = $textContent;

            return $this->client->send();
        } catch (Exception $e) {
            return false;
        }
    }

    private function sendViaMailgun(string $to, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        $mailgunDomain = getConfigData("MailgunDomain");

        try {
            $this->client->messages()->send($mailgunDomain, [
                'from' => $from,
                'to' => $to,
                'subject' => $subject,
                'html' => $htmlContent,
                'text' => $textContent
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function sendViaSendGrid(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        try {
            $email = new Mail();
            $email->setFrom($from, $name);
            $email->setSubject($subject);
            $email->addTo($to);
            $email->addContent("text/plain", $textContent);
            $email->addContent("text/html", $htmlContent);

            $response = $this->client->send($email);
            return $response->statusCode() >= 200 && $response->statusCode() < 300;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function sendViaPostmark(string $to, string $name, string $subject, string $htmlContent, string $textContent, string $from): bool
    {
        try {
            $response = $this->client->sendEmail([
                'From' => $from,
                'To' => $to,
                'Subject' => $subject,
                'HtmlBody' => $htmlContent,
                'TextBody' => $textContent
            ]);
            return $response['ErrorCode'] === 0;
        } catch (\Exception $e) {
            return false;
        }
    }

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
