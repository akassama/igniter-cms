<?php

if (!function_exists('loadPluginHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in view context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'view'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'view'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%view%'");
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
            log_message('error', 'Failed to load view plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadPluginFilterHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in filter context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'filter'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadPluginFilterHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query plugins where status is active and load includes 'filter'
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1 AND `load` LIKE '%filter%'");
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
            log_message('error', 'Failed to load filter plugins: ' . $e->getMessage());
        }
    }
}

if (!function_exists('loadPluginAdminHelpers')) {
    /**
     * Loads plugin.php files for all active plugins that should load in admin context.
     *
     * Reads from the 'plugins' table where:
     * - status = 1 (active)
     * - load includes 'admin'
     *
     * Includes the plugin.php file if it exists.
     */
    function loadPluginAdminHelpers()
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