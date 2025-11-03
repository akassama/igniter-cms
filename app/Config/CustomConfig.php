<?php
// app/Config/CustomConfig.php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class CustomConfig extends BaseConfig
{
    #--------------------------------------------------------------------
    # MESSAGES
    #--------------------------------------------------------------------
    public $wrongCredentialsMsg = 'Sign In Failed. The provided username/email or password is incorrect.';
    public $loginSuccessMsg = 'Login successful.';
    public $logoutSuccessMsg = 'You have been successfully logged out.';
    public $pendingActivationMsg = 'Your account has not been activated yet or is no longer active. Please contact the administrator.';
    public $tooManyFailedLogins = 'Too many failed login attempts. Your IP has been blocked for 1 hour.';
    public $invalidAccessMsg = 'You do not have access to this area.';
    public $createSuccessMsg = '[Record] created successfully.';
    public $editSuccessMsg = '[Record] updated successfully.';
    public $deleteSuccessMsg = '[Record] removed successfully.';
    public $missingRequiredInputsMsg = 'There are validation errors. Possible missing required inputs.';
    public $sentContactMsg = 'Message sent successfully.';
    public $failedContactMsg = 'Form submission failed.';
    public $notFoundMsg = '[Record] not found.';
    public $alreadyExistMsg = '[Record] already exists.';
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
    public $bookingSuccessful = 'Your booking has been made successfully.';
    public $bookingFailed = 'Oops! Something went wrong with your booking submission. Please try again later.';
    public $subscriptionSuccessful = 'You have successfully subscribed!';
    public $subscriptionFailed = 'Sorry, something went wrong with your subscription. Please try again.';
    public $currentPasswordMissMatch = 'The current password you entered is incorrect.';
    public $currentNewPasswordMissMatch = 'The new password and confirmation do not match.';
    public $commentSuccessful = 'Thanks! Your comment has been received.';
    public $commentFailed = 'Failed to submit comment.';

    #--------------------------------------------------------------------
    # THEME CATEGORIES
    #--------------------------------------------------------------------
    public $themeCategories = [
        'Business' => 'Business & Corporate',
        'Ecommerce' => 'Ecommerce & Retail',
        'Portfolio' => 'Portfolio & Creative',
        'News' => 'Blog & Magazine',
        'Events' => 'Event & Booking',
        'Educational' => 'Educational & Learning',
        'Restaurant' => 'Restaurant & Food',
        'Health' => 'Health & Wellness',
        'Directory' => 'Directory & Listing',
        'Professional' => 'Professional Services',
        'HomeServices' => 'Home & Property Services',
        'Automotive' => 'Automotive & Transportation',
        'Beauty' => 'Beauty & Personal Care',
        'Creative' => 'Creative & Photography',
        'LegalFinance' => 'Legal & Financial',
        'Childcare' => 'Childcare & Education',
        'Travel' => 'Travel & Hospitality',
        'Construction' => 'Construction, Contractors & Building',
        'Entertainment' => 'Entertainment & Arts',
        'Technology' => 'Technology & IT',
        'NonProfit' => 'Non-Profit & NGO',
        'RealEstate' => 'Real Estate & Property',
        'Personal' => 'Personal & Resume',
        'Agency' => 'Agency & Marketing',
        'Landing' => 'Landing Pages',
        'ComingSoon' => 'Coming Soon',
        'Miscellaneous' => 'Miscellaneous',
    ];
    
    #--------------------------------------------------------------------
    # USER ROLES
    #--------------------------------------------------------------------
    public $userRoles = [
        'Admin' => 'Admin',
        'Manager' => 'Manager',
        'User' => 'User',
    ];
}