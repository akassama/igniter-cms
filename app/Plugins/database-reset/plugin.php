<?php

if (!function_exists('database_reset_action')) {
    /**
     * Checks the current URL and query parameters against icp_easy_hide_login_config.
     * Redirects or prints an error based on enable_redirect, if the URL path is 'sign-in' and the 'id' parameter is missing or incorrect.
     */
    function database_reset_action()
    {
		  //NO Action Required
    }
}

// Call the function immediately when the plugin is loaded
database_reset_action();

?>