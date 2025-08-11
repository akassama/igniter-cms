<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
*/

//SIGN-IN
$routes->group('sign-in', ['filter' => ['siteStatsFilter','guestFilter','pluginsFilter']], function($routes) {
    $routes->get('/', 'SignInController::index');
    $routes->post('/', 'SignInController::login');
});

//SIGN-UP
$routes->group('sign-up', ['filter' => ['siteStatsFilter','pluginsFilter']], function($routes) {
    $routes->get('/', 'SignUpController::index');
    $routes->post('/', 'SignUpController::addRegistration');
});

//SIGN-OUT
$routes->get('/sign-out', 'SignOutController::index');

//FORGOT-PASSWORD
$routes->group('forgot-password', ['filter' => ['siteStatsFilter','guestFilter','pluginsFilter']], function($routes) {
    $routes->get('/', 'ForgotPasswordController::index');
    $routes->post('/', 'ForgotPasswordController::sendResetLinkEmail');
});

//PASSWORD-RESET
$routes->group('password-reset', ['filter' => ['siteStatsFilter','guestFilter','pluginsFilter']], function($routes) {
    $routes->get('(:segment)', 'PasswordResetController::index/$1');
    $routes->post('/', 'PasswordResetController::resetPassword');
});

//UNSUBSCRIBE
$routes->get('services/unsubscribe/(:any)', 'ServicesController::unsubscribe/$1');

//RE-SUBSCRIBE
$routes->get('services/resubscribe/(:any)', 'ServicesController::resubscribe/$1');

//ACCOUNT
$routes->get('/account', 'AccountController::index', ['filter' => 'authFilter']);

//ACCOUNT
$routes->group('account', ['filter' => ['authFilter', 'demoCheckFilter', 'featureCheckFilter:FEATURE_BACK_END']], function($routes) {
//BACK_ENABLED_ENABLED
if (isFeatureEnabled('FEATURE_BACK_END')) {
    //DASHBOARD
    $routes->get('dashboard', 'DashboardController::index');

    if (isFeatureEnabled('FEATURE_CMS')) {
        #####============================= CMS MODULE =============================#####
        #CMS
        $routes->get('cms', 'CMSController::index');

        #CMS-BLOGS
        $routes->get('cms/blogs', 'CMSController::blogs');
        $routes->get('cms/blogs/new-blog', 'CMSController::newBlog');
        $routes->post('cms/blogs/new-blog', 'CMSController::addBlog');
        $routes->get('cms/blogs/view-blog/(:any)', 'CMSController::viewBlog/$1');
        $routes->get('cms/blogs/edit-blog/(:any)', 'CMSController::editBlog/$1');
        $routes->post('cms/blogs/edit-blog', 'CMSController::updateBlog');

        #CMS-CATEGORIES
        $routes->get('cms/categories', 'CMSController::categories');
        $routes->get('cms/categories/new-category', 'CMSController::newCategory');
        $routes->post('cms/categories/new-category', 'CMSController::addCategory');
        $routes->get('cms/categories/view-category/(:any)', 'CMSController::viewCategory/$1');
        $routes->get('cms/categories/edit-category/(:any)', 'CMSController::editCategory/$1');
        $routes->post('cms/categories/edit-category', 'CMSController::updateCategory');

        #CMS-NAVIGATIONS
        $routes->get('cms/navigations', 'CMSController::navigations');
        $routes->get('cms/navigations/new-navigation', 'CMSController::newNavigation');
        $routes->post('cms/navigations/new-navigation', 'CMSController::addNavigation');
        $routes->get('cms/navigations/view-navigation/(:any)', 'CMSController::viewNavigation/$1');
        $routes->get('cms/navigations/edit-navigation/(:any)', 'CMSController::editNavigation/$1');
        $routes->post('cms/navigations/edit-navigation', 'CMSController::updateNavigation');

        #CMS-PAGES
        $routes->get('cms/pages', 'CMSController::pages');
        $routes->get('cms/pages/new-page', 'CMSController::newPage');
        $routes->post('cms/pages/new-page', 'CMSController::addPage');
        $routes->get('cms/pages/view-page/(:any)', 'CMSController::viewPage/$1');
        $routes->get('cms/pages/edit-page/(:any)', 'CMSController::editPage/$1');
        $routes->post('cms/pages/edit-page', 'CMSController::updatePage');

        #CMS-DATA-GROUPS
        $routes->get('cms/data-groups', 'CMSController::dataGroups');
        $routes->get('cms/data-groups/new-data-group', 'CMSController::newDataGroup');
        $routes->post('cms/data-groups/new-data-group', 'CMSController::addDataGroup');
        $routes->get('cms/data-groups/view-data-group/(:any)', 'CMSController::viewDataGroup/$1');
        $routes->get('cms/data-groups/edit-data-group/(:any)', 'CMSController::editDataGroup/$1');
        $routes->post('cms/data-groups/edit-data-group', 'CMSController::updateDataGroup');
	}

    if (isFeatureEnabled('FEATURE_CONTENT_BLOCKS')) {
        #####============================= CMS-CONTENT BLOCKS MODULE =============================#####
        #CMS-CONTENT BLOCKS
        $routes->get('content-blocks', 'ContentBlocksController::contentBlocks');
        $routes->get('content-blocks/new-content-block', 'ContentBlocksController::newContentBlock');
        $routes->post('content-blocks/new-content-block', 'ContentBlocksController::addContentBlock');
        $routes->get('content-blocks/view-content-block/(:any)', 'ContentBlocksController::viewContentBlock/$1');
        $routes->get('content-blocks/edit-content-block/(:any)', 'ContentBlocksController::editContentBlock/$1');
        $routes->post('content-blocks/edit-content-block', 'ContentBlocksController::updateContentBlock');
    }

    if (isFeatureEnabled('FEATURE_FILE_MANAGER')) {
        #####============================= FILE MANAGER MODULE =============================#####
        #FILE MANAGER
        $routes->get('file-manager/', 'FileManagerController::index');
        $routes->post('file-manager/renameFile', 'FileManagerController::renameFile');
        $routes->post('file-manager/deleteFile', 'FileManagerController::deleteFile');
        $routes->post('file-manager/uploadFiles', 'FileManagerController::uploadFiles');
        $routes->post('file-manager/bulkDelete', 'FileManagerController::bulkDelete');
    }

    if (isFeatureEnabled('FEATURE_SETTINGS')) {
        #####============================= SETTINGS MODULE =============================#####
        #SETTINGS
        $routes->get('settings', 'SettingsController::index');
        $routes->get('settings/update-details', 'SettingsController::updateDetails');
        $routes->post('settings/update-details/update-user', 'SettingsController::updateUser');
        $routes->get('settings/change-password', 'SettingsController::changePassword');
        $routes->post('settings/change-password/update-password', 'SettingsController::updatePassword');    
    }

    if (isFeatureEnabled('FEATURE_APPEARANCE')) {
        #####============================= APPEARANCE MODULE =============================#####
        #APPEARANCE
        $routes->get('appearance', 'AppearanceController::index');

        #APPEARANCE-THEMES
        $routes->get('appearance/themes', 'AppearanceController::themes');
        $routes->get('appearance/themes/install-themes', 'AppearanceController::installThemes');
        $routes->get('appearance/themes/upload-theme', 'AppearanceController::uploadTheme');
        $routes->post('appearance/themes/upload-theme', 'AppearanceController::addTheme');
        $routes->get('appearance/themes/edit-theme/(:any)', 'AppearanceController::editTheme/$1');
        $routes->post('appearance/themes/edit-theme', 'AppearanceController::updateTheme');
        $routes->get('appearance/themes/activate/(:any)', 'AppearanceController::activateTheme/$1');
        $routes->post('appearance/themes/remove-theme', 'AppearanceController::removeTheme');

        #FILE EDITORS
        $routes->get('appearance/theme-editor', 'AppearanceController::viewFiles');
        $routes->get('appearance/theme-editor/layout', 'AppearanceController::layoutFileEditor');
        $routes->get('appearance/theme-editor/home', 'AppearanceController::homeFileEditor');
        $routes->get('appearance/theme-editor/blogs', 'AppearanceController::blogsFileEditor');
        $routes->get('appearance/theme-editor/view-blog', 'AppearanceController::viewBlogFileEditor');
        $routes->get('appearance/theme-editor/view-page', 'AppearanceController::viewPageFileEditor');
        $routes->get('appearance/theme-editor/search', 'AppearanceController::searchFileEditor');
        $routes->get('appearance/theme-editor/search-filter', 'AppearanceController::searchFilterFileEditor');
        $routes->post('appearance/theme-editor/save-file', 'AppearanceController::saveFile');
    }

    if (isFeatureEnabled('FEATURE_ADMIN')) {
        #####============================= ADMIN MODULE =============================#####
        //ADMIN
        $routes->get('admin', 'AdminController::index', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/users', 'AdminController::users', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/users/new-user', 'AdminController::newUser', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/users/new-user', 'AdminController::addUser');
        $routes->get('admin/users/edit-user/(:any)', 'AdminController::editUser/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/users/edit-user', 'AdminController::updateUser');
        $routes->get('admin/users/view-user/(:any)', 'AdminController::viewUser/$1', ['filter' => 'adminRoleFilter']);

        #ACTIVITY LOGS
        $routes->get('admin/activity-logs', 'AdminController::activityLogs', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/activity-logs/view-activity/(:any)', 'AdminController::viewActivity/$1');
        $routes->get('admin/logs', 'AdminController::viewLogFiles', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/logs/view-log/(:any)', 'AdminController::viewLogData/$1');
        
        #VISIT STATS
        $routes->get('admin/visit-stats', 'AdminController::viewStats', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/visit-stats/view-stat/(:any)', 'AdminController::viewStat/$1');
        $routes->get('admin/blocked-ips', 'AdminController::blockedIps', ['filter' => 'adminRoleFilter']);
        
        #IP MANAGEMENT
        $routes->get('admin/blocked-ips/new-blocked-ip', 'AdminController::newBlockedIP', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/blocked-ips/new-blocked-ip', 'AdminController::addBlockedIP');
        $routes->get('admin/whitelisted-ips', 'AdminController::whitelistedIps', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/whitelisted-ips/new-whitelisted-ip', 'AdminController::newWhitelistedIP', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/whitelisted-ips/new-whitelisted-ip', 'AdminController::addWhitelistedIP');
        
        #CONFIGURATIONS
        $routes->get('admin/configurations', 'AdminController::configurations', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/configurations/new-config', 'AdminController::newConfiguration', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/configurations/new-config', 'AdminController::addConfiguration');
        $routes->get('admin/configurations/view-config/(:any)', 'AdminController::viewConfiguration/$1', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/configurations/edit-config/(:any)', 'AdminController::editConfiguration/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/configurations/edit-config', 'AdminController::updateConfiguration');
        
        #CODES
        $routes->get('admin/codes', 'AdminController::codes', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/codes/new-code', 'AdminController::newCode', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/codes/new-code', 'AdminController::addCode');
        $routes->get('admin/codes/edit-code/(:any)', 'AdminController::editCode/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/codes/edit-code', 'AdminController::updateCode');
        
        #API-KEYS
        $routes->get('admin/api-keys', 'AdminController::apiKeys', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/api-keys/new-api-key', 'AdminController::newApiKey', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/api-keys/new-api-key', 'AdminController::addApiKey');
        $routes->get('admin/api-keys/edit-api-key/(:any)', 'AdminController::editApiKey/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('admin/api-keys/edit-api-key', 'AdminController::updateApiKey');
        
        #BACKUPS
        $routes->get('admin/backups', 'AdminController::backups', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/backups/generate-db-backup', 'AdminController::generateDbBackup', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/backups/download-db/(:any)', 'AdminController::downloadDbBackup/$1', ['filter' => 'adminRoleFilter']);
        $routes->get('admin/backups/download-public-folder-backup', 'AdminController::downloadPublicFolderBackup', ['filter' => 'adminRoleFilter']);        
    }


    if (isFeatureEnabled('FEATURE_ASK_AI')) {
        //Ask AI
        $routes->get('ask-ai', 'AIController::index');
    }

    if (isFeatureEnabled('FEATURE_PLUGINS')) {
        #####============================= PLUGINS MODULE (Has Admin Filter) =============================#####
        #PLUGINS
        $routes->get('plugins', 'PluginsController::index', ['filter' => 'adminRoleFilter']);
        $routes->get('plugins/configurations', 'PluginsController::pluginConfigurations', ['filter' => 'adminRoleFilter']);
        $routes->post('plugins/update-plugin-config', 'PluginsController::updatePluginConfig');
        $routes->get('plugins/install-plugins', 'PluginsController::installPlugins', ['filter' => 'adminRoleFilter']);
        $routes->get('plugins/upload-plugin', 'PluginsController::uploadPlugin', ['filter' => 'adminRoleFilter']);
        $routes->post('plugins/upload-plugin', 'PluginsController::addPlugin');
        $routes->get('plugins/activate-plugin/(:any)', 'PluginsController::activatePlugin/$1', ['filter' => 'adminRoleFilter']);
        $routes->get('plugins/deactivate-plugin/(:any)', 'PluginsController::deactivatePlugin/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('plugins/delete-plugin', 'PluginsController::deletePlugin');
        $routes->get('plugins/manage/(:any)', 'PluginsController::managePlugin/$1', ['filter' => 'adminRoleFilter']);
        $routes->post('plugins/manage/(:any)', 'PluginsController::managePluginPost/$1');
        $routes->get('plugins/instructions/(:any)', 'PluginsController::instructions/$1', ['filter' => 'adminRoleFilter']);
    }
}

    //ACCESS DENIED
    $routes->get('access-denied', 'AccessController::index');
});

//ADMIN SEARCH
$routes->get('search/modules', 'SearchController::searchModulesResult', ['filter' => 'authFilter']);

//HTMX REQUESTS
$routes->group('htmx', function($routes) {
    //USER REGISTRATIONS REQUESTS
    $routes->post('check-user-email-exists', 'HtmxController::userEmailExists');
    $routes->post('check-user-username-exists', 'HtmxController::userUsernameExists');
    $routes->post('check-password-is-valid', 'HtmxController::checkPasswordIsValid');
    $routes->post('check-passwords-match', 'HtmxController::checkPasswordsMatch');
    $routes->post('check-config-exists', 'HtmxController::configForExists');

    //CONTACT REQUESTS
    $routes->post('check-contact-number-exists', 'HtmxController::contactNumberExists');

    //CONTENT MANAGEMENT SYSTEM
    $routes->post('set-navigation-slug', 'HtmxController::setNavigationSlug');
    $routes->post('set-meta-title', 'HtmxController::setMetaTitle');
    $routes->post('set-meta-description', 'HtmxController::setSiteTitle');
    $routes->post('set-meta-keywords', 'HtmxController::setMetaKeywords');
    $routes->post('get-blog-title-slug', 'HtmxController::getBlogTitleSlug');
    $routes->post('get-page-title-slug', 'HtmxController::getPageTitleSlug');
    $routes->post('set-image-display', 'HtmxController::setImageDisplay');

    //AI REQUESTS
    #Blogs#
    $routes->post('get-excerpt-via-ai', 'HtmxController::getExcerptAI');
    $routes->post('get-tags-via-ai', 'HtmxController::setTagsAI');
    $routes->post('set-meta-title-via-ai', 'HtmxController::setMetaTitleAI');
    $routes->post('set-meta-description-via-ai', 'HtmxController::setSiteTitleAI');
    $routes->post('set-meta-keywords-via-ai', 'HtmxController::setMetaKeywordsAI');

    #Blog Categories#
    $routes->post('get-blog-category-description-via-ai', 'HtmxController::getBlogCategoryDescriptionAI');

    #Navigation#
    $routes->post('get-navigation-description-via-ai', 'HtmxController::getNavigationDescriptionAI');

    #Content Block#
    $routes->post('get-content-block-description-via-ai', 'HtmxController::getContentBlockDescriptionAI');

    #Get Icons#
    $routes->post('get-remix-icon-via-ai', 'HtmxController::getRemixIconAI');

    #Account Summary#
    $routes->post('get-account-summary-via-ai', 'HtmxController::getAccountSummaryAI');

    #Activity Logs Analysis#
    $routes->post('get-activity-logs-analysis-via-ai', 'HtmxController::getActivityLogsAnalysisAI');

    #Error Logs Analysis#
    $routes->post('get-error-logs-analysis-via-ai', 'HtmxController::getErrorLogsAnalysisAI');

    #Visit Stats Analysis#
    $routes->post('get-visit-stats-analysis-via-ai', 'HtmxController::getVisitStatsAnalysisAI');

    #Get AI Help Answer#
    $routes->post('get-ai-help-answer', 'HtmxController::getAIHelpAnswer');

    //ADMIN
    $routes->post('get-primary-color-name', 'HtmxController::getPrimaryColorName');
    $routes->post('get-secondary-color-name', 'HtmxController::getSecondaryColorName');
    $routes->post('get-background-color-name', 'HtmxController::getBackgroundColorName');
    $routes->post('set-message-read-status', 'HtmxController::setMessageReadStatus');
});

//SERVICES
$routes->group('services', function($routes) {
    $routes->post('remove-record', 'ServicesController::deleteService', ['filter' => 'authFilter']);
    $routes->post('remove-file', 'ServicesController::deleteFileService', ['filter' => 'authFilter']);
    $routes->post('remove-backup', 'ServicesController::deleteBackupService', ['filter' => 'authFilter']);
});


// API Endpoints
$routes->group('api', ['filter' => ['apiAccessFilter', 'corsFilter', 'rateLimitFilter']], function($routes) {
    // Generic Queries
    $routes->get('(:segment)/get-model-data', 'APIController::getModelData/$1');

    // Generic Plugin Queries
    $routes->get('(:segment)/get-plugin-data', 'APIController::getPluginData/$1');

    // Generic Plugin Add
    $routes->post('(:segment)/add-plugin-data', 'APIController::addPluginData/$1');

    // Generic Plugin Update
    $routes->post('(:segment)/update-plugin-data', 'APIController::updatePluginData/$1');

    // Generic Plugin Delete
    $routes->post('(:segment)/delete-plugin-data', 'APIController::deletePluginData/$1');
});


$frontEndFormat = getConfigData("FrontEndFormat");
if(strtolower($frontEndFormat) === "mvc")
{
    if (isFeatureEnabled('FEATURE_FRONT_END')) {
        //FRONT END CONTROLLER
        $routes->get('/', 'FrontEndController::index', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        //HOME
        $routes->group('home', ['filter' => ['siteStatsFilter','pluginsFilter']], function($routes) {
            $routes->get('/', 'FrontEndController::index');
        });

        #Blogs
        $routes->get('/blog/(:any)', 'FrontEndController::getBlogDetails/$1', ['filter' => ['siteStatsFilter','pluginsFilter']]);
        $routes->get('/blog', function() {
            return redirect()->to('/blogs'); 
        });
        $routes->get('/blogs', 'FrontEndController::getBlogs', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        #Search
        $routes->get('search', 'FrontEndController::searchResults', ['filter' => ['siteStatsFilter','pluginsFilter']]);
        $routes->get('/search/filter', 'FrontEndController::getSearchFilter', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        #Sitemap
        $routes->get('sitemap.xml', 'FrontEndController::getSitemaps', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        // Redirect other sitemap URLs to 'sitemap.xml'
        $routes->get('sitemap', function() {
            return redirect()->to('sitemap.xml');
        });

        $routes->get('sitemap.html', function() {
            return redirect()->to('sitemap.xml');
        });

        $routes->get('sitemap_index.xml', function() {
            return redirect()->to('sitemap.xml');
        });

        #Robots.txt
        $routes->get('robots.txt', 'FrontEndController::getRobotsTxt', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        #RSS
        $routes->get('rss', 'FrontEndController::getRssFeed', ['filter' => ['siteStatsFilter','pluginsFilter']]);

        #Pages - Placed button to avoid conflict with '/blogs', '/search'
        $routes->get('/(:segment)', 'FrontEndController::getPageDetails/$1', ['filter' => ['siteStatsFilter','pluginsFilter']]);
    }
}
else{
    if (isFeatureEnabled('FEATURE_FRONT_END')) {
        //Return api data
        return "[]";
    }
}