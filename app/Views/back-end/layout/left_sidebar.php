<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function() {
        // After 0.2 seconds, execute the following code
        setTimeout(function() {
            // Get the current URL
            const current_url = window.location.href;

            // Check if the URL contains "account/cms"
            if (current_url.includes("account/cms")) {
                // Click the button with id "cmsButton"
                document.getElementById("cmsButton").click();
            }
            else if (current_url.includes("account/policies")) {
                // Click the button with id "policiesButton"
                document.getElementById("policiesButton").click();
            }
            else if (current_url.includes("account/resumes")) {
                // Click the button with id "resumesButton"
                document.getElementById("resumesButton").click();
            }
            else if (current_url.includes("account/ecommerce")) {
                // Click the button with id "ecommerceButton"
                document.getElementById("ecommerceButton").click();
            }
            else if (current_url.includes("account/knowledge-base")) {
                // Click the button with id "knowledgeBaseButton"
                document.getElementById("knowledgeBaseButton").click();
            }
            else if (current_url.includes("account/settings")) {
                // Click the button with id "settingsButton"
                document.getElementById("settingsButton").click();
            }
            else if (current_url.includes("account/admin")) {
                // Click the button with id "adminButton"
                document.getElementById("adminButton").click();
            }
            // Else, do nothing
        }, 200); // 200 milliseconds = 0.2 seconds
    });
</script>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link <?= (str_contains(current_url(), 'account/dashboard')) ? 'active' : ''; ?>" href="<?= base_url('/account'); ?>">
                    <div class="sb-nav-link-icon"><i class="ri-dashboard-line h5"></i></div>
                    Dashboard
                </a>
                <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/cms')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCMS" aria-expanded="false" aria-controls="collapseCMS" id="cmsButton">
                    <div class="sb-nav-link-icon"><i class="ri-draft-line h5"></i></div>
                    CMS
                    <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                </a>
                <div class="collapse" id="collapseCMS" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/blogs')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/blogs'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Blogs
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/categories')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/categories'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Categories
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/navigations')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/navigations'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Navigations
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/pages')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/pages'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Pages
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/home-page')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/home-page'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Home Page
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/content-blocks')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/content-blocks'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Content Blocks
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/events')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/events'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Events
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/portfolios')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/portfolios'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Portfolios
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/services')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/services'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Services
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/partners')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/partners'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Partners
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/counters')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/counters'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Counters
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/socials')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/socials'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Socials
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/pricings')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/pricings'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Pricings
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/teams')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/teams'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Teams
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/testimonials')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/testimonials'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Testimonials
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/faqs')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/faqs'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> FAQs
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/donation-causes')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/donation-causes'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Donations
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/popups')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/popups'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Popups
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/cms/policies')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/policies'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Policies
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/ecommerce')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseECommerce" aria-expanded="false" aria-controls="collapseECommerce" id="ecommerceButton">
                    <div class="sb-nav-link-icon"><i class="ri-shopping-bag-4-fill h5"></i></div>
                    E-Commerce
                    <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                </a>
                <div class="collapse" id="collapseECommerce" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= (str_contains(current_url(), 'account/ecommerce/products')) ? 'active' : ''; ?>" href="<?= base_url('/account/ecommerce/products'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Products
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/ecommerce/product-categories')) ? 'active' : ''; ?>" href="<?= base_url('/account/ecommerce/product-categories'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Categories
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/resumes')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseResumes" aria-expanded="false" aria-controls="collapseResumes" id="resumesButton">
                    <div class="sb-nav-link-icon"><i class="ri-profile-line h5"></i></div>
                    Resumes
                    <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                </a>
                <div class="collapse" id="collapseResumes" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= (str_contains(current_url(), 'account/resumes/manage-resumes')) ? 'active' : ''; ?>" href="<?= base_url('/account/resumes/manage-resumes'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Manage Resumes
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/resumes/manage-experiences')) ? 'active' : ''; ?>" href="<?= base_url('/account/resumes/manage-experiences'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Manage Experiences
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/resumes/manage-educations')) ? 'active' : ''; ?>" href="<?= base_url('/account/resumes/manage-educations'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Manage Education
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/resumes/manage-skills')) ? 'active' : ''; ?>" href="<?= base_url('/account/resumes/manage-skills'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Manage Skills
                        </a>
                    </nav>
                </div>
                <a class="nav-link <?= (str_contains(current_url(), 'account/file-manager')) ? 'active' : ''; ?>" href="<?= base_url('/account/file-manager'); ?>">
                    <div class="sb-nav-link-icon"><i class="ri-folder-open-line h5"></i></div>
                    File Manager
                </a>
                <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/settings')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings" id="settingsButton">
                    <div class="sb-nav-link-icon"><i class="ri-settings-2-line h5"></i></div>
                    Settings
                    <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                </a>
                <div class="collapse" id="collapseSettings" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= (str_contains(current_url(), 'account/settings/update-details')) ? 'active' : ''; ?>" href="<?= base_url('/account/settings/update-details'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Update Details
                        </a>
                        <a class="nav-link <?= (str_contains(current_url(), 'account/settings/change-password')) ? 'active' : ''; ?>" href="<?= base_url('/account/settings/change-password'); ?>">
                            <i class="ri-arrow-drop-right-fill"></i> Change Password
                        </a>
                    </nav>
                </div>
                <?php if ($userRole == "Admin"): ?>
                    <!--Admin Views-->
                    <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/admin')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin" id="adminButton">
                        <div class="sb-nav-link-icon"><i class="ri-user-settings-fill h5"></i></div>
                        Admin
                        <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                    </a>
                    <div class="collapse" id="collapseAdmin" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/users')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/users'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Users
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/translations')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/translations'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Translations
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/configurations')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/configurations'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Configurations
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/codes')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/codes'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Codes
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/themes')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/themes'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Themes
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/api-keys')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/api-keys'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> API Keys
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/activity-logs')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/activity-logs'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Activity Logs
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/logs')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/logs'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Logs
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/visit-stats')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/visit-stats'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Visit Stats
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/blocked-ips')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/blocked-ips'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Blocked IP's
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/whitelisted-ips')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/whitelisted-ips'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Whitelisted IP's
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/backups')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/backups'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Backups
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/file-editor')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/file-editor'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> File Editor
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/contact-messages')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/contact-messages'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Contact Messages
                            </a>
                            <a class="nav-link <?= (str_contains(current_url(), 'account/admin/subscribers')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/subscribers'); ?>">
                                <i class="ri-arrow-drop-right-fill"></i> Subscribers
                            </a>
                        </nav>
                    </div>
                <?php endif; ?>

                <a class="nav-link" href="https://abdouliekassama.com/projects/igniter-cms" target="_blank">
                    <div class="sb-nav-link-icon"><i class="ri-code-s-slash-line h5"></i></div>
                    Documentation
                </a>
                <a class="nav-link <?= (str_contains(current_url(), 'account/ai-helpbot')) ? 'active' : ''; ?>" href="<?= base_url('/account/ai-helpbot'); ?>">
                    <div class="sb-nav-link-icon"><i class="ri-robot-2-fill"></i></div>
                    AI AskBot
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span class="small text-primary"><?= $sessionName ?> (<?=$userRole?>)</span>
        </div>
    </nav>
</div>