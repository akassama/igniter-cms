<?php

if (!function_exists('easy_hide_login_check_url')) {
    /**
     * Checks the current URL and query parameters against icp_easy_hide_login_config.
     * Redirects or prints an error based on enable_redirect, if the URL path is 'sign-in' and the 'id' parameter is missing or incorrect.
     */
    function easy_hide_login_check_url()
    {
        try {
            // Get configuration from icp_easy_hide_login_config (single record)
            $uniqueIdentifier = getTableData('icp_easy_hide_login_config', [], 'unique_identifier');
            $enableRedirect = (int) getTableData('icp_easy_hide_login_config', [], 'enable_redirect');
            $redirectUrl = getTableData('icp_easy_hide_login_config', [], 'redirect_url');
            $customErrorMessage = getTableData('icp_easy_hide_login_config', [], 'custom_error_message');

            // Default error message if custom_error_message is empty
            $defaultErrorMessage = 'Access denied: Invalid or missing ID parameter';

            // Get the current URL path and request
            $uriString = uri_string();
            $request = \Config\Services::request();
            $idParam = $request->getGet('id');
            $currentUrl = current_url(true);

            // Check if the URL path contains 'sign-in'
            if (strpos($uriString, 'sign-in') !== false) {

                $errorMessage = !empty($customErrorMessage) ? esc($customErrorMessage) : $defaultErrorMessage;
                if(!empty($errorMessage)){
                    session()->setFlashdata('errorAlert', $errorMessage);
                }

                // Check if unique_identifier is not set or id parameter is missing
                if ($uniqueIdentifier === null || empty($idParam)) {
                    // Log error
                    log_message('error', 'Missing id parameter or no configuration in sign-in URL: ' . $currentUrl);
                    if ($enableRedirect === 1 && !empty($redirectUrl)) {
                        redirect()->to($redirectUrl)->send();
                        exit;
                    } else {
                        redirect()->to(base_url())->send();
                        exit;
                    }
                }

                // Check if id parameter matches unique_identifier
                if ($idParam !== $uniqueIdentifier) {
                    // Log error
                    log_message('error', 'Invalid id parameter in sign-in URL: ' . $idParam . ' (expected: ' . $uniqueIdentifier . ')');
                    if ($enableRedirect === 1 && !empty($redirectUrl)) {
                        redirect()->to($redirectUrl)->send();
                        exit;
                    } else {
                        redirect()->to(base_url())->send();
                        exit;
                    }
                }

                // Log success
                log_message('debug', 'Valid sign-in URL with id: ' . $idParam);
            } else {
                // Log debug for non-sign-in URLs
                log_message('debug', 'URL does not contain sign-in: ' . $currentUrl);
            }
        } catch (\Exception $e) {
            // Log error
            log_message('error', 'URL check failed: ' . $e->getMessage());
            // Use redirect_url if enable_redirect = 1, otherwise print error
            $enableRedirect = (int) getTableData('icp_easy_hide_login_config', [], 'enable_redirect');
            $redirectUrl = getTableData('icp_easy_hide_login_config', [], 'redirect_url');
            $customErrorMessage = getTableData('icp_easy_hide_login_config', [], 'custom_error_message');
            $defaultErrorMessage = 'Access denied: Invalid or missing ID parameter';

            if ($enableRedirect === 1 && !empty($redirectUrl)) {
                redirect()->to($redirectUrl)->send();
                exit;
            } else {
                echo !empty($customErrorMessage) ? esc($customErrorMessage) : $defaultErrorMessage;
                exit;
            }
        }
    }
}

// Call the function immediately when the plugin is loaded
easy_hide_login_check_url();

?>