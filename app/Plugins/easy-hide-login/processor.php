<?php

if (!function_exists('process_plugin_form_data')) {
    /**
     * Processes plugin configuration updates for the easy-hide-login plugin.
     *
     * @param array $postData Raw POST data from the form
     * @param string $pluginKey The plugin key (e.g., easy-hide-login)
     * @return bool True on success, throws exception on failure
     * @throws \Exception If validation or database operation fails
     */
    function process_plugin_form_data($postData, $pluginKey)
    {
        // Sanitize and validate input
        $uniqueId = trim($postData['uniqueId'] ?? '');
        $enableRedirect = isset($postData['enableRedirect']) ? (int) ($postData['enableRedirect'] !== null) : 0;
        $redirectUrl = isset($postData['redirectUrl']) && filter_var(trim($postData['redirectUrl']), FILTER_VALIDATE_URL) ? trim($postData['redirectUrl']) : '';
        $customErrorMessage = trim($postData['errorMessage'] ?? '');

        if (empty($uniqueId)) {
            throw new \Exception("Unique ID is required.");
        }

        // Table name for easy-hide-login
        $configTableName = "icp_easy_hide_login_config";

        // Check if table exists
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        if (!in_array($configTableName, $tables)) {
            throw new \Exception("Configuration table does not exist: {$configTableName}");
        }

        // Prepare data
        $data = [
            'unique_identifier' => $uniqueId,
            'enable_redirect' => $enableRedirect,
            'redirect_url' => $redirectUrl,
            'custom_error_message' => $customErrorMessage
        ];

        // Update the configuration table
        $db->table($configTableName)
            ->where('id IS NOT NULL')
            ->update($data);

        // Log success
        log_message('debug', "Updated data for plugin: {$pluginKey}");

        return true;
    }
}

?>