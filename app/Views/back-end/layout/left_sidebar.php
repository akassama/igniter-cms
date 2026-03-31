<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$sessionIsSocialLogin = $session->get('is_social_login');
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
            else if (current_url.includes("account/forms")) {
                // Click the button with id "formsButton"
                document.getElementById("formsButton").click();
            }
            else if (current_url.includes("account/settings")) {
                // Click the button with id "settingsButton"
                document.getElementById("settingsButton").click();
            }
            else if (current_url.includes("account/appearance")) {
                // Click the button with id "appearanceButton"
                document.getElementById("appearanceButton").click();
            }
            else if (current_url.includes("account/admin")) {
                // Click the button with id "adminButton"
                document.getElementById("adminButton").click();
            }
            else if (current_url.includes("account/plugins")) {
                // Click the button with id "pluginsButton"
                document.getElementById("pluginsButton").click();
            }
        }, 200);
    });
</script>

<?php if (isFeatureEnabled('FEATURE_BACK_END')): ?>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading"></div>
                    <a id="dashboard-link" class="nav-link <?= (str_contains(current_url(), 'account/dashboard')) ? 'active' : ''; ?>" href="<?= base_url('/account'); ?>">
                        <div class="sb-nav-link-icon"><i class="ri-dashboard-line h5"></i></div>
                        <?= lang('App.dashboard') ?>
                    </a>

                    <?php if (isFeatureEnabled('FEATURE_CMS')): ?>
                        <!--CMS Feature Nav Links-->
                        <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/cms')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCMS" aria-expanded="false" aria-controls="collapseCMS" id="cmsButton">
                            <div class="sb-nav-link-icon"><i class="ri-draft-line h5"></i></div>
                            <?= lang('App.cms') ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                        </a>
                        <div class="collapse" id="collapseCMS" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= (str_contains(current_url(), 'account/cms/blogs')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/blogs'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.blogs') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/cms/categories')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/categories'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.categories') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/cms/navigations')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/navigations'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.navigation') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/cms/pages')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/pages'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.pages') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/cms/data-groups')) ? 'active' : ''; ?>" href="<?= base_url('/account/cms/data-groups'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.data_groups') ?>
                                </a>
                            </nav>
                        </div>                    
                    <?php endif; ?>

                    <?php if (isFeatureEnabled('FEATURE_FORMS')): ?>
                        <!--Forms Feature Nav Links-->
                        <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/forms')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseForms" aria-expanded="false" aria-controls="collapseForms" id="formsButton">
                            <div class="sb-nav-link-icon"><i class="ri-news-line h5"></i></div>
                            <?= lang('App.forms') ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                        </a>
                        <div class="collapse" id="collapseForms" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= (str_contains(current_url(), 'account/forms/contact-forms')) ? 'active' : ''; ?>" href="<?= base_url('/account/forms/contact-forms'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.contact') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/forms/comment-forms')) ? 'active' : ''; ?>" href="<?= base_url('/account/forms/comment-forms'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.comments') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/forms/booking-forms')) ? 'active' : ''; ?>" href="<?= base_url('/account/forms/booking-forms'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.bookings') ?>
                                </a>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/forms/subscription-forms')) ? 'active' : ''; ?>" href="<?= base_url('/account/forms/subscription-forms'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.subscriptions') ?>
                                </a>
                            </nav>
                        </div>
                    <?php endif; ?>

                    <?php if (isFeatureEnabled('FEATURE_FILE_MANAGER')): ?>
                        <!--File Manager Feature Nav Link-->
                        <a class="nav-link <?= (str_contains(current_url(), 'account/file-manager')) ? 'active' : ''; ?>" href="<?= base_url('/account/file-manager'); ?>">
                            <div class="sb-nav-link-icon"><i class="ri-folder-open-line h5"></i></div>
                            <?= lang('App.file_manager') ?>
                        </a>
                    <?php endif; ?>

                    <?php if (isFeatureEnabled('FEATURE_CONTENT_BLOCKS')): ?>
                        <!--Content Blocks Feature Nav Link-->
                        <a class="nav-link <?= (str_contains(current_url(), 'account/content-blocks')) ? 'active' : ''; ?>" href="<?= base_url('/account/content-blocks'); ?>">
                            <div class="sb-nav-link-icon"><i class="ri-window-fill h5"></i></div>
                            <?= lang('App.content_blocks') ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (isFeatureEnabled('FEATURE_APPEARANCE')): ?>
                        <!--Appearance Feature Nav Links-->
                        <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/appearance')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAppearance" aria-expanded="false" aria-controls="collapseAppearance" id="appearanceButton">
                            <div class="sb-nav-link-icon"><i class="ri-paint-brush-line h5"></i></div>
                            <?= lang('App.appearance') ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                        </a>
                        <div class="collapse" id="collapseAppearance" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= (str_contains(current_url(), 'account/appearance/themes')) ? 'active' : ''; ?>" href="<?= base_url('/account/appearance/themes'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.themes') ?>
                                </a>
                                <?php if (isFeatureEnabled('FEATURE_THEME_EDITOR')): ?>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/appearance/theme-editor')) ? 'active' : ''; ?>" href="<?= base_url('/account/appearance/theme-editor'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.theme_editor') ?>
                                    </a>

                                    <a class="nav-link <?= (str_contains(current_url(), 'account/appearance/theme-editor/revisions')) ? 'active' : ''; ?>" href="<?= base_url('/account/appearance/theme-editor/revisions'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.theme_revisions') ?>
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    <?php endif; ?>

                    <?php if (isFeatureEnabled('FEATURE_SETTINGS')): ?>
                        <!--Settings Feature Nav Links-->
                        <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/settings')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="false" aria-controls="collapseSettings" id="settingsButton">
                            <div class="sb-nav-link-icon"><i class="ri-settings-2-line h5"></i></div>
                            <?= lang('App.settings') ?>
                            <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                        </a>
                        <div class="collapse" id="collapseSettings" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link <?= (str_contains(current_url(), 'account/settings/update-details')) ? 'active' : ''; ?>" href="<?= base_url('/account/settings/update-details'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.update_details') ?>
                                </a>
                                <?php if(!$sessionIsSocialLogin): ?>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/settings/change-password')) ? 'active' : ''; ?>" href="<?= base_url('/account/settings/change-password'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.change_password') ?>
                                    </a>
                                <?php endif; ?>
                                <a class="nav-link <?= (str_contains(current_url(), 'account/settings/language')) ? 'active' : ''; ?>" href="<?= base_url('/account/settings/language'); ?>">
                                    <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.language') ?>
                                </a>
                            </nav>
                        </div>
                    <?php endif; ?>
                    
                    <!--Admin Views-->
                    <?php if ($userRole == "Admin"): ?>
                        <?php if (isFeatureEnabled('FEATURE_ADMIN')): ?>
                            <!--Admin Feature Nav Links-->
                            <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/admin')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin" id="adminButton">
                                <div class="sb-nav-link-icon"><i class="ri-user-settings-fill h5"></i></div>
                                <?= lang('App.admin') ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdmin" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/users')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/users'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.users') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/configurations')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/configurations'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.configurations') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/codes')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/codes'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.codes') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/api-keys')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/api-keys'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.api_keys') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/activity-logs')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/activity-logs'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.activity_logs') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/logs')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/logs'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.logs') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/visit-stats')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/visit-stats'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.visit_stats') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/blocked-ips')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/blocked-ips'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.blocked_ips') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/whitelisted-ips')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/whitelisted-ips'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.whitelisted_ips') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/admin/backups')) ? 'active' : ''; ?>" href="<?= base_url('/account/admin/backups'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.backups') ?>
                                    </a>
                                </nav>
                            </div>     
                        <?php endif; ?>

                        
                        <?php if (isFeatureEnabled('FEATURE_PLUGINS')): ?>
                            <!--Plugins Feature Nav Links-->
                            <a class="nav-link collapsed <?= (str_contains(current_url(), 'account/plugins')) ? 'active' : ''; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePlugins" aria-expanded="false" aria-controls="collapsePlugins" id="pluginsButton">
                                <div class="sb-nav-link-icon"><i class="ri-plug-fill h5"></i></div>
                                <?= lang('App.plugins') ?> 
                                <div class="sb-sidenav-collapse-arrow"><i class="ri-arrow-down-s-fill"></i></div>
                            </a>
                            <div class="collapse" id="collapsePlugins" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/plugins')) ? 'active' : ''; ?>" href="<?= base_url('/account/plugins'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.installed_plugins') ?>
                                    </a>
                                    <a class="nav-link <?= (str_contains(current_url(), 'account/plugins/configurations')) ? 'active' : ''; ?>" href="<?= base_url('/account/plugins/configurations'); ?>">
                                        <i class="ri-arrow-drop-right-fill"></i> <?= lang('App.plugin_configs') ?>
                                    </a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <?php if (isFeatureEnabled('FEATURE_ASK_AI') && isValidAIKey()): ?>
                            <!--Aks AI Feature Nav Links-->
                            <a class="nav-link <?= (str_contains(current_url(), 'account/ask-ai')) ? 'active' : ''; ?>" href="<?= base_url('/account/ask-ai'); ?>" id="askAiButton">
                                <div class="sb-nav-link-icon"><i class="ri-chat-ai-line h5"></i></div>
                                <?= lang('App.ask_ai') ?>
                            </a>
                        <?php endif; ?>

                        <a class="nav-link" href="https://docs.ignitercms.com/" target="_blank" id="documentationButton">
                            <div class="sb-nav-link-icon"><i class="ri-code-s-slash-line h5"></i></div>
                            <?= lang('App.documentation') ?>
                        </a>
                        
                    <?php endif; ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small"><?= lang('App.logged_in_as') ?>:</div>
                <span class="small text-primary">
                    <img src="<?=getImageUrl(getUserData(getLoggedInUserId(), "profile_picture") ?? getDefaultProfileImagePath())?>" class="rounded-circle" alt="Logged-In User" width="35" height="35">
                    <?= $sessionName ?> (<?=$userRole?>)
                </span>
                <br/>
                <span class="small"><?= lang('App.version') ?> <?=env("APP_VERSION")?></span>
            </div>
        </nav>
    </div>     
<?php endif; ?>