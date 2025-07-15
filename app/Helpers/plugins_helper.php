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