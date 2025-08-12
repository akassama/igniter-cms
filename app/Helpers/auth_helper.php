<?php
use App\Constants\ActivityTypes;

/**
 * Validates the honeypot input and the timestamp.
 * If the honeypot field has a value or the form was submitted too quickly, it blocks the IP.
 *
 * @param {string} $honeypotInput The value of the honeypot input field.
 * @param {int} $submittedTimestamp The timestamp submitted with the form.
 * @returns {void}
 */
if (!function_exists('validateHoneypotInput')) {
    function validateHoneypotInput($honeypotInput, $submittedTimestamp): void {
        // Check if the honeypot field is filled (indicating bot activity)
        if (!empty($honeypotInput)) {
            blockAndLogIPSpam("Honeypot field filled");
            return;
        }

        // Validate the timestamp
        $currentTime = time();
        $submittedTimestamp = intval($submittedTimestamp);
        $minSubmissionTime = 2; // Minimum allowed time in seconds

        //check if form filled too quickly by being less than min allowed time or not being able to set before subission
        if (($currentTime - $submittedTimestamp) < $minSubmissionTime || $submittedTimestamp === 0) {
            blockAndLogIPSpam("Form submitted too quickly");
            return;
        }
    }
}

/**
 * Checks if any of the blocked paths exist in the given URL.
 *
 * This function normalizes the URL path, converts both the URL path and the
 * blocked paths to lowercase, and then uses `strpos()` for a case-insensitive
 * search.  It returns `true` if any of the blocked paths are found in the URL,
 * and `false` otherwise.
 *
 * @param string $url The URL to check.
 * @return bool True if the URL contains a blocked path, false otherwise.
 */
if(!function_exists('isBlockedRoute'))
{
    function isBlockedRoute(string $url): bool
    {
        /**
         * Array of paths that are considered suspicious or blocked.
         * These paths might indicate an attempt to access sensitive files,
         * exploit vulnerabilities, or gain unauthorized access.
         *
         * @var array<string>
         */
        $black_listed_paths = array(
            "wp-settings.php", "wp-login.php", "setup-config.php", "wp-admin/", "wordpress/", //Wordpress files
            ".env", ".git/", ".svn/",  // Sensitive directories/files
            "config.php", "configuration.php", "db.php", "database.php", // Common config files
            "admin/login", "administrator/login", "cpanel/", // Common admin/login paths
            "shell/", "r57shell/", "cmd.php", "backdoor.php", // Known backdoor/shell scripts
            "phpinfo.php",  // Information disclosure risk
            "eval()", "assert()", "base64_decode(", // Attempted code injection (can be part of URL)
            "../../", "..\\",  // Directory traversal attempts
            "etc/passwd", "/etc/passwd",  // Access to system files
            "proc/self/environ", "/proc/self/environ", // Access to environment variables
            "error_log", "access_log", // Log files (potentially contain sensitive info)
            "server-status", "server-info", // Apache server status/info pages
            "test.php", "debug.php", // Common test/debug files that might be left exposed
            "install.php", "upgrade.php", // Installation/upgrade scripts (shouldn't be accessible)
            "xmlrpc.php", // XML-RPC (can be exploited)
            "composer.json", "package.json", // Information about project dependencies
            ".sql", "sql_dump", "database_dump", "db_backup", "backup.sql.gz", "backup.sql.zip", "backup.sql.tar", // SQL paths
            "CFIDE/administrator" //other
        );
    
        /**
         * Extracts the path part from the URL.
         * If parsing fails, the original URL is used.
         * Leading and trailing slashes are removed for consistency.
         *
         * @var string|null
         */
        $url_path = parse_url($url, PHP_URL_PATH);
        if ($url_path === null) {
            $url_path = $url;
        }
        $url_path = trim($url_path, '/');
    
        /**
         * Converts the URL path to lowercase for case-insensitive comparison.
         *
         * @var string
         */
        $url_path_lower = strtolower($url_path);
    
        /**
         * Iterates through the blocked paths and checks if any of them
         * are present in the URL path.
         *
         * @var string $blocked_path
         */
        foreach ($black_listed_paths as $blocked_path) {
            /**
             * Removes leading and trailing slashes from the blocked path
             * for consistency.
             *
             * @var string
             */
            $blocked_path = trim($blocked_path, '/');
    
            /**
             * Converts the blocked path to lowercase for case-insensitive
             * comparison.
             *
             * @var string
             */
            $blocked_path_lower = strtolower($blocked_path);
    
            /**
             * Checks if the blocked path is found in the URL path.
             * If a match is found, the function immediately returns `true`.
             */
            if (strpos($url_path_lower, $blocked_path_lower) !== false) {
                return true;
            }
        }
    
        /**
         * If no match is found after checking all blocked paths, the function
         * returns `false`.
         */
        return false;
    }
}

/**
 * Adds a blocked IP address to the database.
 *
 * @param {string} $ip_address The IP address to block.
 * @param {string} $url The URL where the IP address was blocked.
 * @param {string} $reason The reason for blocking the IP address.
 * @returns {boolean} True on success.
 */
if(!function_exists('addBlockedIPAdress'))
{
    function addBlockedIPAdress($ipAddress, $country, $url, $blockEndTime, $reason)
    {
        $tableNameBlocked = "blocked_ips";
        $tableNameWhitelisted  = "whitelisted_ips";
        $newBlackListData = [
            'blocked_ip_id' =>  getGUID(),
            'ip_address' => $ipAddress,
            'country' => $country,
            'block_start_time' => date('Y-m-d H:i:s'),
            'block_end_time' => $blockEndTime,
            'reason' => $reason,
            'notes' => null,
            'page_visited_url' => $url
        ];

        $ipExistsInBlockedIps = recordExists($tableNameBlocked, 'ip_address', $newBlackListData["ip_address"]);
        $ipExistsInWhitelistedIps = recordExists($tableNameWhitelisted, 'ip_address', $newBlackListData["ip_address"]);
        if (!$ipExistsInBlockedIps && !$ipExistsInWhitelistedIps) {
            addRecord($tableNameBlocked, $newBlackListData);
        }
        
        return true;
    }
}


/**
 * Checks if an IP address is blocked.
 *
 * @param {string} $ip_address The IP address to check.
 * @returns {boolean} True if the IP address is blocked, false otherwise.
 */
if (!function_exists('isBlockedIP')) {
    function isBlockedIP($ipAddress) {
        $tableName = "blocked_ips";
        $db = \Config\Database::connect();

        $builder = $db->table($tableName); 

        $builder->where('ip_address', $ipAddress);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();

            // Check if the block is indefinite or not expired.
            if ($row->block_end_time === null || strtotime($row->block_end_time) > time()) {
                return true;
            } else {
                $builder->where('id', $row->id);
                $builder->delete();
                return false;
            }
        } else {
            return false;
        }
    }
}

/**
 * Generates a hidden honeypot input field and a timestamp input field.
 * This includes a random class for the honeypot field and a hidden timestamp field.
 *
 * @returns {string} The HTML for the honeypot and timestamp input fields.
 */
if (!function_exists('getHoneypotInput')) {
    function getHoneypotInput(): string {
        // Add a random class name to make it harder for bots to identify
        $randomClass = 'field_' . bin2hex(random_bytes(8));
        $honeypotKey = getConfigData("HoneypotKey");
        $timestampKey = getConfigData("TimestampKey");

        // Generate the honeypot input
        $honeypotInput = '<input type="text" name="' . $honeypotKey . '" ' .
            'id="' . $honeypotKey . '" ' .
            'class="' . $randomClass . '" ' .
            'autocomplete="off" ' .
            'tabindex="-1" ' .
            'style="position:absolute !important;width:1px !important;height:1px !important;padding:0 !important;margin:-1px !important;overflow:hidden !important;clip:rect(0,0,0,0) !important;white-space:nowrap !important;border:0 !important;">';

        // Generate the timestamp input
        $timestampInput = '<input type="hidden" name="' . $timestampKey . '" ' .
            'id="' . $timestampKey . '" ' .
            'value="' . time() . '">';

        return $honeypotInput . $timestampInput;
    }
}


/**
 * Blocks the IP address and logs the activity.
 *
 * @param {string} $reason The reason for blocking the IP.
 * @returns {void}
 */
if (!function_exists('blockAndLogIPSpam')) {
    function blockAndLogIPSpam($reason): void {
        $ipAddress = getDeviceIP();
        $currentUrl = current_url();
        $country = getCountry();
        $blockEndTime = date('Y-m-d H:i:s', strtotime(getConfigData("BlockedIPSuspensionPeriod")));

        // Add to blocked IPs
        addBlockedIPAdress($ipAddress, $country, $currentUrl, $blockEndTime, ActivityTypes::BLOCKED_IP_SPAMMING);

        // Log the activity
        logActivity("User IP: " . $ipAddress, ActivityTypes::BLOCKED_IP_SPAMMING, $reason . ' with IP: ' . $ipAddress);

        // Return a normal-looking 403 response
        header('HTTP/1.1 403 Forbidden');

        // If it's an AJAX request, return JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Access denied']);
            exit();
        }

        echo 'Your IP address has been blocked.';
        exit();
    }
}