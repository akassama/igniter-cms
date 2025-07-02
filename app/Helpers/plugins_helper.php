<?php

/**
 * Loads plugin.php files for all active plugins (status = 1) from the plugins table.
 * Looks for app/Plugins/{plugin_key}/plugin.php for each active plugin.
 */
if (!function_exists('loadPluginHelpers')) {
    function loadPluginHelpers()
    {
        $db = \Config\Database::connect();

        try {
            // Query the plugins table for active plugins (status = 1)
            $query = $db->query("SELECT plugin_key FROM plugins WHERE status = 1");
            $activePlugins = $query->getResultArray();

            // Load plugin.php for each active plugin
            foreach ($activePlugins as $plugin) {
                $pluginKey = $plugin['plugin_key'];
                $pluginFile = APPPATH . 'Plugins/' . $pluginKey . '/plugin.php';

                if (file_exists($pluginFile)) {
                    include_once $pluginFile;
                }
                else{
                    log_message('error', 'Plugin file not found: ' . $pluginFile);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to load plugins: ' . $e->getMessage());
        }
    }
}


if (!function_exists('loadPluginFilterHelpers')) {
    function loadPluginFilterHelpers()
    {
        $db = \Config\Database::connect();

        //TODO
    }
}