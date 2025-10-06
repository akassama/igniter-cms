<?php

if (!function_exists('loadPlugin')) {
    /**
     * Loads plugin.php files for all active plugins that should load in footer context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'footer'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadPlugin($location)
    {
        switch ($location) {
        case "meta":
            return loadMetaPluginHelpers();
            break;
        case "header":
            return loadHeaderPluginHelpers();
            break;
        case "footer":
            return loadFooterPluginHelpers();
            break;
        case "before_filter":
            return loadBeforeFilterPluginHelpers();
            break;
        case "after_filter":
            return loadAfterFilterPluginHelpers();
            break;
        case "admin":
            return loadAdminPluginHelpers();
            break;
        default:
            return null;
        }
    }
}

if (!function_exists('loadMetaPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in meta context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'meta'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadMetaPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'meta'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%meta%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }

            if (count($activePlugins) == 0) {
                // Set default meta data if no meta plugin loaded/active
                $siteName = getConfigData("SiteName");
                $siteDescription = getConfigData("SiteDescription");
                $siteKeywords = getConfigData("SiteKeywords");
                ?>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Site variables
                    var siteName = <?= json_encode($siteName ?? '') ?>;
                    var siteDescription = <?= json_encode($siteDescription ?? '') ?>;
                    var siteKeywords = <?= json_encode($siteKeywords ?? '') ?>;

                    var changesMade = false;

                    // 1. Check and add <title> if missing
                    if (!document.title || document.title.trim() === '') {
                        document.title = siteName;
                        changesMade = true;
                    }

                    // 2. Check and add meta description if missing
                    var metaDesc = document.querySelector('meta[name="description"]');
                    if (!metaDesc) {
                        var newMetaDesc = document.createElement('meta');
                        newMetaDesc.name = 'description';
                        newMetaDesc.content = siteDescription;
                        document.head.appendChild(newMetaDesc);
                        changesMade = true;
                    }

                    // 3. Check and add meta keywords if missing
                    var metaKeywords = document.querySelector('meta[name="keywords"]');
                    if (!metaKeywords) {
                        var newMetaKeywords = document.createElement('meta');
                        newMetaKeywords.name = 'keywords';
                        newMetaKeywords.content = siteKeywords;
                        document.head.appendChild(newMetaKeywords);
                        changesMade = true;
                    }

                    // 4. Check and add favicon if missing
                    var favicon = document.querySelector('link[rel="icon"], link[rel="shortcut icon"]');
                    if (!favicon) {
                        var newFavicon = document.createElement('link');
                        newFavicon.rel = 'icon';
                        newFavicon.type = 'image/png';
                        newFavicon.href = 'https://assets.aktools.net/image-stocks/logos/favicon/igniter.png';
                        document.head.appendChild(newFavicon);
                        changesMade = true;
                    }

                    // If no changes were made, remove this script from the DOM
                    if (!changesMade) {
                        var scriptElement = document.currentScript;
                        if (scriptElement) {
                            scriptElement.parentNode.removeChild(scriptElement);
                        }
                    }
                });
                </script>
                <?php
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load meta plugins: ' . $e->getMessage());
        }
    }
}


if (!function_exists('loadFooterPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in footer context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'footer'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadFooterPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'footer'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%footer%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load footer plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadHeaderPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in header context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'header'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadHeaderPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'header'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%header%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load header plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadBeforeFilterPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in before_filter context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'before_filter'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadBeforeFilterPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'before_filter'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%before_filter%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load before_filter plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadAfterFilterPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in after_filter context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'after_filter'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadAfterFilterPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'after_filter'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%after_filter%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load after_filter plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadAdminPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in admin context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'admin'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadAdminPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'admin'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%admin%'");
            $activePlugins = $query->getResultArray();

            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                } else {
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load admin plugins: ' . $e->getMessage());
        }
    }
}