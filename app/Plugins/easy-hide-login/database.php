<?php
$pluginKey = "easy-hide-login";

// Create table easy_hide_login_config
$createTablesQuery = "
CREATE TABLE easy_hide_login_config (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    unique_identifier VARCHAR(100) NOT NULL,
    redirect_url VARCHAR(255) NOT NULL,
    custom_error_message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Insert sample data for plugin_configs
$createConfigQuery = "
INSERT INTO plugin_configs (plugin_slug, config_key, config_value) VALUES
('$pluginKey', 'login_path', '/wp-login'),
('$pluginKey', 'enabled', '1'),
('$pluginKey', 'redirect_404', '/404');
";
?>