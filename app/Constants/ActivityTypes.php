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
    const ROBOTS = 'robots';
    const RSS = 'rss';

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

    // PAGES
    const PAGE_CREATION = 'page_created';
    const FAILED_PAGE_CREATION = 'failed_page_creation';
    const PAGE_UPDATE = 'page_updated';
    const FAILED_PAGE_UPDATE = 'failed_page_update';
    const PAGE_DELETION = 'page_delete';

    // CONTENT BLOCKS
    const CONTENT_BLOCK_CREATION = 'content_block_created';
    const FAILED_CONTENT_BLOCK_CREATION = 'failed_content_block_creation';
    const CONTENT_BLOCK_UPDATE = 'content_block_updated';
    const FAILED_CONTENT_BLOCK_UPDATE = 'failed_content_block_update';
    const CONTENT_BLOCK_DELETION = 'content_block_delete';

    // DATA GROUPS
    const DATA_GROUP_CREATION = 'data_group_created';
    const FAILED_DATA_GROUP_CREATION = 'failed_data_group_creation';
    const DATA_GROUP_UPDATE = 'data_group_updated';
    const FAILED_DATA_GROUP_UPDATE = 'failed_data_group_update';
    const DATA_GROUP_DELETION = 'data_group_delete';

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

    // BLOCKED IP REASONS
    const BLOCKED_IP_CREATION = 'blocked_ip_created';
    const FAILED_BLOCKED_IP_CREATION = 'failed_blocked_ip_creation';
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

    // WHITELISTED IPS
    const WHITELISTED_IP_CREATION = 'whitelisted_ip_created';
    const FAILED_WHITELISTED_IP_CREATION = 'failed_whitelisted_ip_creation';

    // PLUGIN
    const PLUGIN_CREATION = 'plugin_created';
    const FAILED_PLUGIN_CREATION = 'failed_plugin_creation';
    const PLUGIN_UPDATE = 'plugin_updated';
    const FAILED_PLUGIN_UPDATE = 'failed_plugin_update';
    const PLUGIN_DELETION = 'plugin_delete';

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
            self::ROBOTS => 'Robots',
            self::RSS => 'Rss',
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

            // Pages
            self::PAGE_CREATION => 'Page Created',
            self::FAILED_PAGE_CREATION => 'Page Creation Failed',
            self::PAGE_UPDATE => 'Page Updated',
            self::FAILED_PAGE_UPDATE => 'Page Update Failed',
            self::PAGE_DELETION => 'Page Deletion',

            // Content Blocks
            self::CONTENT_BLOCK_CREATION => 'Content Block Created',
            self::FAILED_CONTENT_BLOCK_CREATION => 'Content Block Creation Failed',
            self::CONTENT_BLOCK_UPDATE => 'Content Block Updated',
            self::FAILED_CONTENT_BLOCK_UPDATE => 'Content Block Update Failed',
            self::CONTENT_BLOCK_DELETION => 'Content Block Deletion',

            // Data Groups
            self::DATA_GROUP_CREATION => 'Data Group Created',
            self::FAILED_DATA_GROUP_CREATION => 'Data Group Creation Failed',
            self::DATA_GROUP_UPDATE => 'Data Group Updated',
            self::FAILED_DATA_GROUP_UPDATE => 'Data Group Update Failed',
            self::DATA_GROUP_DELETION => 'Data Group Deletion',

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

            // BLOCKED IP REASONS
            self::BLOCKED_IP_CREATION => 'Blocked IP Created',
            self::FAILED_BLOCKED_IP_CREATION => 'Blocked IP Creation Failed',
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

            // BLOCKED IP REASONS
            self::WHITELISTED_IP_CREATION => 'Whitelisted IP Created',
            self::FAILED_WHITELISTED_IP_CREATION => 'Whitelisted IP Creation Failed',

            // Plugins
            self::PLUGIN_CREATION => 'Plugin Created',
            self::FAILED_PLUGIN_CREATION => 'Plugin Creation Failed',
            self::PLUGIN_UPDATE => 'Plugin Updated',
            self::FAILED_PLUGIN_UPDATE => 'Plugin Update Failed',
            self::PLUGIN_CREATION => 'Plugin Deletion',


            // Add more descriptions as needed
        ];

        return $descriptions[$type] ?? 'Unknown Activity';
    }
}