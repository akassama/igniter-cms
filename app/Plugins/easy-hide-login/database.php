<?php
$pluginKey = "easy-hide-login";

// Create table easy_hide_login_config
$createTablesQuery = "
CREATE TABLE icp_easy_hide_login_config (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    unique_identifier VARCHAR(100) NOT NULL,
    enable_redirect TINYINT(1) NOT NULL DEFAULT 0,
    redirect_url VARCHAR(255) NOT NULL,
    custom_error_message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Insert sample data for plugin_configs
$createConfigQuery = "
INSERT INTO icp_easy_hide_login_config (
    unique_identifier,
    enable_redirect,
    redirect_url,
    custom_error_message
) VALUES (
    'fc143bec',
    1,
    'http://localhost/apps/igniter-cms/sign-up',
    'You are not authorized to access this page.'
);
";
?>