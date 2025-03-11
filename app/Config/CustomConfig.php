<?php
// app/Config/CustomConfig.php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    #--------------------------------------------------------------------
    # SETTINGS
    #--------------------------------------------------------------------
    public $useCaptcha = "No";
    public $appApiKey = "default";
    //query limits
    public $queryLimitSingle = 1;
    public $queryLimitVeryLow = 3;
    public $queryLimitLow = 6;
    public $queryLimitMedium = 12;
    public $queryLimitDefault = 25;
    public $queryLimitHigh = 50;
    public $queryLimitVeryHigh = 100;
    public $queryLimitMax = 1000;
    public $queryLimitUltraMax = 10000;
    //paginations
    public $paginateVeryLow = 10;
    public $paginateLow = 20;
    public $paginateDefault = 50;
    public $paginateHigh = 100;
    public $paginateVeryHigh = 500;
    public $paginateMax = 1000;

    #--------------------------------------------------------------------
    # MESSAGES
    #--------------------------------------------------------------------
    public $wrongCredentialsMsg = 'Sign In Failed. The provided username/email or password is incorrect.';
    public $loginSuccessMsg = 'Login successful.';
    public $logoutSuccessMsg = 'You have been successfully logged out.';
    public $pendingActivationMsg = 'Your account has not been activated yet or is no longer active. Please contact the administrator.';
    public $tooManyFailedLogins = 'Too many failed login attempts. Your IP has been blocked for 1 hour.';
    public $invalidAccessMsg = 'You do not have access to this area.';
    public $createSuccessMsg = 'Record created successfully.';
    public $editSuccessMsg = 'Record updated successfully.';
    public $deleteSuccessMsg = 'Record removed successfully.';
    public $missingRequiredInputsMsg = 'There are validation errors. Possible missing required inputs.';
    public $sentContactMsg = 'Message sent successfully.';
    public $failedContactMsg = 'Form submission failed.';
    public $notFoundMsg = 'Record not found.';
    public $alreadyExistMsg = '[Record] already exists in table.';
    public $errorMsg = 'Oops! Something went wrong. Please try again later.';
    public $resetLinkMsg = 'A password reset link has been sent to your email address. Please check your inbox and follow the instructions to reset your password. If you do not see the email in your inbox, please check your spam or junk folder.';
    public $invalidResetLinkMsg = 'Invalid or expired password reset link.';
    public $passwordResetRequiredMsg = 'For security reasons, you need to change your password before continuing. Your current password was either set by an administrator or is a default password.';
    public $passwordResetSuccessfulMsg = 'Your password has been reset successfully. You can now log in with your new password.';
    public $passwordResetFailedMsg = 'Unable to reset password. Please try again';
    public $nonExistingResetEmailMsg = 'We are sorry, but the email address you entered is not associated with any account. Please check the email address and try again.';
    public $exceptionMsg = 'There was an error processing your request. Please try again. If this error persists, please see or send an email to system administrator.';
    public $contactMessageSuccessful = 'Your message has been sent successfully.';
    public $contactMessageFailed = 'Oops! Something went wrong with your message submission. Please try again later.';
    public $subscriptionSuccessful = 'You have successfully subscribed!';
    public $subscriptionFailed = 'Sorry, something went wrong with your subscription. Please try again.';
}