<?php

namespace App\Constants;

/**
 * ActivityTypes class
 *
 * This class defines constants representing different activity types used in the application.
 *
 * @namespace App\Constants
 */
class ActivityTypes
{
    //AUTH LOGS
    const USER_REGISTRATION = 'user_registration';
    const FAILED_USER_REGISTRATION = 'failed_user_registration';
    const USER_LOGIN = 'user_login';
    const USER_LOGOUT = 'user_logout';
    const FAILED_USER_LOGIN = 'failed_user_login';
    const TOO_MANY_FAILED_USER_LOGIN = 'too_many_failed_user_login';

    //CONTACT LOGS
    const CONTACT_CREATION = 'contact_created';
    const FAILED_CONTACT_CREATION = 'failed_contact_creation';
    const CONTACT_UPDATE = 'contact_updated';
    const FAILED_CONTACT_UPDATE = 'failed_contact_update';
    const CONTACT_DELETION = 'contact_delete';

    //USER LOGS
    const USER_CREATION = 'user_created';
    const FAILED_USER_CREATION = 'failed_user_creation';
    const USER_UPDATE = 'user_updated';
    const FAILED_USER_UPDATE = 'failed_user_update';
    const USER_DELETION = 'user_delete';

    //USER LOGS
    const FILE_UPLOADED = 'file_uploaded';
    const FILE_EDITED = 'file_edited';
    const FAILED_FILE_UPLOAD = 'failed_file_upload';
    const FILE_DELETION = 'file_delete';

    //PASSWORD LOGS
    const PASSWORD_CHANGED = 'password_changed';
    const FAILED_PASSWORD_CHANGED = 'failed_password_changed';

    //SETTINGS LOG
    const ACCOUNT_DETAILS_UPDATE = 'account_details_update';
    const FAILED_ACCOUNT_DETAILS_UPDATE = 'failed_account_details_update';
    const SETTINGS_UPDATE = 'settings_update';

    //PASSWORD RESETS
    const PASSWORD_RESET_SUCCESS = 'password_reset';
    const PASSWORD_RESET_SENT = 'password_reset_link_sent';
    const PASSWORD_RESET_FAILED = 'failed_password_reset_link';

    //CONFIGURATIONS
    const CONFIG_CREATION = 'config_created';
    const FAILED_CONFIG_CREATION = 'failed_config_creation';
    const CONFIG_UPDATE = 'config_updated';
    const FAILED_CONFIG_UPDATE = 'failed_config_update';
    const CONFIG_DELETION = 'config_delete';

    //API-KEYS
    const API_KEY_CREATION = 'api_key_created';
    const FAILED_API_KEY_CREATION = 'failed_api_key_creation';
    const API_KEY_UPDATE = 'api_key_updated';
    const FAILED_API_KEY_UPDATE = 'failed_api_key_update';
    const API_KEY_DELETION = 'api_key_delete';

    //SEARCH LOG
    const MODULE_SEARCH = 'module_search';
    const SEARCH = 'search';
    const SITEMAP = 'sitemap';

    //DELETE LOG
    const DELETE_LOG = 'delete_log';
    const FAILED_DELETE_LOG = 'failed_delete_log';

    // BACKUPS
    const BACKUP_CREATION = 'backup_created';
    const FAILED_BACKUP_CREATION = 'failed_backup_creation';
    const BACKUP_DELETION = 'backup_delete';

    // BLOGS
    const BLOG_CREATION = 'blog_created';
    const FAILED_BLOG_CREATION = 'failed_blog_creation';
    const BLOG_UPDATE = 'blog_updated';
    const FAILED_BLOG_UPDATE = 'failed_blog_update';
    const BLOG_DELETION = 'blog_delete';

    // CATEGORIES
    const CATEGORY_CREATION = 'category_created';
    const FAILED_CATEGORY_CREATION = 'failed_category_creation';
    const CATEGORY_UPDATE = 'category_updated';
    const FAILED_CATEGORY_UPDATE = 'failed_category_update';
    const CATEGORY_DELETION = 'category_delete';

    // NAVIGATIONS
    const NAVIGATION_CREATION = 'category_created';
    const FAILED_NAVIGATION_CREATION = 'failed_category_creation';
    const NAVIGATION_UPDATE = 'category_updated';
    const FAILED_NAVIGATION_UPDATE = 'failed_category_update';
    const NAVIGATION_DELETION = 'category_delete';

    // HOME PAGE
    const HOME_PAGE_CREATION = 'page_created';
    const FAILED_HOME_PAGE_CREATION = 'failed_page_creation';
    const HOME_PAGE_UPDATE = 'page_updated';
    const FAILED_HOME_PAGE_UPDATE = 'failed_page_update';
    const HOME_PAGE_DELETION = 'page_delete';

    // PAGES
    const PAGE_CREATION = 'page_created';
    const FAILED_PAGE_CREATION = 'failed_page_creation';
    const PAGE_UPDATE = 'page_updated';
    const FAILED_PAGE_UPDATE = 'failed_page_update';
    const PAGE_DELETION = 'page_delete';

    // CONTACT MESSAGES
    const CONTACT_MESSAGE_CREATION = 'contact_message_created';
    const FAILED_CONTACT_MESSAGE_CREATION = 'failed_contact_message_creation';
    const CONTACT_MESSAGE_UPDATE = 'contact_message_updated';
    const FAILED_CONTACT_MESSAGE_UPDATE = 'failed_contact_message_update';
    const CONTACT_MESSAGE_DELETION = 'contact_message_delete';

    // CONTENT BLOCKS
    const CONTENT_BLOCK_CREATION = 'content_block_created';
    const FAILED_CONTENT_BLOCK_CREATION = 'failed_content_block_creation';
    const CONTENT_BLOCK_UPDATE = 'content_block_updated';
    const FAILED_CONTENT_BLOCK_UPDATE = 'failed_content_block_update';
    const CONTENT_BLOCK_DELETION = 'content_block_delete';

    // COUNTERS
    const COUNTER_CREATION = 'counter_created';
    const FAILED_COUNTER_CREATION = 'failed_counter_creation';
    const COUNTER_UPDATE = 'counter_updated';
    const FAILED_COUNTER_UPDATE = 'failed_counter_update';
    const COUNTER_DELETION = 'counter_delete';

    // PARTNERS
    const PARTNER_CREATION = 'counter_created';
    const FAILED_PARTNER_CREATION = 'failed_counter_creation';
    const PARTNER_UPDATE = 'counter_updated';
    const FAILED_PARTNER_UPDATE = 'failed_counter_update';
    const PARTNER_DELETION = 'counter_delete';

    // SERVICES
    const SERVICE_CREATION = 'counter_created';
    const FAILED_SERVICE_CREATION = 'failed_counter_creation';
    const SERVICE_UPDATE = 'counter_updated';
    const FAILED_SERVICE_UPDATE = 'failed_counter_update';
    const SERVICE_DELETION = 'counter_delete';

    // EVENTS
    const EVENT_CREATION = 'event_created';
    const FAILED_EVENT_CREATION = 'failed_event_creation';
    const EVENT_UPDATE = 'event_updated';
    const FAILED_EVENT_UPDATE = 'failed_event_update';
    const EVENT_DELETION = 'event_delete';

    // FAQ
    const FAQ_CREATION = 'faq_created';
    const FAILED_FAQ_CREATION = 'failed_faq_creation';
    const FAQ_UPDATE = 'faq_updated';
    const FAILED_FAQ_UPDATE = 'failed_faq_update';
    const FAQ_DELETION = 'faq_delete';

    // GALLERY
    const GALLERY_CREATION = 'gallery_created';
    const FAILED_GALLERY_CREATION = 'failed_gallery_creation';
    const GALLERY_UPDATE = 'gallery_updated';
    const FAILED_GALLERY_UPDATE = 'failed_gallery_update';
    const GALLERY_DELETION = 'gallery_delete';

    // VIDEO
    const VIDEO_CREATION = 'video_created';
    const FAILED_VIDEO_CREATION = 'failed_video_creation';
    const VIDEO_UPDATE = 'video_updated';
    const FAILED_VIDEO_UPDATE = 'failed_video_update';
    const VIDEO_DELETION = 'video_delete';

    // POLICIES
    const POLICY_CREATION = 'policy_created';
    const FAILED_POLICY_CREATION = 'failed_policy_creation';
    const POLICY_UPDATE = 'policy_updated';
    const FAILED_POLICY_UPDATE = 'failed_policy_update';
    const POLICY_DELETION = 'policy_delete';

    // PRICINGS
    const PRICING_CREATION = 'pricing_created';
    const FAILED_PRICING_CREATION = 'failed_pricing_creation';
    const PRICING_UPDATE = 'pricing_updated';
    const FAILED_PRICING_UPDATE = 'failed_pricing_update';
    const PRICING_DELETION = 'pricing_delete';

    // PORTFOLIOS
    const PORTFOLIO_CREATION = 'portfolio_created';
    const FAILED_PORTFOLIO_CREATION = 'failed_project_creation';
    const PORTFOLIO_UPDATE = 'portfolio_updated';
    const FAILED_PORTFOLIO_UPDATE = 'failed_project_update';
    const PORTFOLIO_DELETION = 'portfolio_delete';

    // SOCIALS
    const SOCIAL_CREATION = 'social_created';
    const FAILED_SOCIAL_CREATION = 'failed_social_creation';
    const SOCIAL_UPDATE = 'social_updated';
    const FAILED_SOCIAL_UPDATE = 'failed_social_update';
    const SOCIAL_DELETION = 'social_delete';

    // TEAMS
    const TEAM_CREATION = 'team_created';
    const FAILED_TEAM_CREATION = 'failed_team_creation';
    const TEAM_UPDATE = 'team_updated';
    const FAILED_TEAM_UPDATE = 'failed_team_update';
    const TEAM_DELETION = 'team_delete';

    // TESTIMONIALS
    const TESTIMONIAL_CREATION = 'testimonial_created';
    const FAILED_TESTIMONIAL_CREATION = 'failed_testimonial_creation';
    const TESTIMONIAL_UPDATE = 'testimonial_updated';
    const FAILED_TESTIMONIAL_UPDATE = 'failed_testimonial_update';
    const TESTIMONIAL_DELETION = 'testimonial_delete';

    // TRANSLATIONS
    const TRANSLATION_CREATION = 'translation_created';
    const FAILED_TRANSLATION_CREATION = 'failed_translation_creation';
    const TRANSLATION_UPDATE = 'translation_updated';
    const FAILED_TRANSLATION_UPDATE = 'failed_translation_update';
    const TRANSLATION_DELETION = 'translation_delete';

    // CODES
    const CODE_CREATION = 'code_created';
    const FAILED_CODE_CREATION = 'failed_code_creation';
    const CODE_UPDATE = 'code_updated';
    const FAILED_CODE_UPDATE = 'failed_code_update';
    const CODE_DELETION = 'code_delete';

    // THEMES
    const THEME_CREATION = 'theme_created';
    const FAILED_THEME_CREATION = 'failed_theme_creation';
    const THEME_UPDATE = 'theme_updated';
    const FAILED_THEME_UPDATE = 'failed_theme_update';
    const THEME_DELETION = 'theme_delete';

    // RESUME
    const RESUME_CREATION = 'resume_created';
    const FAILED_RESUME_CREATION = 'failed_resume_creation';
    const RESUME_UPDATE = 'resume_updated';
    const FAILED_RESUME_UPDATE = 'failed_resume_update';
    const RESUME_DELETION = 'resume_delete';

    // EXPERIENCE
    const EXPERIENCE_CREATION = 'experience_created';
    const FAILED_EXPERIENCE_CREATION = 'failed_experience_creation';
    const EXPERIENCE_UPDATE = 'experience_updated';
    const FAILED_EXPERIENCE_UPDATE = 'failed_experience_update';
    const EXPERIENCE_DELETION = 'experience_delete';

    // EDUCATION
    const EDUCATION_CREATION = 'education_created';
    const FAILED_EDUCATION_CREATION = 'failed_education_creation';
    const EDUCATION_UPDATE = 'education_updated';
    const FAILED_EDUCATION_UPDATE = 'failed_education_update';
    const EDUCATION_DELETION = 'education_delete';

    // SKILL
    const SKILL_CREATION = 'skill_created';
    const FAILED_SKILL_CREATION = 'failed_skill_creation';
    const SKILL_UPDATE = 'skill_updated';
    const FAILED_SKILL_UPDATE = 'failed_skill_update';
    const SKILL_DELETION = 'skill_delete';

    // PRODUCT
    const PRODUCT_CREATION = 'product_created';
    const FAILED_PRODUCT_CREATION = 'failed_product_creation';
    const PRODUCT_UPDATE = 'product_updated';
    const FAILED_PRODUCT_UPDATE = 'failed_product_update';
    const PRODUCT_DELETION = 'product_delete';

    // PRODUCT_CATEGORY
    const PRODUCT_CATEGORY_CREATION = 'product_category_created';
    const FAILED_PRODUCT_CATEGORY_CREATION = 'failed_product_category_creation';
    const PRODUCT_CATEGORY_UPDATE = 'product_category_updated';
    const FAILED_PRODUCT_CATEGORY_UPDATE = 'failed_product_category_update';
    const PRODUCT_CATEGORY_DELETION = 'product_category_delete';

    // POPUP
    const POPUP_CREATION = 'popup_created';
    const FAILED_POPUP_CREATION = 'failed_popup_creation';
    const POPUP_UPDATE = 'popup_updated';
    const FAILED_POPUP_UPDATE = 'failed_popup_update';
    const POPUP_DELETION = 'popup_delete';

    // DONATION CAUSE
    const DONATION_CAUSE_CREATION = 'donation_cause_created';
    const FAILED_DONATION_CAUSE_CREATION = 'failed_donation_cause_creation';
    const DONATION_CAUSE_UPDATE = 'donation_cause_updated';
    const FAILED_DONATION_CAUSE_UPDATE = 'failed_donation_cause_update';
    const DONATION_CAUSE_DELETION = 'donation_cause_delete';

    // DONATION CAUSE
    const SUBSCRIPTION_CREATION = 'subscription_created';
    const FAILED_SUBSCRIPTION_CREATION = 'failed_subscription_creation';
    const SUBSCRIPTION_UPDATE = 'subscription_updated';
    const FAILED_SUBSCRIPTION_UPDATE = 'failed_subscription_update';
    const SUBSCRIPTION_DELETION = 'subscription_delete';

    // BLOCKED IP REASONS
    const BLOCKED_IP_TOO_MANY_FAILED_LOGINS = 'too_many_failed_logins';
    const BLOCKED_IP_SUSPICIOUS_ACTIVITY = 'suspicious_activity';
    const BLOCKED_IP_MALICIOUS_TRAFFIC = 'malicious_traffic';
    const BLOCKED_IP_DENIAL_OF_SERVICE = 'denial_of_service';
    const BLOCKED_IP_BRUTE_FORCE_ATTACK = 'brute_force_attack';
    const BLOCKED_IP_SPAMMING = 'spamming';
    const BLOCKED_IP_KNOWN_ATTACKER = 'known_attacker';
    const BLOCKED_IP_MANUAL_BLOCK = 'manual_block';
    const BLOCKED_IP_INVALID_REQUEST = 'invalid_request';
    const BLOCKED_IP_SQL_INJECTION_ATTEMPT = 'sql_injection_attempt';
    const BLOCKED_IP_DIRECTORY_TRAVERSAL = 'directory_traversal';
    const BLOCKED_IP_EXPLOIT_ATTEMPT = 'exploit_attempt';


    // Add more activity types as needed

    /**
     * Gets the description for a given activity type.
     *
     * @param string $type The activity type.
     * @return string The description of the activity type, or "Unknown Activity" if not found.
     */
    public static function getDescription($type)
    {
        $descriptions = [
            //Auth
            self::USER_REGISTRATION => 'User Registration',
            self::FAILED_USER_REGISTRATION => 'User Registration Failed',
            self::USER_LOGIN => 'User Login',
            self::USER_LOGOUT => 'User Logout',
            self::FAILED_USER_LOGIN => 'Failed User Login',
            self::TOO_MANY_FAILED_USER_LOGIN => 'Too Many Failed User Login Attempts',

            //Contact
            self::CONTACT_CREATION => 'Contact Creation',
            self::FAILED_CONTACT_CREATION => 'Contact Creation Failed',
            self::CONTACT_UPDATE => 'Contact Update',
            self::FAILED_CONTACT_UPDATE => 'Contact Update Failed',
            self::CONTACT_DELETION => 'Contact Deletion',

            //User
            self::USER_CREATION => 'User Creation',
            self::FAILED_USER_CREATION => 'User Creation Failed',
            self::USER_UPDATE => 'User Update',
            self::FAILED_USER_UPDATE => 'User Update Failed',
            self::USER_DELETION => 'User Deletion',

            //Files
            self::FILE_UPLOADED => 'File Uploaded',
            self::FILE_EDITED => 'File Edited',
            self::FAILED_FILE_UPLOAD => 'File Upload Failed',
            self::FILE_DELETION => 'File Deleted',

            //Passwords
            self::PASSWORD_CHANGED => 'Password Changed',
            self::FAILED_PASSWORD_CHANGED => 'Password Changed Failed',
            self::PASSWORD_RESET_SUCCESS => 'Password Reset',
            self::PASSWORD_RESET_SENT => 'Password Reset Link Sent',
            self::PASSWORD_RESET_FAILED => 'Password Reset Link Failed',

            //Configs
            self::CONFIG_CREATION => 'Config Creation',
            self::FAILED_CONFIG_CREATION => 'Config Creation Failed',
            self::CONFIG_UPDATE => 'Config Update',
            self::FAILED_CONFIG_UPDATE => 'Config Update Failed',
            self::CONFIG_DELETION => 'Config Deletion',

            //Api-keys
            self::API_KEY_CREATION => 'API-Key Creation',
            self::FAILED_API_KEY_CREATION => 'API-Key Creation Failed',
            self::API_KEY_UPDATE => 'API-Key Update',
            self::FAILED_API_KEY_UPDATE => 'API-Key Update Failed',
            self::API_KEY_DELETION => 'API-Key Deletion',

            //Account
            self::ACCOUNT_DETAILS_UPDATE => 'Account Details Update',
            self::SETTINGS_UPDATE => 'Settings Update',

            self::MODULE_SEARCH => 'Module Search',
            self::SEARCH => 'Search',
            self::SITEMAP => 'Sitemap',
            self::DELETE_LOG => 'Delete Action',
            self::FAILED_DELETE_LOG => 'Failed Delete Action',

            // Backups
            self::BACKUP_CREATION => 'Backup Created',
            self::FAILED_BACKUP_CREATION => 'Backup Creation Failed',
            self::BACKUP_DELETION => 'Backup Deletion',

            // Blogs
            self::BLOG_CREATION => 'Blog Created',
            self::FAILED_BLOG_CREATION => 'Blog Creation Failed',
            self::BLOG_UPDATE => 'Blog Updated',
            self::FAILED_BLOG_UPDATE => 'Blog Update Failed',
            self::BLOG_DELETION => 'Blog Deletion',

            // Categories
            self::CATEGORY_CREATION => 'Category Created',
            self::FAILED_CATEGORY_CREATION => 'Category Creation Failed',
            self::CATEGORY_UPDATE => 'Category Updated',
            self::FAILED_CATEGORY_UPDATE => 'Category Update Failed',
            self::CATEGORY_DELETION => 'Category Deletion',

            // Navigations
            self::NAVIGATION_CREATION => 'Navigation Created',
            self::FAILED_NAVIGATION_CREATION => 'Navigation Creation Failed',
            self::NAVIGATION_UPDATE => 'Navigation Updated',
            self::FAILED_NAVIGATION_UPDATE => 'Navigation Update Failed',
            self::NAVIGATION_DELETION => 'Navigation Deletion',

            // Home Page
            self::HOME_PAGE_CREATION => 'Page Created',
            self::FAILED_HOME_PAGE_CREATION => 'Page Creation Failed',
            self::HOME_PAGE_UPDATE => 'Page Updated',
            self::FAILED_HOME_PAGE_UPDATE => 'Page Update Failed',
            self::HOME_PAGE_DELETION => 'Page Deletion',

            // Pages
            self::PAGE_CREATION => 'Page Created',
            self::FAILED_PAGE_CREATION => 'Page Creation Failed',
            self::PAGE_UPDATE => 'Page Updated',
            self::FAILED_PAGE_UPDATE => 'Page Update Failed',
            self::PAGE_DELETION => 'Page Deletion',

            // Contact Messages
            self::CONTACT_MESSAGE_CREATION => 'Contact Message Created',
            self::FAILED_CONTACT_MESSAGE_CREATION => 'Contact Message Creation Failed',
            self::CONTACT_MESSAGE_UPDATE => 'Contact Message Updated',
            self::FAILED_CONTACT_MESSAGE_UPDATE => 'Contact Message Update Failed',
            self::CONTACT_MESSAGE_DELETION => 'Contact Message Deletion',

            // Content Blocks
            self::CONTENT_BLOCK_CREATION => 'Content Block Created',
            self::FAILED_CONTENT_BLOCK_CREATION => 'Content Block Creation Failed',
            self::CONTENT_BLOCK_UPDATE => 'Content Block Updated',
            self::FAILED_CONTENT_BLOCK_UPDATE => 'Content Block Update Failed',
            self::CONTENT_BLOCK_DELETION => 'Content Block Deletion',

            // Counters
            self::COUNTER_CREATION => 'Counter Created',
            self::FAILED_COUNTER_CREATION => 'Counter Creation Failed',
            self::COUNTER_UPDATE => 'Counter Updated',
            self::FAILED_COUNTER_UPDATE => 'Counter Update Failed',
            self::COUNTER_DELETION => 'Counter Deletion',

            // Services
            self::SERVICE_CREATION => 'Service Created',
            self::FAILED_SERVICE_CREATION => 'Service Creation Failed',
            self::SERVICE_UPDATE => 'Service Updated',
            self::FAILED_SERVICE_UPDATE => 'Service Update Failed',
            self::SERVICE_DELETION => 'Service Deletion',

            // Partner
            self::PARTNER_CREATION => 'Partner Created',
            self::FAILED_PARTNER_CREATION => 'Partner Creation Failed',
            self::PARTNER_UPDATE => 'Partner Updated',
            self::FAILED_PARTNER_UPDATE => 'Partner Update Failed',
            self::PARTNER_DELETION => 'Partner Deletion',

            // Events
            self::EVENT_CREATION => 'Event Created',
            self::FAILED_EVENT_CREATION => 'Event Creation Failed',
            self::EVENT_UPDATE => 'Event Updated',
            self::FAILED_EVENT_UPDATE => 'Event Update Failed',
            self::EVENT_DELETION => 'Event Deletion',

            // FAQ
            self::FAQ_CREATION => 'FAQ Created',
            self::FAILED_FAQ_CREATION => 'FAQ Creation Failed',
            self::FAQ_UPDATE => 'FAQ Updated',
            self::FAILED_FAQ_UPDATE => 'FAQ Update Failed',
            self::FAQ_DELETION => 'FAQ Deletion',

            // Gallery
            self::GALLERY_CREATION => 'Gallery Created',
            self::FAILED_GALLERY_CREATION => 'Gallery Creation Failed',
            self::GALLERY_UPDATE => 'Gallery Updated',
            self::FAILED_GALLERY_UPDATE => 'Gallery Update Failed',
            self::GALLERY_DELETION => 'Gallery Deletion',

            // Video
            self::VIDEO_CREATION => 'Video Created',
            self::FAILED_VIDEO_CREATION => 'Video Creation Failed',
            self::VIDEO_UPDATE => 'Video Updated',
            self::FAILED_VIDEO_UPDATE => 'Video Update Failed',
            self::VIDEO_DELETION => 'Video Deletion',

            // Policies
            self::POLICY_CREATION => 'Policy Created',
            self::FAILED_POLICY_CREATION => 'Policy Creation Failed',
            self::POLICY_UPDATE => 'Policy Updated',
            self::FAILED_POLICY_UPDATE => 'Policy Update Failed',
            self::POLICY_DELETION => 'Policy Deletion',

            // Pricings
            self::PRICING_CREATION => 'Pricing Created',
            self::FAILED_PRICING_CREATION => 'Pricing Creation Failed',
            self::PRICING_UPDATE => 'Pricing Updated',
            self::FAILED_PRICING_UPDATE => 'Pricing Update Failed',
            self::PRICING_DELETION => 'Pricing Deletion',

            // Portfolios
            self::PORTFOLIO_CREATION => 'Portfolio Created',
            self::FAILED_PORTFOLIO_CREATION => 'Portfolio Creation Failed',
            self::PORTFOLIO_UPDATE => 'Portfolio Updated',
            self::FAILED_PORTFOLIO_UPDATE => 'Portfolio Update Failed',
            self::PORTFOLIO_DELETION => 'Portfolio Deletion',

            // Socials
            self::SOCIAL_CREATION => 'Social Created',
            self::FAILED_SOCIAL_CREATION => 'Social Creation Failed',
            self::SOCIAL_UPDATE => 'Social Updated',
            self::FAILED_SOCIAL_UPDATE => 'Social Update Failed',
            self::SOCIAL_DELETION => 'Social Deletion',

            // Teams
            self::TEAM_CREATION => 'Team Created',
            self::FAILED_TEAM_CREATION => 'Team Creation Failed',
            self::TEAM_UPDATE => 'Team Updated',
            self::FAILED_TEAM_UPDATE => 'Team Update Failed',
            self::TEAM_DELETION => 'Team Deletion',

            // Testimonials
            self::TESTIMONIAL_CREATION => 'Testimonial Created',
            self::FAILED_TESTIMONIAL_CREATION => 'Testimonial Creation Failed',
            self::TESTIMONIAL_UPDATE => 'Testimonial Updated',
            self::FAILED_TESTIMONIAL_UPDATE => 'Testimonial Update Failed',
            self::TESTIMONIAL_DELETION => 'Testimonial Deletion',

            // Translations
            self::TRANSLATION_CREATION => 'Translation Created',
            self::FAILED_TRANSLATION_CREATION => 'Translation Creation Failed',
            self::TRANSLATION_UPDATE => 'Translation Updated',
            self::FAILED_TRANSLATION_UPDATE => 'Translation Update Failed',
            self::TRANSLATION_DELETION => 'Translation Deletion',

            // Codes
            self::CODE_CREATION => 'Code Created',
            self::FAILED_CODE_CREATION => 'Code Creation Failed',
            self::CODE_UPDATE => 'Code Updated',
            self::FAILED_CODE_UPDATE => 'Code Update Failed',
            self::CODE_DELETION => 'Code Deletion',

            // Themes
            self::THEME_CREATION => 'Theme Created',
            self::FAILED_THEME_CREATION => 'Theme Creation Failed',
            self::THEME_UPDATE => 'Theme Updated',
            self::FAILED_THEME_UPDATE => 'Theme Update Failed',
            self::THEME_DELETION => 'Theme Deletion',

            // Resumes
            self::RESUME_CREATION => 'Resume Created',
            self::FAILED_RESUME_CREATION => 'Resume Creation Failed',
            self::RESUME_UPDATE => 'Resume Updated',
            self::FAILED_RESUME_UPDATE => 'Resume Update Failed',
            self::RESUME_DELETION => 'Resume Deletion',

            // Experience
            self::EXPERIENCE_CREATION => 'Experience Created',
            self::FAILED_EXPERIENCE_CREATION => 'Experience Creation Failed',
            self::EXPERIENCE_UPDATE => 'Experience Updated',
            self::FAILED_EXPERIENCE_UPDATE => 'Experience Update Failed',
            self::EXPERIENCE_CREATION => 'Experience Deletion',

            // Education
            self::EDUCATION_CREATION => 'Education Created',
            self::FAILED_EDUCATION_CREATION => 'Education Creation Failed',
            self::EDUCATION_UPDATE => 'Education Updated',
            self::FAILED_EDUCATION_UPDATE => 'Education Update Failed',
            self::EDUCATION_CREATION => 'Education Deletion',

            // Skill
            self::SKILL_CREATION => 'Skill Created',
            self::FAILED_SKILL_CREATION => 'Skill Creation Failed',
            self::SKILL_UPDATE => 'Skill Updated',
            self::FAILED_SKILL_UPDATE => 'Skill Update Failed',
            self::SKILL_CREATION => 'Skill Deletion',

            // Product
            self::PRODUCT_CREATION => 'Product Created',
            self::FAILED_PRODUCT_CREATION => 'Product Creation Failed',
            self::PRODUCT_UPDATE => 'Product Updated',
            self::FAILED_PRODUCT_UPDATE => 'Product Update Failed',
            self::PRODUCT_CREATION => 'Product Deletion',

            // Product Category
            self::PRODUCT_CATEGORY_CREATION => 'Product Category Created',
            self::FAILED_PRODUCT_CATEGORY_CREATION => 'Product Category Creation Failed',
            self::PRODUCT_CATEGORY_UPDATE => 'Product Category Updated',
            self::FAILED_PRODUCT_CATEGORY_UPDATE => 'Product Category Update Failed',
            self::PRODUCT_CATEGORY_CREATION => 'Product Category Deletion',

            // Popup
            self::POPUP_CREATION => 'Popup Created',
            self::FAILED_POPUP_CREATION => 'Popup Creation Failed',
            self::POPUP_UPDATE => 'Popup Updated',
            self::FAILED_POPUP_UPDATE => 'Popup Update Failed',
            self::POPUP_CREATION => 'Popup Deletion',

            // Donation Cause
            self::DONATION_CAUSE_CREATION => 'Donation cause Created',
            self::FAILED_DONATION_CAUSE_CREATION => 'Donation cause Creation Failed',
            self::DONATION_CAUSE_UPDATE => 'Donation cause Updated',
            self::FAILED_DONATION_CAUSE_UPDATE => 'Donation cause Update Failed',
            self::DONATION_CAUSE_CREATION => 'Donation cause Deletion',

            // Subscriptions
            self::SUBSCRIPTION_CREATION => 'Subscription Created',
            self::FAILED_SUBSCRIPTION_CREATION => 'Subscription Creation Failed',
            self::SUBSCRIPTION_UPDATE => 'Subscription Updated',
            self::FAILED_SUBSCRIPTION_UPDATE => 'Subscription Update Failed',
            self::SUBSCRIPTION_CREATION => 'Subscription Deletion',

            // BLOCKED IP REASONS
            self::BLOCKED_IP_TOO_MANY_FAILED_LOGINS => 'Too Many Failed Logins',
            self::BLOCKED_IP_SUSPICIOUS_ACTIVITY => 'Suspicious Activity Detected',
            self::BLOCKED_IP_MALICIOUS_TRAFFIC => 'Malicious Traffic Identified',
            self::BLOCKED_IP_DENIAL_OF_SERVICE => 'Potential Denial-of-Service Attack',
            self::BLOCKED_IP_BRUTE_FORCE_ATTACK => 'Brute-Force Attack Detected',
            self::BLOCKED_IP_SPAMMING => 'Spamming or Abuse',
            self::BLOCKED_IP_KNOWN_ATTACKER => 'Known Malicious IP Address',
            self::BLOCKED_IP_MANUAL_BLOCK => 'Manually Blocked by Administrator',
            self::BLOCKED_IP_INVALID_REQUEST => 'Invalid or Malformed Request',
            self::BLOCKED_IP_SQL_INJECTION_ATTEMPT => 'Potential SQL Injection Attempt',
            self::BLOCKED_IP_DIRECTORY_TRAVERSAL => 'Directory Traversal Attempt',
            self::BLOCKED_IP_EXPLOIT_ATTEMPT => 'Exploit Attempt',

            // Add more descriptions as needed
        ];

        return $descriptions[$type] ?? 'Unknown Activity';
    }
}