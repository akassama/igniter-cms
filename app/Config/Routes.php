<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
*/

//SIGN-IN
$routes->group('sign-in', ['filter' => ['siteStatsFilter','guestFilter']], function($routes) {
    $routes->get('/', 'SignInController::index');
    $routes->post('/', 'SignInController::login');
});

//SIGN-UP
$routes->group('sign-up', ['filter' => ['siteStatsFilter']], function($routes) {
    $routes->get('/', 'SignUpController::index');
    $routes->post('/', 'SignUpController::addRegistration');
});

//SIGN-OUT
$routes->get('/sign-out', 'SignOutController::index');

//FORGOT-PASSWORD
$routes->group('forgot-password', ['filter' => ['siteStatsFilter','guestFilter']], function($routes) {
    $routes->get('/', 'ForgotPasswordController::index');
    $routes->post('/', 'ForgotPasswordController::sendResetLinkEmail');
});

//PASSWORD-RESET
$routes->group('password-reset', ['filter' => ['siteStatsFilter','guestFilter']], function($routes) {
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
$routes->group('account', ['filter' => 'authFilter'], function($routes) {
    //DASHBOARD
    $routes->get('dashboard', 'DashboardController::index');

    //CONTACTS
    $routes->get('contacts', 'ContactsController::index');
    $routes->get('contacts/new-contact', 'ContactsController::newContact');
    $routes->post('contacts/new-contact', 'ContactsController::addContact');
    $routes->get('contacts/view-contact/(:any)', 'ContactsController::viewContact/$1');
    $routes->get('contacts/edit-contact/(:any)', 'ContactsController::editContact/$1');
    $routes->post('contacts/edit-contact', 'ContactsController::updateContact');

    //SETTINGS
    $routes->get('settings', 'SettingsController::index');
    $routes->get('settings/update-details', 'SettingsController::updateDetails');
    $routes->post('settings/update-details/update-user', 'SettingsController::updateUser');
    $routes->get('settings/change-password', 'SettingsController::changePassword');
    $routes->post('settings/change-password/update-password', 'SettingsController::updatePassword');

    //FILE MANAGER
    $routes->get('file-manager', 'FileManagerController::index');
    $routes->get('file-manager/upload-file', 'FileManagerController::newUpload');
    $routes->post('file-manager/upload-file', 'FileManagerController::uploadFile');
    $routes->get('file-manager/add-file-url', 'FileManagerController::newUrlUpload');
    $routes->post('file-manager/add-file-url', 'FileManagerController::uploadUrlFile');
    $routes->post('file-manager/edit-image', 'FileManagerController::editImage');
    $routes->get('file-manager/download/(:any)', 'FileManagerController::downloadFile/$1');

    //ADMIN
    $routes->get('admin', 'AdminController::index', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/users', 'AdminController::users', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/users/new-user', 'AdminController::newUser', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/users/new-user', 'AdminController::addUser');
    $routes->get('admin/users/edit-user/(:any)', 'AdminController::editUser/$1', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/users/edit-user', 'AdminController::updateUser');
    $routes->get('admin/users/view-user/(:any)', 'AdminController::viewUser/$1', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/subscribers', 'AdminController::subscribers', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/contact-messages', 'AdminController::contactMessages', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/contact-messages/view-contact/(:any)', 'AdminController::viewContactMessage/$1', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/activity-logs', 'AdminController::activityLogs', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/activity-logs/view-activity/(:any)', 'AdminController::viewActivity/$1');
    $routes->get('admin/logs', 'AdminController::viewLogFiles', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/logs/view-log/(:any)', 'AdminController::viewLogData/$1');
    $routes->get('admin/visit-stats', 'AdminController::viewStats', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/visit-stats/view-stat/(:any)', 'AdminController::viewStat/$1');
    $routes->get('admin/blocked-ips', 'AdminController::blockedIps', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/blocked-ips/new-blocked-ip', 'AdminController::newBlockedIP', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/blocked-ips/new-blocked-ip', 'AdminController::addBlockedIP');
    $routes->get('admin/whitelisted-ips', 'AdminController::whitelistedIps', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/whitelisted-ips/new-whitelisted-ip', 'AdminController::newWhitelistedIP', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/whitelisted-ips/new-whitelisted-ip', 'AdminController::addWhitelistedIP');
    $routes->get('admin/configurations', 'AdminController::configurations', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/configurations/new-config', 'AdminController::newConfiguration', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/configurations/new-config', 'AdminController::addConfiguration');
    $routes->get('admin/configurations/view-config/(:any)', 'AdminController::viewConfiguration/$1', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/configurations/edit-config/(:any)', 'AdminController::editConfiguration/$1', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/configurations/edit-config', 'AdminController::updateConfiguration');
    $routes->get('admin/codes', 'AdminController::codes', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/codes/new-code', 'AdminController::newCode', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/codes/new-code', 'AdminController::addCode');
    $routes->get('admin/codes/edit-code/(:any)', 'AdminController::editCode/$1', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/codes/edit-code', 'AdminController::updateCode');
    $routes->get('admin/themes', 'AdminController::themes', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/themes/new-theme', 'AdminController::newTheme', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/themes/new-theme', 'AdminController::addTheme');
    $routes->get('admin/themes/edit-theme/(:any)', 'AdminController::editTheme/$1', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/themes/edit-theme', 'AdminController::updateTheme');
    $routes->get('admin/themes/edit-theme-home-page/(:any)', 'AdminController::editThemeHomePage/$1', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/api-keys', 'AdminController::apiKeys', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/api-keys/new-api-key', 'AdminController::newApiKey', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/api-keys/new-api-key', 'AdminController::addApiKey');
    $routes->get('admin/api-keys/edit-api-key/(:any)', 'AdminController::editApiKey/$1', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/api-keys/edit-api-key', 'AdminController::updateApiKey');
    $routes->get('admin/translations', 'AdminController::translations', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/translations/new-translation', 'AdminController::newTranslation', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/translations/new-translation', 'AdminController::addTranslation');
    $routes->get('admin/backups', 'AdminController::backups', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/backups/generate-db-backup', 'AdminController::generateDbBackup', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/backups/download-db/(:any)', 'AdminController::downloadDbBackup/$1', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/backups/download-public-folder-backup', 'AdminController::downloadPublicFolderBackup', ['filter' => 'adminRoleFilter']);
    //file editors
    $routes->get('admin/file-editor', 'AdminController::viewFiles', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/layout', 'AdminController::layoutFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/home', 'AdminController::homeFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/blogs', 'AdminController::blogsFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-blog', 'AdminController::viewBlogFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/contact', 'AdminController::contactFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/events', 'AdminController::eventsFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-event', 'AdminController::viewEventFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-page', 'AdminController::viewPageFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/portfolios', 'AdminController::portfoliosFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-portfolio', 'AdminController::viewPortfolioFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/donations', 'AdminController::donationsFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-donation', 'AdminController::viewDonationFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/shops', 'AdminController::shopsFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/view-shop', 'AdminController::viewShopFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/search', 'AdminController::searchFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/search-filter', 'AdminController::searchFilterFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->get('admin/file-editor/sitemap', 'AdminController::sitemapFileEditor', ['filter' => 'adminRoleFilter']);
    $routes->post('admin/file-editor/save-file', 'AdminController::saveFile');

    //CMS
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

    #CMS-HOME-PAGE
    $routes->get('cms/home-page', 'CMSController::homePage');
    $routes->get('cms/home-page/view-home-page-section/(:any)', 'CMSController::viewHomePageSection/$1');
    $routes->get('cms/home-page/edit-home-page-section/(:any)', 'CMSController::editHomePageSection/$1');
    $routes->post('cms/home-page/edit-home-page-section', 'CMSController::updateHomePageSection');

    #CMS-PAGES
    $routes->get('cms/pages', 'CMSController::pages');
    $routes->get('cms/pages/new-page', 'CMSController::newPage');
    $routes->post('cms/pages/new-page', 'CMSController::addPage');
    $routes->get('cms/pages/view-page/(:any)', 'CMSController::viewPage/$1');
    $routes->get('cms/pages/edit-page/(:any)', 'CMSController::editPage/$1');
    $routes->post('cms/pages/edit-page', 'CMSController::updatePage');

    #CMS-CONTENT BLOCKS
    $routes->get('cms/content-blocks', 'CMSController::contentBlocks');
    $routes->get('cms/content-blocks/new-content-block', 'CMSController::newContentBlock');
    $routes->post('cms/content-blocks/new-content-block', 'CMSController::addContentBlock');
    $routes->get('cms/content-blocks/view-content-block/(:any)', 'CMSController::viewContentBlock/$1');
    $routes->get('cms/content-blocks/edit-content-block/(:any)', 'CMSController::editContentBlock/$1');
    $routes->post('cms/content-blocks/edit-content-block', 'CMSController::updateContentBlock');

    #CMS-EVENTS
    $routes->get('cms/events', 'CMSController::events');
    $routes->get('cms/events/new-event', 'CMSController::newEvent');
    $routes->post('cms/events/new-event', 'CMSController::addEvent');
    $routes->get('cms/events/view-event/(:any)', 'CMSController::viewEvent/$1');
    $routes->get('cms/events/edit-event/(:any)', 'CMSController::editEvent/$1');
    $routes->post('cms/events/edit-event', 'CMSController::updateEvent');

    #CMS-PORTFOLIO
    $routes->get('cms/portfolios', 'CMSController::portfolios');
    $routes->get('cms/portfolios/new-portfolio', 'CMSController::newPortfolio');
    $routes->post('cms/portfolios/new-portfolio', 'CMSController::addPortfolio');
    $routes->get('cms/portfolios/view-portfolio/(:any)', 'CMSController::viewPortfolio/$1');
    $routes->get('cms/portfolios/edit-portfolio/(:any)', 'CMSController::editPortfolio/$1');
    $routes->post('cms/portfolios/edit-portfolio', 'CMSController::updatePortfolio');

    #CMS-COUNTERS
    $routes->get('cms/counters', 'CMSController::counters');
    $routes->get('cms/counters/new-counter', 'CMSController::newCounter');
    $routes->post('cms/counters/new-counter', 'CMSController::addCounter');
    $routes->get('cms/counters/view-counter/(:any)', 'CMSController::viewCounter/$1');
    $routes->get('cms/counters/edit-counter/(:any)', 'CMSController::editCounter/$1');
    $routes->post('cms/counters/edit-counter', 'CMSController::updateCounter');

    #CMS-SERVICES
    $routes->get('cms/services', 'CMSController::services');
    $routes->get('cms/services/new-service', 'CMSController::newService');
    $routes->post('cms/services/new-service', 'CMSController::addService');
    $routes->get('cms/services/view-service/(:any)', 'CMSController::viewService/$1');
    $routes->get('cms/services/edit-service/(:any)', 'CMSController::editService/$1');
    $routes->post('cms/services/edit-service', 'CMSController::updateService');

    #CMS-PARTNERS
    $routes->get('cms/partners', 'CMSController::partners');
    $routes->get('cms/partners/new-partner', 'CMSController::newPartner');
    $routes->post('cms/partners/new-partner', 'CMSController::addPartner');
    $routes->get('cms/partners/view-partner/(:any)', 'CMSController::viewPartner/$1');
    $routes->get('cms/partners/edit-partner/(:any)', 'CMSController::editPartner/$1');
    $routes->post('cms/partners/edit-partner', 'CMSController::updatePartner');

    #CMS-SOCIALS
    $routes->get('cms/socials', 'CMSController::socials');
    $routes->get('cms/socials/new-social', 'CMSController::newSocial');
    $routes->post('cms/socials/new-social', 'CMSController::addSocial');
    $routes->get('cms/socials/view-social/(:any)', 'CMSController::viewSocial/$1');
    $routes->get('cms/socials/edit-social/(:any)', 'CMSController::editSocial/$1');
    $routes->post('cms/socials/edit-social', 'CMSController::updateSocial');

    #PRICINGS
    $routes->get('cms/pricings', 'CMSController::pricings');
    $routes->get('cms/pricings/new-pricing', 'CMSController::newPricing');
    $routes->post('cms/pricings/new-pricing', 'CMSController::addPricing');
    $routes->get('cms/pricings/view-pricing/(:any)', 'CMSController::viewPricing/$1');
    $routes->get('cms/pricings/edit-pricing/(:any)', 'CMSController::editPricing/$1');
    $routes->post('cms/pricings/edit-pricing', 'CMSController::updatePricing');

    //TEAMS
    $routes->get('cms/teams', 'CMSController::teams');
    $routes->get('cms/teams/new-team', 'CMSController::newTeam');
    $routes->post('cms/teams/new-team', 'CMSController::addTeam');
    $routes->get('cms/teams/view-team/(:any)', 'CMSController::viewTeam/$1');
    $routes->get('cms/teams/edit-team/(:any)', 'CMSController::editTeam/$1');
    $routes->post('cms/teams/edit-team', 'CMSController::updateTeam');

    //FAQs
    $routes->get('cms/faqs', 'CMSController::faqs');
    $routes->get('cms/faqs/new-faq', 'CMSController::newFaq');
    $routes->post('cms/faqs/new-faq', 'CMSController::addFaq');
    $routes->get('cms/faqs/view-faq/(:any)', 'CMSController::viewFaq/$1');
    $routes->get('cms/faqs/edit-faq/(:any)', 'CMSController::editFaq/$1');
    $routes->post('cms/faqs/edit-faq', 'CMSController::updateFaq');

    //DONATION CAUSES
    $routes->get('cms/donation-causes', 'CMSController::donationCauses');
    $routes->get('cms/donation-causes/new-donation-cause', 'CMSController::newDonationCause');
    $routes->post('cms/donation-causes/new-donation-cause', 'CMSController::addDonationCause');
    $routes->get('cms/donation-causes/view-donation-cause/(:any)', 'CMSController::viewDonationCause/$1');
    $routes->get('cms/donation-causes/edit-donation-cause/(:any)', 'CMSController::editDonationCause/$1');
    $routes->post('cms/donation-causes/edit-donation-cause', 'CMSController::updateDonationCause');

    #TESTIMONIAL
    $routes->get('cms/testimonials', 'CMSController::testimonials');
    $routes->get('cms/testimonials/new-testimonial', 'CMSController::newTestimonial');
    $routes->post('cms/testimonials/new-testimonial', 'CMSController::addTestimonial');
    $routes->get('cms/testimonials/view-testimonial/(:any)', 'CMSController::viewTestimonial/$1');
    $routes->get('cms/testimonials/edit-testimonial/(:any)', 'CMSController::editTestimonial/$1');
    $routes->post('cms/testimonials/edit-testimonial', 'CMSController::updateTestimonial');

    //POPUP
    $routes->get('cms/popups', 'CMSController::popups');
    $routes->get('cms/popups/view-popup/(:any)', 'CMSController::viewPopup/$1');
    $routes->get('cms/popups/edit-popup/(:any)', 'CMSController::editPopup/$1');
    $routes->post('cms/popups/edit-popup', 'CMSController::updatePopup');

    //RESUMES
    $routes->get('resumes', 'ResumeController::index');
    $routes->get('resumes/manage-resumes', 'ResumeController::manageResumes');
    $routes->get('resumes/new-resume', 'ResumeController::newResume');
    $routes->post('resumes/new-resume', 'ResumeController::addResume');
    $routes->get('resumes/view-resume/(:any)', 'ResumeController::viewResume/$1');
    $routes->get('resumes/edit-resume/(:any)', 'ResumeController::editResume/$1');
    $routes->post('resumes/edit-resume', 'ResumeController::updateResume');
    //
    $routes->get('resumes/manage-experiences', 'ResumeController::manageExperiences');
    $routes->get('resumes/new-experience', 'ResumeController::newExperience');
    $routes->post('resumes/new-experience', 'ResumeController::addExperience');
    $routes->get('resumes/view-experience/(:any)', 'ResumeController::viewExperience/$1');
    $routes->get('resumes/edit-experience/(:any)', 'ResumeController::editExperience/$1');
    $routes->post('resumes/edit-experience', 'ResumeController::updateExperience');
    //
    $routes->get('resumes/manage-educations', 'ResumeController::manageEducations');
    $routes->get('resumes/new-education', 'ResumeController::newEducation');
    $routes->post('resumes/new-education', 'ResumeController::addEducation');
    $routes->get('resumes/view-education/(:any)', 'ResumeController::viewEducation/$1');
    $routes->get('resumes/edit-education/(:any)', 'ResumeController::editEducation/$1');
    $routes->post('resumes/edit-education', 'ResumeController::updateEducation');
    //
    $routes->get('resumes/manage-skills', 'ResumeController::manageSkills');
    $routes->get('resumes/new-skill', 'ResumeController::newSkill');
    $routes->post('resumes/new-skill', 'ResumeController::addSkill');
    $routes->get('resumes/view-skill/(:any)', 'ResumeController::viewSkill/$1');
    $routes->get('resumes/edit-skill/(:any)', 'ResumeController::editSkill/$1');
    $routes->post('resumes/edit-skill', 'ResumeController::updateSkill');

    //ECommerce
    $routes->get('ecommerce', 'EcommerceController::index');

    //Products
    $routes->get('ecommerce/products', 'EcommerceController::products');
    $routes->get('ecommerce/products/new-product', 'EcommerceController::newProduct');
    $routes->post('ecommerce/products/new-product', 'EcommerceController::addProduct');
    $routes->get('ecommerce/products/view-product/(:any)', 'EcommerceController::viewProduct/$1');
    $routes->get('ecommerce/products/edit-product/(:any)', 'EcommerceController::editProduct/$1');
    $routes->post('ecommerce/products/edit-product', 'EcommerceController::updateProduct');

    //Product Categories
    $routes->get('ecommerce/product-categories', 'EcommerceController::productCategories');
    $routes->get('ecommerce/product-categories/new-product-category', 'EcommerceController::newProductCategory');
    $routes->post('ecommerce/product-categories/new-product-category', 'EcommerceController::addProductCategory');
    $routes->get('ecommerce/product-categories/view-product-category/(:any)', 'EcommerceController::viewProductCategory/$1');
    $routes->get('ecommerce/product-categories/edit-product-category/(:any)', 'EcommerceController::editProductCategory/$1');
    $routes->post('ecommerce/product-categories/edit-product-category', 'EcommerceController::updateProductCategory');

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
    $routes->post('set-meta-description', 'HtmxController::setMetaDescription');
    $routes->post('set-meta-keywords', 'HtmxController::setMetaKeywords');
    $routes->post('get-blog-title-slug', 'HtmxController::getBlogTitleSlug');
    $routes->post('get-page-title-slug', 'HtmxController::getPageTitleSlug');
    $routes->post('get-event-title-slug', 'HtmxController::getEventTitleSlug');
    $routes->post('get-portfolio-title-slug', 'HtmxController::getPortfolioTitleSlug');
    $routes->post('get-product-title-slug', 'HtmxController::getProductTitleSlug');
    $routes->post('get-donation-title-slug', 'HtmxController::getDonationTitleSlug');
    $routes->post('set-image-display', 'HtmxController::setImageDisplay');
    $routes->get('get-file-data-form/(:any)', 'HtmxController::getFileDataForm/$1');
    $routes->post('update-file-data-form/(:any)', 'HtmxController::updateFileDataList/$1');
    $routes->get('cancel-file-data-form/(:any)', 'HtmxController::getFileDataList/$1');

    //ADMIN
    $routes->post('get-primary-color-name', 'HtmxController::getPrimaryColorName');
    $routes->post('get-secondary-color-name', 'HtmxController::getSecondaryColorName');
    $routes->post('get-other-color-name', 'HtmxController::getOtherColorName');
    $routes->post('set-message-read-status', 'HtmxController::setMessageReadStatus');
});

//SERVICES
$routes->group('services', function($routes) {
    $routes->post('remove-record', 'ServicesController::deleteService', ['filter' => 'authFilter']);
    $routes->post('remove-file', 'ServicesController::deleteFileService', ['filter' => 'authFilter']);
    $routes->post('remove-backup', 'ServicesController::deleteBackupService', ['filter' => 'authFilter']);
});

//CRON JOBS
$routes->get("cron/daily-jobs/(:any)", "BackgroundController::dailyJobs/$1");
$routes->get("cron/monday-jobs/(:any)", "BackgroundController::mondayJobs/$1");
if (file_exists(ROOTPATH . 'vendor/daycry/cronjob/src/Config/Routes.php')) {
    require ROOTPATH . 'vendor/daycry/cronjob/src/Config/Routes.php';
}

//API Endpoints
$routes->group('api', ['filter' => ['apiAccessFilter','corsFilter']],  function($routes) {
    //Generic Queries
    $routes->get('(:segment)/get-model-data', 'APIController::getModelData/$1');

    //Home Page
    $routes->get('(:segment)/get-home-page', 'APIController::getHomePage/$1');

    //Blog
    $routes->get('(:segment)/get-blog/(:segment)', 'APIController::getBlog/$1/$2');
    $routes->get('(:segment)/get-blogs', 'APIController::getBlogs/$1');
    $routes->get('(:segment)/get-all-blogs', 'APIController::getAllBlogs/$1');

    //Page
    $routes->get('(:segment)/get-page/(:segment)', 'APIController::getPage/$1/$2');
    $routes->get('(:segment)/get-pages', 'APIController::getPages/$1');
    $routes->get('(:segment)/get-all-pages', 'APIController::getAllPages/$1');

    //Navigations
    $routes->get('(:segment)/get-navigation/(:segment)', 'APIController::getNavigation/$1/$2');
    $routes->get('(:segment)/get-navigations', 'APIController::getNavigations/$1');

    //Category
    $routes->get('(:segment)/get-category/(:segment)', 'APIController::getCategory/$1/$2');
    $routes->get('(:segment)/get-categories', 'APIController::getCategories/$1');

    // Codes
    $routes->get('(:segment)/get-code/(:segment)', 'APIController::getCode/$1/$2');
    $routes->get('(:segment)/get-codes', 'APIController::getCodes/$1');
    
    // Content Blocks
    $routes->get('(:segment)/get-content-block/(:segment)', 'APIController::getContentBlock/$1/$2');
    $routes->get('(:segment)/get-content-blocks', 'APIController::getContentBlocks/$1');
    
    // Counters
    $routes->get('(:segment)/get-counter/(:segment)', 'APIController::getCounter/$1/$2');
    $routes->get('(:segment)/get-counters', 'APIController::getCounters/$1');

    // Services
    $routes->get('(:segment)/get-service/(:segment)', 'APIController::getService/$1/$2');
    $routes->get('(:segment)/get-services', 'APIController::getServices/$1');

    // Partners
    $routes->get('(:segment)/get-partner/(:segment)', 'APIController::getPartner/$1/$2');
    $routes->get('(:segment)/get-partners', 'APIController::getPartners/$1');
    
    // Countries
    $routes->get('(:segment)/get-country/(:segment)', 'APIController::getCountry/$1/$2');
    $routes->get('(:segment)/get-countries', 'APIController::getCountries/$1');
    
    // Events
    $routes->get('(:segment)/get-event/(:segment)', 'APIController::getEvent/$1/$2');
    $routes->get('(:segment)/get-events', 'APIController::getEvents/$1');
    
    // FAQs
    $routes->get('(:segment)/get-faq/(:segment)', 'APIController::getFaq/$1/$2');
    $routes->get('(:segment)/get-faqs', 'APIController::getFaqs/$1');
    
    // Languages
    $routes->get('(:segment)/get-language/(:segment)', 'APIController::getLanguage/$1/$2');
    $routes->get('(:segment)/get-languages', 'APIController::getLanguages/$1');
    
    // Pricings
    $routes->get('(:segment)/get-pricing/(:segment)', 'APIController::getPricing/$1/$2');
    $routes->get('(:segment)/get-pricings', 'APIController::getPricings/$1');
    
    // Portfolios
    $routes->get('(:segment)/get-portfolio/(:segment)', 'APIController::getPortfolio/$1/$2');
    $routes->get('(:segment)/get-portfolios', 'APIController::getPortfolios/$1');
    
    // Socials
    $routes->get('(:segment)/get-social/(:segment)', 'APIController::getSocial/$1/$2');
    $routes->get('(:segment)/get-socials', 'APIController::getSocials/$1');
    
    // Teams
    $routes->get('(:segment)/get-team/(:segment)', 'APIController::getTeam/$1/$2');
    $routes->get('(:segment)/get-teams', 'APIController::getTeams/$1');
    
    // Testimonials
    $routes->get('(:segment)/get-testimonial/(:segment)', 'APIController::getTestimonial/$1/$2');
    $routes->get('(:segment)/get-testimonials', 'APIController::getTestimonials/$1');
    
    // Themes
    $routes->get('(:segment)/get-theme/(:segment)', 'APIController::getTheme/$1/$2');
    $routes->get('(:segment)/get-themes', 'APIController::getThemes/$1');
    
    // Translations
    $routes->get('(:segment)/get-translation/(:segment)', 'APIController::getTranslation/$1/$2');
    $routes->get('(:segment)/get-translations', 'APIController::getTranslations/$1');
    
    // Products
    $routes->get('(:segment)/get-product/(:segment)', 'APIController::getProduct/$1/$2');
    $routes->get('(:segment)/get-products', 'APIController::getProducts/$1');
    
    // Product Categories
    $routes->get('(:segment)/get-product-category/(:segment)', 'APIController::getProductCategories/$1/$2');
    $routes->get('(:segment)/get-product-categories', 'APIController::getProductCategories/$1');
    
    // Resumes
    $routes->get('(:segment)/get-resume/(:segment)', 'APIController::getResume/$1/$2');
    $routes->get('(:segment)/get-resumes', 'APIController::getResumes/$1');
    
    // Announcement Popups
    $routes->get('(:segment)/get-popup/(:segment)', 'APIController::getPopupAnnouncement/$1/$2');
    $routes->get('(:segment)/get-popups', 'APIController::getPopupAnnouncements/$1');
    
    // Donation Causes
    $routes->get('(:segment)/get-donation-cause/(:segment)', 'APIController::getDonationCause/$1/$2');
    $routes->get('(:segment)/get-donation-causes', 'APIController::getDonationCauses/$1');
    
    // Add Contact Message
    $routes->post('send-contact-message', 'APIController::sendContactMessage');
    
    // Add Subscription
    $routes->post('add-subscriber', 'APIController::addSubscription');

    // Search
    $routes->get('(:segment)/search-results', 'APIController::searchResults/$1');
    $routes->get('(:segment)/model-search-results', 'APIController::modelSearchResults/$1');
    $routes->get('(:segment)/filter-search-results', 'APIController::filterSearchResults/$1');
});


$frontEndFormat = getConfigData("FrontEndFormat");
if(strtolower($frontEndFormat) === "mvc")
{
    //FRONT END CONTROLLER
    $routes->get('/', 'FrontEndController::index', ['filter' => ['siteStatsFilter']]);

    //HOME
    $routes->group('home', ['filter' => 'siteStatsFilter'], function($routes) {
        $routes->get('/', 'FrontEndController::index');
    });

    #Blogs
    $routes->get('/blog/(:any)', 'FrontEndController::getBlogDetails/$1', ['filter' => ['siteStatsFilter']]);
    $routes->get('/blog', function() {
        return redirect()->to('/blogs'); 
    });
    $routes->get('/blogs', 'FrontEndController::getBlogs', ['filter' => ['siteStatsFilter']]);

    #Event
    $routes->get('/event/(:segment)', 'FrontEndController::getEventDetails/$1', ['filter' => ['siteStatsFilter']]);
    $routes->get('/event', function() {
        return redirect()->to('/events'); 
    });
    $routes->get('/events', 'FrontEndController::getEvents', ['filter' => ['siteStatsFilter']]);

    #Portfolio
    $routes->get('/portfolio/(:segment)', 'FrontEndController::getPortfolioDetails/$1', ['filter' => ['siteStatsFilter']]);
    $routes->get('/portfolio', function() {
        return redirect()->to('/portfolios'); 
    });
    $routes->get('/portfolios', 'FrontEndController::getPortfolios', ['filter' => ['siteStatsFilter']]);

    #Donate
    $routes->get('/donate/(:any)', 'FrontEndController::getDonationCampaingDetails/$1', ['filter' => ['siteStatsFilter']]);
    $routes->get('/campaings', function() {
        return redirect()->to('/donate'); 
    });
    $routes->get('/donate', 'FrontEndController::getDonationCampaings', ['filter' => ['siteStatsFilter']]);

    #Shop
    $routes->get('/shop/(:segment)', 'FrontEndController::getProductDetails/$1', ['filter' => ['siteStatsFilter']]);
    $routes->get('/shop', 'FrontEndController::getProducts', ['filter' => ['siteStatsFilter']]);

    #Contact
    $routes->get('/contact', 'FrontEndController::getContactForm', ['filter' => ['siteStatsFilter']]);

    #Search
    $routes->get('search', 'FrontEndController::searchResults', ['filter' => ['siteStatsFilter']]);
    $routes->get('/search/filter', 'FrontEndController::getSearchFilter', ['filter' => ['siteStatsFilter']]);

    #Sitemap
    $routes->get('sitemap.xml', 'FrontEndController::getSitemaps', ['filter' => ['siteStatsFilter']]);

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
    $routes->get('robots.txt', 'FrontEndController::getRobotsTxt', ['filter' => ['siteStatsFilter']]);

    #RSS
    $routes->get('rss', 'FrontEndController::getRssFeed', ['filter' => ['siteStatsFilter']]);

    #Pages - Placed button to avoid conflict with '/blogs', '/events', '/portfolios', '/search'
    $routes->get('/(:segment)', 'FrontEndController::getPageDetails/$1', ['filter' => ['siteStatsFilter']]);
}
else{
    //Get Homepage as JSON
    $routes->get('/', 'APIController::getHomePageData', ['filter' => ['siteStatsFilter']]);
}