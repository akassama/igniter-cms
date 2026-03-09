<?php
use MatthiasMullie\Minify;



/**
 * Returns a GUIDv4 string
 *
 * Uses the best cryptographically secure method
 * for all supported platforms with fallback to an older,
 * less secure version.
 *
 * @param bool $trim
 * @return string
 */
if(!function_exists('getGUID')){
    function getGUID ($default_guid = null, $trim = true)
    {
        //return default_guid if passed
        if(!empty($default_guid)){
            return $default_guid;
        }

        // Windows
        if (function_exists('com_create_guid') === true) {
            if ($trim === true)
                return trim(com_create_guid(), '{}');
            else
                return com_create_guid();
        }

        // OSX/Linux
        if (function_exists('openssl_random_pseudo_bytes') === true) {
            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }

        // Fallback (PHP 4.2+)
        mt_srand((double)microtime() * 10000);
        $charid = strtolower(md5(uniqid(rand(), true)));
        $hyphen = chr(45);                  // "-"
        $lbrace = $trim ? "" : chr(123);    // "{"
        $rbrace = $trim ? "" : chr(125);    // "}"
        $guidv4 = $lbrace.
            substr($charid,  0,  8).$hyphen.
            substr($charid,  8,  4).$hyphen.
            substr($charid, 12,  4).$hyphen.
            substr($charid, 16,  4).$hyphen.
            substr($charid, 20, 12).
            $rbrace;
        return $guidv4;
    }
}


/**
 * Generates a static GUID based on the current date.
 * The GUID will remain the same for the entire day and change on subsequent days.
 *
 * @function
 * @returns {string} A static GUID for the current date.
 * @example
 * // Example output: "f3bd0ee7-880e-4a81-8a59-9e47416e6ced"
 * const guid = getDefaultAdminGUID();
 */
if (!function_exists('getDefaultAdminGUID')) {
    function getDefaultAdminGUID()
    {
        // Get CI4 session service
        $session = \Config\Services::session();
        
        // Check if we already have the GUID in session
        if ($session->has('default_admin_guid')) {
            return $session->get('default_admin_guid');
        }
        
        // If not in session, check if we need to generate based on date
        $today = date('Y-m-d'); // Format: 2025-02-18
        
        // Create a seed based on the date
        $seed = md5($today . 'default_admin_salt');
        
        // Use the existing getGUID function with a deterministic seed
        mt_srand(hexdec(substr($seed, 0, 8))); // Use first 8 chars of md5 as seed
        
        // Generate the GUID
        $guid = getGUID();
        
        // Store in session for consistency across requests
        $session->set('default_admin_guid', $guid);
        
        return $guid;
    }
}



/**
 * Generates the HTML content for a "403 Forbidden" message.
 *
 * This function returns HTML that can be used to create an index.html file
 * that displays a "403 Forbidden" message, which prevents directory browsing.
 *
 * @return string The HTML content for a "403 Forbidden" page.
 */
if (!function_exists('generateForbiddenHtml')) {
    function generateForbiddenHtml() {
        $content = "<!DOCTYPE html>
            <html>
            <head>
                <title>403 Forbidden</title>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            </head>
            <body>
                <h1>403 Forbidden</h1>
                <p>You don't have permission to access this directory.</p>
            </body>
            </html>";

        return $content;
    }
}

/**
 * Extracts the date portion from a datetime string.
 *
 * @param string $datetime The input datetime string (e.g., "2024-10-19 00:00:00").
 * @return string The date in "YYYY-MM-DD" format.
 */
if (!function_exists('getDateOnly')) {
    function getDateOnly(string $datetime, string $format = 'Y-m-d'): string {
        $time = strtotime($datetime);
        $newformat = date($format, $time);
        return $newformat;
    }
}

/**
 * Calculates the age based on a given date.
 *
 * @param {string} datetime - The date string in the format 'YYYY-MM-DD'.
 * @returns {number} - The age calculated in years.
 */
if (!function_exists('calculateAge')) {
    function calculateAge(string $datetime): int
    {
        // Create a DateTime object from the input date string
        $dob = new DateTime($datetime);

        // Get the current date
        $now = new DateTime();

        // Calculate the interval between the two dates
        $interval = $dob->diff($now);

        // Return the difference in years
        return $interval->y;
    }
}

/**
 * Formats a date according to the specified format.
 *
 * @param {string} format - The desired date format (e.g., "d-m-Y", "Y-m-d").
 * @param {string|null} givenDate - The date to be formatted (optional). If not provided, the current time is used.
 * @returns {string} The formatted date.
 */
if(!function_exists('dateFormat'))
{
    function dateFormat($date, $format='d-m-Y') {
        // Check if the provided date is a valid timestamp
        if (strtotime($date) === false) {
            // If not, try to convert it to a timestamp using the default format
            $date = strtotime($date . ' ' . $format);
        }

        // Check if the converted date is a valid timestamp
        if (strtotime($date) === false) {
            // If not, return an empty string or handle the error as needed
            return '';
        }

        // Format the date using the provided format
        return date($format, strtotime($date));
    }
}


/**
 * Retrieves the IP address of the current request.
 *
 * @return {string} The IP address of the current request. Returns '127.0.0.1' for localhost IPv6.
 */
if (!function_exists('getIPAddress')) {
    function getIPAddress(): string
    {
        $request = \Config\Services::request();
        $ip = $request->getIPAddress();

        // Check if the IP is the IPv6 localhost address
        if ($ip === '::1') {
            return '127.0.0.1';
        }

        return $ip;
    }
}


if (!function_exists('getPageTitle')) {
    function getPageTitle($pageUrl)
    {
        $title = "home"; // Default title

        // Remove the base URL from the page URL
        $relativeUrl = str_replace(base_url(), '', $pageUrl);

        // Check if the relative URL is empty
        if (!empty($relativeUrl)) {
            // Get the last part of the URL after the last slash
            $title = basename($relativeUrl);
        }
        
        $title = $title == "index.php" ? "home" : $title; // set index.php as home as well

        return $title;
    }
}

/**
* Get the page ID from the current URL
*
* @param string $currentUrl The current URL
* @return string The page ID extracted from the URL
*/
if (!function_exists('getPageId')) {
    function getPageId($currentUrl)
    {
        // Check if the URL is null or empty
        if (is_null($currentUrl) || $currentUrl === '') {
            return '';
        }
 
        // Determine the page type based on the URL
        $pageId = str_replace(base_url('/'), "", $currentUrl);
 
        // Remove 'index.php/' from the page ID, if present
        if (str_contains($pageId, 'index.php/')) {
            $pageId = str_replace('index.php/', "", $pageId);
        }

        $pageId = empty($pageId) ? "home" : $pageId; //set as home if empty
 
        return $pageId;
    }
 }


/**
 * Generates a reset link token for the given email and stores it in the database.
 *
 * @param string $email The email address to generate the reset link for.
 * @return string The generated reset token.
 */
if (!function_exists('generateResetLink')) {
    function generateResetLink($email)
    {
        $db = \Config\Database::connect();

        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Set expiration time (30 minutes from now)
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        // Insert or update the reset token in the database
        $db->table('password_resets')->replace([
            'reset_id' => getGUID(),
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiresAt
        ]);

        return $token;
    }
}

/**
 * Validates if the provided reset token is still valid and has not expired.
 *
 * @param string $token The reset token to validate.
 * @return bool True if the token is valid, false otherwise.
 */
if (!function_exists('isValidResetToken')) {
    function isValidResetToken($token)
    {
        $db = \Config\Database::connect();

        $reset = $db->table('password_resets')
            ->where('token', $token)
            ->where('expires_at >', date('Y-m-d H:i:s'))
            ->get()
            ->getRowArray();

        return $reset !== null;
    }
}


/**
 * Converts a JSON list of objects with a 'value' property to a CSV string.
 *
 * This function takes a JSON string representing a list of objects,
 * extracts the 'value' property from each object, and returns these values
 * as a comma-separated string. If the input is not a valid JSON array,
 * it assumes the input is already a CSV string and returns it as is.
 *
 * @param string $listJson The JSON string representing the list of objects or a CSV string.
 * @return string A CSV string of the 'value' properties, or the original string if it's already in CSV format.
 */
if (!function_exists('getCsvFromJsonList')) {
    
    function getCsvFromJsonList(string $listJson): string
    {
        // Decode the JSON string into an array
        $listArray = json_decode($listJson, true);
        
        // Check if the JSON decoding was successful and the result is an array
        if (is_array($listArray)) {
            // Extract the 'value' from each element in the array
            $values = array_column($listArray, 'value');
            
            // Join the values with a comma to form a CSV string
            $data = implode(',', $values);
        } else {
            // If the input is not a valid JSON array, assume it's already a CSV string
            $data = $listJson;
        }

        return $data;
    }
}


/**
 * Convert datetime to "time ago" format
 */
if (!function_exists('timeAgo')) {
    function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $diff = time() - $time;
        
        if ($diff < 60) return "Just now";
        if ($diff < 3600) return floor($diff/60) . " minutes ago";
        if ($diff < 86400) return floor($diff/3600) . " hours ago";
        if ($diff < 604800) return floor($diff/86400) . " days ago";
        
        return date('M j, Y', $time);
    }
}


/**
 * Returns the default image path to use when no featured image is provided.
 *
 * @return string The default image path URL.
 */
if(!function_exists('getDefaultImagePath'))
{
    function getDefaultImagePath()
    {
        return 'public/back-end/assets/img/default_image_placeholder.png';
    }
}

/**
 * Returns the default image path to use when no featured image is provided.
 *
 * @return string The default image path URL.
 */
if(!function_exists('getDefaultProfileImagePath'))
{
    function getDefaultProfileImagePath()
    {
        return 'public/uploads/default/default-profile.png';
    }
}


/**
 * Checks if the given unique ID is a valid GUID.
 *
 * This function takes a unique ID as input and checks if it matches the pattern
 * of a valid GUID. A valid GUID is in the format '8-4-4-4-12' where each segment
 * is a hexadecimal number.
 *
 * @param string $uniqueId The unique ID to check.
 * @return bool True if the unique ID is a valid GUID, false otherwise.
 */
if (!function_exists('isValidGUID')) {
    function isValidGUID($uniqueId): bool
    {
        // Define the pattern for a valid GUID
        $pattern = '/^\{?[A-Fa-f0-9]{8}\-[A-Fa-f0-9]{4}\-[A-Fa-f0-9]{4}\-[A-Fa-f0-9]{4}\-[A-Fa-f0-9]{12}\}?$/';

        // Check if the unique ID matches the pattern
        return preg_match($pattern, $uniqueId) === 1;
    }
}

/**
 * Removes '/index.php' from a given URL.
 *
 * @param {string} $url The URL to process.
 * @return {string} The URL with '/index.php' removed.
 */
if(!function_exists('removeIndexPhp'))
{
    function removeIndexPhp(string $url): string
    {
        // Replace '/index.php' with an empty string
        return str_replace('/index.php', '', $url);
    }
}

/**
 * Removes all spaces from the given text.
 *
 * @param string $text The input text from which spaces will be removed.
 * @return string The text without any spaces.
 */
if (!function_exists('removeTextSpace')) {
    function removeTextSpace(string $text): string {
        return str_replace(' ', '', $text);
    }
}

/**
 * Validates an API key by checking its existence and status in the database.
 * 
 * @param {string} $apiKey - The API key to validate.
 * @returns {bool} True if the API key is valid and active, false otherwise.
 */
if (!function_exists('isValidApiKey')) {
    function isValidApiKey($apiKey)
    {
        //check if key is from env
        $publicApiKey = env("PLUGIN_API_REQUEST_KEY");
        if($apiKey === $publicApiKey){
            return true;
        }

        //check if key is valid api key
        $apiAccessModel = new \App\Models\APIAccessModel();
        $apiAccess = $apiAccessModel->where(['api_key' => $apiKey, 'status' => 1])->first();

        return $apiAccess != null;
    }
}


/**
 * Generates a unique API key.
 * 
 * @returns {string} A unique 64-character hexadecimal API key.
 */
if (!function_exists('generateApiKey')) {
    function generateApiKey()
    {
        // Generate a random alphanumeric string
        $apiKey = bin2hex(random_bytes(32)); // Generates a 64 character string

        // Check if the API key already exists in the database
        $apiAccessModel = new \App\Models\APIAccessModel();
        while ($apiAccessModel->where('api_key', $apiKey)->first()) {
            // Generate a new key if the generated key already exists
            $apiKey = bin2hex(random_bytes(32));
        }

        return $apiKey;
    }
}

/**
 * Retrieves an API key for a specific assigned entity.
 * 
 * Performs a case-insensitive search for the assigned entity in the API accesses table.
 * 
 * @param {string} $assignedTo - The entity to whom the API key is assigned.
 * @returns {string|null} The API key if found, null otherwise.
 * 
 * @example
 * // Retrieve API key for a user
 * $apiKey = getApiKeyFor($assignedTo);
 * 
 * @example
 * // Handle case where no API key is found
 * $apiKey = getApiKeyFor('unknownuser');
 * // $apiKey will be null
 */
if(!function_exists('getApiKeyFor')) {
    function getApiKeyFor($assignedTo)
    {
        try {
            // Connect to the database
            $db = \Config\Database::connect();
    
            $tableName = "api_accesses";
            $returnColumn = "api_key";
            
            // Use LOWER function for case-insensitive comparison
            $query = $db->table($tableName)
                ->select($returnColumn)
                ->where('LOWER(assigned_to)', strtolower($assignedTo))
                ->get();
    
            if ($query->getNumRows() > 0) {
                // Retrieve the result
                $row = $query->getRow();
                return $row->$returnColumn;
            } else {
                // No record found, return null
                return null;
            }        
        }
            //catch exception
        catch(Exception $e) {
            return "";
        }
    }
}

/**
 * Retrieves user data for a specific user type.
 * 
 * @param {string} $userId - The type of user to retrieve.
 * @param {string} $returnColumn - The column value of user to retrieve.
 * @returns {string|null} The user value, or null if not found.
 */
if(!function_exists('getUserData')) {
    function getUserData($userId, $returnColumn)
    {

        try {
            // Connect to the database
            $db = \Config\Database::connect();
    
            $tableName = "users";
            $whereClause = ["user_id" => $userId];
            // Build the query
            $query = $db->table($tableName)
                ->select($returnColumn)
                ->where($whereClause)
                ->get();
    
            if ($query->getNumRows() > 0) {
                // Retrieve the result
                $row = $query->getRow();
                return $row->$returnColumn;
            } else {
                // No record found, return null
                return null;
            }

        }
            //catch exception
        catch(Exception $e) {
            return "";
        }
    }
}

/**
 * Generates a unique value for a specific column in a database table
 * 
 * @param string $tableName Name of the database table
 * @param string $columnName Column to check for uniqueness
 * @param string $columnValue Original value to check
 * @param string $pkName Primary key column name
 * @param mixed $pkValue Primary key value (for update scenarios)
 * @return string Unique value
 */
if (!function_exists('generateUniqueValue')) {     
    /**
     * Generates a unique value for a specific column in a database table
     * 
     * @param string $tableName Name of the database table
     * @param string $columnName Column to check for uniqueness
     * @param string $columnValue Original value to check
     * @param string $pkName Primary key column name
     * @param mixed $pkValue Primary key value (for update scenarios)
     * @return string Unique value
     */
    function generateUniqueValue($tableName, $columnName, $columnValue, $pkName, $pkValue = null)
    {
        // Connect to the database using CodeIgniter 4 method
        $db = \Config\Database::connect();
        
        // Prepare the initial query
        $builder = $db->table($tableName);
        $builder->where($columnName, $columnValue);
        
        // If editing an existing record, exclude the current record
        if ($pkValue !== null) {
            $builder->where($pkName . ' !=', $pkValue);
        }
        
        // Check if the value already exists
        $query = $builder->get();
        
        // If the value is unique, return it as is
        if ($query->getNumRows() == 0) {
            return $columnValue;
        }
        
        // Generate a unique value by adding a random 5-digit number
        do {
            // Generate a random 5-digit number
            $randomSuffix = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $uniqueValue = $columnValue . '_' . $randomSuffix;
            
            // Reset the query builder
            $builder = $db->table($tableName);
            
            // Check if the new value is unique
            $builder->where($columnName, $uniqueValue);
            if ($pkValue !== null) {
                $builder->where($pkName . ' !=', $pkValue);
            }
            $checkQuery = $builder->get();
            
        } while ($checkQuery->getNumRows() > 0);
        
        return $uniqueValue;
    }
}

/**
 * Converts an array to a comma-separated string.
 *
 * @param array $array The input array.
 * @return string The comma-separated string or an empty string if the array is empty.
 */
if (!function_exists('arrayToCommaString')) {   
    function arrayToCommaString($array) {
        // Check if the array is empty
        if (empty($array)) {
            return '';
        }
        
        // Convert the array to a comma-separated string
        $comma_separated_string = implode(',', $array);
        
        return $comma_separated_string;
    }
}

/**
 * Checks if the getUserIdFromName function exists. If not, it defines the function.
 * 
 * This function retrieves the user ID from the database based on the provided username.
 *
 * @param {string} username - The username to search for.
 * @returns {int|null} - The user ID if found, otherwise null.
 */
if (!function_exists('getUserIdFromName')) {
    function getUserIdFromName($username) {
        $db = \Config\Database::connect();
        $query = $db->table('users')
                    ->select('user_id')
                    ->where('username', $username)
                    ->get();
        $result = $query->getRow();
        return $result ? $result->user_id : null;
    }
}

/**
 * Returns the default value if the provided value is null or empty.
 *
 * @param mixed $default The default value to return if $value is null or empty.
 * @param mixed $value The value to check.
 * @return mixed The $value if it is not null or empty, otherwise the $default.
 */
if (!function_exists('getDefaultDataValue')) {
    function getDefaultDataValue($default, $value) {
        return empty($value) ? $default : $value;
    }
}

/**
 * Get a summary of the given text. TrimText (trim text)
 *
 * This function strips any HTML tags from the text, checks if the length of the text is less than or equal to the specified length,
 * and if so, returns the text as is. If the length is greater than the specified length, it truncates the text to the specified length,
 * ensuring it doesn't cut off in the middle of a word, and appends "..." to indicate that the text has been shortened.
 *
 * @param string $text The text to summarize.
 * @param int $length The maximum length of the summary. Default is 150 characters.
 * @return string The summarized text.
 */
if (!function_exists('getTextSummary')) {
    function getTextSummary($text, $length = 150) {
        // Check if $text is not empty
        if (empty($text)) {
            return '';
        }

        // Strip any HTML tags
        $text = strip_tags($text);

        // Check if length is less than or equal to the specified length, if so return $text
        if (strlen($text) <= $length) {
            return $text;
        }

        // Else take 0 to specified length and add "..."
        $summary = substr($text, 0, $length);
        // Ensure we don't cut off in the middle of a word
        $summary = substr($summary, 0, strrpos($summary, ' '));
        return $summary . '...';
    }
}

/**
 * Estimate the reading time for the given blog content.
 *
 * This function estimates how long it would take to read the provided blog content.
 * It returns the value in minutes if $timeFormat is "m", or in seconds if $timeFormat is "s".
 *
 * @param string $blogContent The content of the blog to estimate reading time for.
 * @param string $timeFormat The format of the returned time, either "m" for minutes or "s" for seconds. Default is "m".
 * @return int The estimated reading time in the specified format.
 */
if(!function_exists('estimateReadTime')){
    function estimateReadTime($blogContent, $timeFormat = "m") {
        // Remove HTML tags to count only text
        $textOnly = strip_tags($blogContent);
        
        // Count words
        $wordCount = str_word_count($textOnly);
        
        // Average reading speed (words per minute)
        // Typical adult reading speed is around 200-250 words per minute
        $wordsPerMinute = 225;
        
        // Calculate read time in minutes
        $readTimeMinutes = ceil($wordCount / $wordsPerMinute);
        
        // Convert to seconds if requested
        if ($timeFormat === "s") {
            return $readTimeMinutes * 60;
        }
        
        // Default is minutes
        return $readTimeMinutes;
    }
}

/**
 * Checks if the application is running in a local development environment.
 *
 * This function determines if the application is running on a local
 * development server by checking if the HTTP_HOST contains 'localhost'.
 *
 * @return bool True if the environment is local, false otherwise.
 *
 * @example
 * if (isLocalEnvironment()) {
 *     echo "Running in local development.";
 * } else {
 *     echo "Running on a production or staging server.";
 * }
 */
if (! function_exists('isLocalEnvironment')) {
    function isLocalEnvironment(): bool
    {
        // Check if the HTTP_HOST superglobal is set and contains 'localhost'.
        return (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false);
    }
}

/**
 * Minify CSS file and return the minified version's URL.
 *
 * @param string $css_path Path to the CSS file.
 * @return string URL to the minified CSS file.
 */
if (!function_exists('minifyCSS')) {
    function minifyCSS($css_path)
    {
        // Ensure the file exists
        if (!file_exists($css_path)) {
            return $css_path; // Return the original path if the file doesn't exist
        }

        // Generate a unique cache key for the file
        $cache_key = md5($css_path . filemtime($css_path));

        // Define the cache directory and minified file path
        $cache_dir = FCPATH . 'public/cache/assets/css/';
        $minified_file = $cache_dir . $cache_key . '.min.css';

        // Check if the minified file already exists
        if (!file_exists($minified_file)) {
            // Create the cache directory if it doesn't exist
            if (!is_dir($cache_dir)) {
                mkdir($cache_dir, 0755, true);
            }

            // Use the Minify library to minify the CSS
            $minifier = new Minify\CSS($css_path);
            $minified_css = $minifier->minify();

            // Post-process the minified CSS to fix ":;" -> ": ;"
            $minified_css = str_replace(':;', ': ;', $minified_css);

            // Save the minified CSS to the cache file
            file_put_contents($minified_file, $minified_css);
        }

        // Return the URL to the minified file
        return base_url('public/cache/assets/css/' . $cache_key . '.min.css');
    }
}


/**
 * Minify JavaScript file and return the minified version's URL.
 *
 * @param string $js_path Path to the JavaScript file.
 * @return string URL to the minified JavaScript file.
 */
if (!function_exists('minifyJS')) {
    function minifyJS($js_path)
    {
        // Ensure the file exists
        if (!file_exists($js_path)) {
            return $js_path; // Return the original path if the file doesn't exist
        }

        // Generate a unique cache key for the file
        $cache_key = md5($js_path . filemtime($js_path));

        // Define the cache directory and minified file path
        $cache_dir = FCPATH . 'public/cache/assets/js/';
        $minified_file = $cache_dir . $cache_key . '.min.js';

        // Check if the minified file already exists
        if (!file_exists($minified_file)) {
            // Create the cache directory if it doesn't exist
            if (!is_dir($cache_dir)) {
                mkdir($cache_dir, 0755, true);
            }

            // Use the Minify library to minify the JavaScript
            $minifier = new Minify\JS($js_path);
            $minifier->minify($minified_file);
        }

        // Return the URL to the minified file
        return base_url('public/cache/assets/js/' . $cache_key . '.min.js');
    }
}


/**
 * Retrieves recent activity logs from the database and formats them into an HTML table.
 *
 * This function checks if `getRecentActivityLogs` exists before defining it. It queries the 
 * `activity_logs` table, orders records by `created_at` in descending order, and limits the 
 * number of entries based on the system configuration. It then formats the results into an 
 * HTML table structure.
 *
 * @return string HTML table containing recent activity logs.
 */
if(!function_exists('getRecentActivityLogs'))
{
    function getRecentActivityLogs()
    {
        $tableName = "activity_logs";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(env('QUERY_LIMIT_200', 200)))
                     ->get();

        $count = 1;
        $tableData = "";
        foreach ($query->getResult() as $row) {
            $activityId = $row->activity_id;
            $activityBy = substr($row->activity_by, 0, 10)."...";
            $activityType = $row->activity_type;
            $activity = trimUUID($row->activity);
            $ipAddress = $row->ip_address;
            $country = $row->country;
            $device = $row->device;
            $createdAt = $row->created_at;

            $tableData .= "<tr>
                                <th>$count</th>
                                <th>$activityBy</th>
                                <th>$activityType</th>
                                <th>$activity</th>
                                <th>$ipAddress</th>
                                <th>$device</th>
                                <th>$country</th>
                                <th>$createdAt</th>
                            </tr>";
            $count++;
        }

        return "<table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>". lang('App.activity_by')."</th>
                        <th>". lang('App.activity_type')."</th>
                        <th>". lang('App.activity')."</th>
                        <th>". lang('App.ip_address')."</th>
                        <th>". lang('App.device')."</th>
                        <th>". lang('App.country')."</th>
                        <th>". lang('App.date_or_time')."</th>
                    </tr>
                    </thead>
                    <tbody>
                        $tableData
                    </tbody>
                </table>";
    }
}

/**
 * Retrieves recent activity logs in JSON format.
 *
 * @function getRecentActivityLogsInJson
 * @returns {string} JSON string containing the recent activity logs.
 */
if(!function_exists('getRecentActivityLogsInJson'))
{
    function getRecentActivityLogsInJson()
    {
        $tableName = "activity_logs";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(env('QUERY_LIMIT_200', 200)))
                     ->get();

        $activities = [];
        foreach ($query->getResult() as $row) {
            $activities[] = [
                '#' => count($activities) + 1,
                'Activity By' => substr($row->activity_by, 0, 10)."...",
                'Activity Type' => $row->activity_type,
                'Activity' => trimUUID($row->activity),
                'IP Address' => $row->ip_address,
                'Device' => $row->device,
                'Country' => $row->country,
                'Date/Time' => $row->created_at
            ];
        }

        return json_encode($activities, JSON_PRETTY_PRINT);
    }
}

/**
 * Retrieves recent visit statistics and generates an HTML table.
 *
 * @function getRecentVisitStats
 * @returns {string} HTML string representing the visit statistics table.
 */
if(!function_exists('getRecentVisitStats'))
{
    function getRecentVisitStats()
    {
        $tableName = "site_stats";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(env('QUERY_LIMIT_200', 200)))
                     ->get();

        $count = 1;
        $tableData = "";
        foreach ($query->getResult() as $row) {
            $siteStatId = $row->site_stat_id;
            $ipAddress = $row->ip_address;
            $deviceType = $row->device_type;
            $browserType = $row->browser_type;
            $pageType = $row->page_type;
            $pageVisitedId = $row->page_visited_id;
            $pageVisitedUrl = $row->page_visited_url;
            $referrer = $row->referrer;
            $statusCode = $row->status_code;
            $userId = $row->user_id;
            $user = getActivityBy($userId);
            $sessionId = $row->session_id;
            $requestMethod = $row->request_method;
            $operatingSystem = $row->operating_system;
            $country = $row->country;
            $screenResolution = $row->screen_resolution;
            $userAgent = $row->user_agent;
            $otherParams = $row->other_params;
            $createdAt = $row->created_at;

            $tableData .= "<tr>
                                <th>$count</th>
                                <th>$ipAddress</th>
                                <th>$deviceType</th>
                                <th>$browserType</th>
                                <th>$pageVisitedUrl</th>
                                <th>$user</th>
                                <th>$operatingSystem</th>
                                <th>$country</th>
                                <th>$createdAt</th>
                            </tr>";
            $count++;
        }

        return "<table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>". lang('App.ip_address') ."</th>
                        <th>". lang('App.device') ."</th>
                        <th>". lang('App.browser') ."</th>
                        <th>". lang('App.url') ."</th>
                        <th>". lang('App.user') ."</th>
                        <th>". lang('App.operating_system') ."</th>
                        <th>". lang('App.country') ."</th>
                        <th>". lang('App.visit_date') ."</th>
                    </tr>
                    </thead>
                    <tbody>
                        $tableData
                    </tbody>
                </table>";
    }
}

/**
 * Retrieves recent visit statistics in JSON format.
 *
 * @function getRecentVisitStatsInJson
 * @returns {string} JSON string containing recent visit statistics.
 */
if(!function_exists('getRecentVisitStatsInJson'))
{
    function getRecentVisitStatsInJson()
    {
        $tableName = "site_stats";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(env('QUERY_LIMIT_200', 200)))
                     ->get();

        $visits = [];
        foreach ($query->getResult() as $row) {
            $visits[] = [
                '#' => count($visits) + 1,
                'IP' => $row->ip_address,
                'Device' => $row->device_type,
                'Browser' => $row->browser_type,
                'URL' => $row->page_visited_url,
                'User' => getActivityBy($row->user_id),
                'OS' => $row->operating_system,
                'Country' => $row->country,
                'Visit Date' => $row->created_at,
                'Page Type' => $row->page_type,
                'Referrer' => $row->referrer,
                'Status Code' => $row->status_code,
                'Session ID' => $row->session_id,
                'Request Method' => $row->request_method,
                'Screen Resolution' => $row->screen_resolution,
                'User Agent' => $row->user_agent,
                'Other Parameters' => $row->other_params
            ];
        }

        return json_encode($visits, JSON_PRETTY_PRINT);
    }
}


/**
 * Checks if a specific feature is enabled based on environment configuration.
 *
 * This function verifies whether the given feature flag is enabled by checking
 * the environment variable. It returns true if the variable is set to the
 * string 'true' or the boolean true.
 *
 * @param string $feature The name of the environment variable representing the feature flag.
 * @return bool Returns true if the feature is enabled; otherwise, false.
 */
if (!function_exists('isFeatureEnabled')) {
    function isFeatureEnabled(string $feature): bool
    {
        if(isFeatureExemptedUser())
        {
            return true;
        }

        return env($feature, false) === 'true' || env($feature, false) === true;
    }
}

if (!function_exists('isFeatureExemptedUser')) {
    function isFeatureExemptedUser(): bool
    {
        $session = session();
        $sessionEmail = $session->get('email');

        $exemptUsersList = env("FEATURE_FLAG_EXEMPTIONS");
        $exemptUsersArray = preg_split ("/\,/", $exemptUsersList); 

        if(in_array($sessionEmail, $exemptUsersArray))
        {
            return true;
        }

        return false;
    }
}

/**
 * Check if plugin is compatible with current Igniter CMS version
 */
function checkCompatibility($plugin)
{
    $ciVersion = \CodeIgniter\CodeIgniter::CI_VERSION;
    $minRequired = $plugin['min_igniter_requirement'] ?? '1.0.0';
    return version_compare($ciVersion, $minRequired, '>=');
}

/**
 * Parse star rating from string format (e.g., "4/5")
 */
function parseStarRating($rating)
{
    if (preg_match('/(\d+)\/(\d+)/', $rating, $matches)) {
        return [
            'score' => (int)$matches[1],
            'total' => (int)$matches[2],
            'percentage' => ((int)$matches[1] / (int)$matches[2]) * 100
        ];
    }
    
    return ['score' => 0, 'total' => 5, 'percentage' => 0];
}

/**
 * Format last updated date
 */
function formatLastUpdated($date)
{
    if (empty($date)) {
        return 'Unknown';
    }
    
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        return 'Unknown';
    }
    
    $now = time();
    $diff = $now - $timestamp;
    
    if ($diff < 86400) { // Less than 1 day
        return 'Today';
    } elseif ($diff < 604800) { // Less than 1 week
        return ceil($diff / 86400) . ' days ago';
    } elseif ($diff < 2592000) { // Less than 1 month
        return ceil($diff / 604800) . ' weeks ago';
    } else {
        return date('M j, Y', $timestamp);
    }
}


/**
 * Retrieves Igniter-CMS knowledge base in JSON format.
 *
 * @function getSiteKnowledgeBaseInJson
 * @returns {string} JSON string containing Igniter-CMS knowledge base, or an error object if fetch/decode fails.
 */
if (!function_exists('getSiteKnowledgeBaseInJson')) {
    function getSiteKnowledgeBaseInJson()
    {
        $cache = \Config\Services::cache();
        $cacheKey = 'igniter_knowledge_base';

        // Check cache first
        $cachedData = $cache->get($cacheKey);
        if ($cachedData !== null) {
            return $cachedData;
        }

        $url = env('AI_KNOWLEDGE_BASE_URL');

        $client = \Config\Services::curlrequest();
        
        try {
            // Perform the GET request
            $response = $client->request('GET', $url, [
                'timeout' => 30,
                'verify' => false,
                'http_errors' => false,
                'allow_redirects' => true
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                $errorData = json_encode([
                    'error' => 'HTTP Error',
                    'code' => $statusCode,
                    'body_preview' => substr($response->getBody(), 0, 200)
                ], JSON_PRETTY_PRINT);
                return $errorData;
            }

            $body = trim($response->getBody());
            
            // Ensure it's valid JSON
            $decoded = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $jsonData = json_encode($decoded, JSON_PRETTY_PRINT);
                
                // Cache for 24 hours (86400 seconds)
                $cache->save($cacheKey, $jsonData, 86400);
                
                return $jsonData;
            } else {
                $errorData = json_encode([
                    'error' => 'JSON Decode Error',
                    'message' => json_last_error_msg(),
                    'body_preview' => substr($body, 0, 200)
                ], JSON_PRETTY_PRINT);
                return $errorData;
            }
            
        } catch (\Exception $e) {
            $errorData = json_encode([
                'error' => 'Request Exception',
                'message' => $e->getMessage(),
            ], JSON_PRETTY_PRINT);
            return $errorData;
        }
    }
}

/**
 * Trims a UUID string by replacing the middle portion with ellipses (`.....`).
 *
 * This function uses regular expressions to match UUIDs and replace part of them,
 * keeping the initial segment intact while replacing the latter portion.
 *
 * @param string $string The input string containing a UUID.
 * @return string The modified string with the UUID trimmed.
 */
function trimUUID($string) {
    return preg_replace('/([a-f0-9]{8}-[a-f0-9]{4}-)[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}/', '$1.....', $string);
}

/**
 * Check if the given text is a valid email address.
 *
 * @param string $text The text to check.
 * @return bool True if the text is a valid email address, false otherwise.
 */
function isEmail($text) {
    return filter_var($text, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if the given string is a valid URL.
 *
 * @param string $url The string to check.
 * @return bool True if the string is a valid URL, false otherwise.
 */
function isUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Check if the given value is a number.. Uses php's is_numeric function
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is a number, false otherwise.
 */
function isNumber($value) {
    return is_numeric($value);
}

/**
 * Check if the given value is an integer.
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is an integer, false otherwise.
 */
function isInteger($value) {
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

/**
 * Check if the given value is a string. Uses php's is_string function
 *
 * @param mixed $value The value to check.
 * @return bool True if the value is a string, false otherwise.
 */
function isString($value) {
    return is_string($value);
}

/**
 * Check if the given value is a valid date.
 *
 * @param string $date The value to check.
 * @return bool True if the value is a valid date, false otherwise.
 */
function isDate($date) {
    return (bool)strtotime($date);
}

/**
 * Makes a request to Gemini API and returns plain text response.
 *
 * @param string $prompt The input prompt for the AI.
 * @param bool $formatResponse Format response by remoming markdown.
 * @return string|null Plain text response or null if failed.
 */
if (!function_exists('makeGeminiCall')) {
    function makeGeminiCall($prompt, $formatResponse = true)
    {
        // 1. Pull correct keys from .env
        $baseUrl = env('GEMINI_REQUEST_URL'); 
        $apiKey = env('GEMINI_REQUEST_KEY');

        if (empty($baseUrl) || empty($apiKey)) {
            return "Configuration Error: API Key or URL missing.";
        }

        $postData = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($postData),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'x-goog-api-key: ' . $apiKey // Pass the key as a header, not in the URL
            ],
            // Recommended: Keep this true in production for security!
            CURLOPT_SSL_VERIFYPEER => false, 
        ]);

        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return "CURL Error: " . $error_msg;
        }
        
        curl_close($ch);

        if (!$response) return null;

        $json = json_decode($response, true);
        
        // Check if API returned an error message
        if (isset($json['error'])) {
            return "API Error: " . ($json['error']['message'] ?? 'Unknown error');
        }

        $returnData = $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
        if($formatResponse){
            return formatAiResponse($returnData);
        }
        return $returnData;
    }
}

/**
 * Formats AI response by removing unnecessary metadata and enhancing formatting.
 *
 * @param string|null $response The raw AI response
 * @return string|null Cleaned response in plain text or HTML format
 */
if (!function_exists('formatAiResponse')) {
    function formatAiResponse($response, $format = "text")
    {
        if (empty($response)) return null;

        // 1. Clean up Gemini's triple backtick code blocks (```markdown ... ```)
        $response = preg_replace('/```(?:markdown|html|json)?\n?|```/', '', $response);
        $response = trim($response);

        // 2. Handle Plain Text format
        if ($format === 'text') {
            $response = preg_replace('/\*\*(.*?)\*\*/', '$1', $response); // Remove Bold stars
            $response = preg_replace('/^#+\s+/m', '', $response);        // Remove Headers
            $response = preg_replace('/^\s*[\*\-]\s+/m', '• ', $response); // Bullets to dots
            return nl2br($response);
        }

        // 3. Handle HTML format (The "Raw" Parser)
        if ($format === 'html') {
            // Headings: # Header -> <h1>Header</h1>
            $response = preg_replace_callback('/^#{1,6} (.*)$/m', function ($matches) {
                $level = strlen(explode(' ', $matches[0])[0]);
                return "<h$level>" . trim($matches[1]) . "</h$level>";
            }, $response);

            // Bold: **text** -> <strong>text</strong>
            $response = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $response);

            // Italics: *text* or _text_ -> <em>text</em>
            $response = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $response);

            // Unordered Lists: * item -> <li>item</li> (wrapped in <ul>)
            $response = preg_replace_callback('/^[\*\-]\s+(.*)$/m', function($matches) {
                return "<ul><li>" . trim($matches[1]) . "</li></ul>";
            }, $response);
            
            // Clean up multiple <ul> tags created by the line-by-line regex
            $response = str_replace("</ul>\n<ul>", "", $response);

            // Horizontal Rule: --- -> <hr>
            $response = preg_replace('/^---$/m', '<hr>', $response);

            // Paragraphs: Wrap blocks of text separated by double newlines
            // (Only if not already an HTML tag)
            $lines = explode("\n", $response);
            foreach ($lines as &$line) {
                $line = trim($line);
                if (!empty($line) && $line[0] !== '<') {
                    $line = "<p>$line</p>";
                }
            }
            return implode("\n", $lines);
        }

        return $response; // Return raw markdown for 'markdown' format
    }
}

/**
 * Checks if the GEMINI_REQUEST_KEY in the .env file is valid.
 * * @return bool
 */
if (! function_exists('isValidGeminiKey')) {
    function isValidGeminiKey(): bool
    {
        $apiKey = env('GEMINI_REQUEST_KEY');

        if (empty($apiKey)) {
            return false;
        }

        /**
         * Pattern Breakdown:
         * ^AIza       - Must start with 'AIza' (Standard for Google Cloud/AI keys)
         * [a-zA-Z0-9_-] - Allows letters, numbers, underscores, and hyphens
         * {35}        - Expects 35 more characters (39 total)
         */
        $pattern = '/^AIza[a-zA-Z0-9_-]{35}$/';

        return (bool) preg_match($pattern, $apiKey);
    }
}

/**
 * Get AI language instruction based on locale
 * 
 * @param string $locale The locale code (e.g., 'en', 'ar', 'fr')
 * @return string The instruction for AI to respond in the specified language
 */
if (!function_exists('getAILanguageInstruction')) {
    function getAILanguageInstruction()
    {
        // Get current locale
        $locale = getCurrentLocale();
        
        // Map of locale codes to language instructions
        $languageInstructions = [
            'en' => 'Provide your response in English language.',
            'ar' => 'Provide your response in Arabic language. قدم ردك باللغة العربية.',
            'fr' => 'Provide your response in French language. Fournissez votre réponse en français.',
            'es' => 'Provide your response in Spanish language. Proporcione su respuesta en español.',
            'de' => 'Provide your response in German language. Geben Sie Ihre Antwort auf Deutsch.',
            'zh' => 'Provide your response in Chinese language. 请用中文提供您的回答。',
            'hi' => 'Provide your response in Hindi language. कृपया हिंदी में उत्तर दें।',
            'pt' => 'Provide your response in Portuguese language. Forneça sua resposta em português.',
            'bn' => 'Provide your response in Bengali language. অনুগ্রহ করে বাংলায় আপনার উত্তর দিন।',
            'ja' => 'Provide your response in Japanese language. 日本語で回答を提供してください。',
            'ur' => 'Provide your response in Urdu language. براہ کرم اردو میں جواب دیں۔',
            'id' => 'Provide your response in Indonesian language. Berikan jawaban Anda dalam bahasa Indonesia.',
            'tr' => 'Provide your response in Turkish language. Lütfen cevabınızı Türkçe olarak verin.',
            'it' => 'Provide your response in Italian language. Fornisci la tua risposta in italiano.',
            'nl' => 'Provide your response in Dutch language. Geef uw antwoord in het Nederlands.',
            'pl' => 'Provide your response in Polish language. Proszę udzielić odpowiedzi w języku polskim.',
            'uk' => 'Provide your response in Ukrainian language. Будь ласка, надайте відповідь українською мовою.',
            'vi' => 'Provide your response in Vietnamese language. Vui lòng cung cấp câu trả lời bằng tiếng Việt.',
            'th' => 'Provide your response in Thai language. กรุณาให้คำตอบเป็นภาษาไทย',
            'fa' => 'Provide your response in Persian language. لطفاً پاسخ خود را به زبان فارسی ارائه دهید.',
            'ro' => 'Provide your response in Romanian language. Vă rugăm să furnizați răspunsul în limba română.',
            'hu' => 'Provide your response in Hungarian language. Kérjük, válaszát magyar nyelven adja meg.',
            'sv' => 'Provide your response in Swedish language. Vänligen ge ditt svar på svenska.',
            'cs' => 'Provide your response in Czech language. Odpovězte prosím v češtině.',
            'el' => 'Provide your response in Greek language. Παρακαλώ δώστε την απάντησή σας στα ελληνικά.',
            'he' => 'Provide your response in Hebrew language. אנא ספק את תשובתך בעברית.',
            'ko' => 'Provide your response in Korean language. 한국어로 답변을 제공해주세요.',
            'ms' => 'Provide your response in Malay language. Sila berikan jawapan anda dalam bahasa Melayu.',
        ];
        
        // Return instruction for the given locale, or English if not found
        return $languageInstructions[$locale] ?? $languageInstructions['en'];
    }
}

/**
 * Sanitize/Clean user input for search queries
 *
 * @param string $input
 * @return string
 */
if (!function_exists('sanitizeSearchInput')) {
    function sanitizeSearchInput($input)
    {
        // Remove HTML tags
        $input = strip_tags($input);

        // Remove non-printable characters
        $input = preg_replace('/[\x00-\x1F\x7F]/u', '', $input);

        // Escape special SQL wildcard characters
        $input = str_replace(['%', '_'], ['\%', '\_'], $input);

        // Trim whitespace
        return trim($input);
    }
}

/**
 * Get all locale display names
 * 
 * @return array
 */
if (!function_exists('getLocaleNames')) {
    function getLocaleNames()
    {
        return [
            'en' => 'English',
            'fr' => 'Français',
            'es' => 'Español',
            'ar' => 'العربية',
            'zh' => '中文',
            'ru' => 'Русский',
            'de' => 'Deutsch',
            'hi' => 'हिन्दी',
            'pt' => 'Português',
            'bn' => 'বাংলা',
            'ja' => '日本語',
            'it' => 'Italiano',
            'tr' => 'Türkçe',
            'nl' => 'Nederlands',
            'pl' => 'Polski',
            'uk' => 'Українська',
            'vi' => 'Tiếng Việt',
            'th' => 'ไทย',
            'fa' => 'فارسی',
            'ro' => 'Română',
            'hu' => 'Magyar',
            'sv' => 'Svenska',
            'cs' => 'Čeština',
            'el' => 'Ελληνικά',
            'he' => 'עברית',
            'ko' => '한국어',
            'id' => 'Bahasa Indonesia',
            'ms' => 'Bahasa Melayu',
        ];
    }
}

/**
 * Get all locale flag class names
 * 
 * @return array
 */
if (!function_exists('getLocaleFlagNames')) {
    function getLocaleFlagNames()
    {
        return [
            'af'  => 'fi-za', // Afrikaans -> South Africa
            'am'  => 'fi-et', // Amharic -> Ethiopia
            'ar'  => 'fi-sa', // Arabic -> Saudi Arabia
            'az'  => 'fi-az', // Azerbaijani -> Azerbaijan
            'be'  => 'fi-by', // Belarusian -> Belarus
            'bg'  => 'fi-bg', // Bulgarian -> Bulgaria
            'bn'  => 'fi-bd', // Bengali -> Bangladesh
            'bs'  => 'fi-ba', // Bosnian -> Bosnia
            'ca'  => 'fi-es-ct', // Catalan -> Catalonia (Spain)
            'cs'  => 'fi-cz', // Czech -> Czech Republic
            'da'  => 'fi-dk', // Danish -> Denmark
            'de'  => 'fi-de', // German -> Germany
            'el'  => 'fi-gr', // Greek -> Greece
            'en'  => 'fi-gb', // English -> United Kingdom
            'es'  => 'fi-es', // Spanish -> Spain
            'et'  => 'fi-ee', // Estonian -> Estonia
            'fa'  => 'fi-ir', // Persian -> Iran
            'fi'  => 'fi-fi', // Finnish -> Finland
            'fil' => 'fi-ph', // Filipino -> Philippines
            'fr'  => 'fi-fr', // French -> France
            'he'  => 'fi-il', // Hebrew -> Israel
            'hi'  => 'fi-in', // Hindi -> India
            'hr'  => 'fi-hr', // Croatian -> Croatia
            'hu'  => 'fi-hu', // Hungarian -> Hungary
            'hy'  => 'fi-am', // Armenian -> Armenia
            'id'  => 'fi-id', // Indonesian -> Indonesia
            'is'  => 'fi-is', // Icelandic -> Iceland
            'it'  => 'fi-it', // Italian -> Italy
            'ja'  => 'fi-jp', // Japanese -> Japan
            'ka'  => 'fi-ge', // Georgian -> Georgia
            'kk'  => 'fi-kz', // Kazakh -> Kazakhstan
            'km'  => 'fi-kh', // Khmer -> Cambodia
            'ko'  => 'fi-kr', // Korean -> South Korea
            'lo'  => 'fi-la', // Lao -> Laos
            'lt'  => 'fi-lt', // Lithuanian -> Lithuania
            'lv'  => 'fi-lv', // Latvian -> Latvia
            'mk'  => 'fi-mk', // Macedonian -> North Macedonia
            'ml'  => 'fi-in', // Malayalam -> India
            'mn'  => 'fi-mn', // Mongolian -> Mongolia
            'ms'  => 'fi-my', // Malay -> Malaysia
            'my'  => 'fi-mm', // Burmese -> Myanmar
            'nb'  => 'fi-no', // Norwegian Bokmål -> Norway
            'nl'  => 'fi-nl', // Dutch -> Netherlands
            'pl'  => 'fi-pl', // Polish -> Poland
            'pt'  => 'fi-pt', // Portuguese -> Portugal
            'ro'  => 'fi-ro', // Romanian -> Romania
            'ru'  => 'fi-ru', // Russian -> Russia
            'sk'  => 'fi-sk', // Slovak -> Slovakia
            'sl'  => 'fi-si', // Slovenian -> Slovenia
            'sq'  => 'fi-al', // Albanian -> Albania
            'sr'  => 'fi-rs', // Serbian -> Serbia
            'sv'  => 'fi-se', // Swedish -> Sweden
            'sw'  => 'fi-ke', // Swahili -> Kenya
            'ta'  => 'fi-in', // Tamil -> India
            'te'  => 'fi-in', // Telugu -> India
            'th'  => 'fi-th', // Thai -> Thailand
            'tr'  => 'fi-tr', // Turkish -> Turkey
            'uk'  => 'fi-ua', // Ukrainian -> Ukraine
            'ur'  => 'fi-pk', // Urdu -> Pakistan
            'uz'  => 'fi-uz', // Uzbek -> Uzbekistan
            'vi'  => 'fi-vn', // Vietnamese -> Vietnam
            'zh'  => 'fi-cn', // Chinese -> China
        ];
    }
}

/**
 * Get display name for a specific locale
 * 
 * @param string $locale
 * @return string
 */
if (!function_exists('getLocaleDisplayName')) {
    function getLocaleDisplayName($locale)
    {
        $localeNames = getLocaleNames();
        return $localeNames[$locale] ?? ucfirst($locale);
    }
}

/**
 * Get flag class for a specific locale
 * 
 * @param string $locale
 * @return string
 */
if (!function_exists('getLocaleFlagClass')) {
    function getLocaleFlagClass($locale)
    {
        $localeFlagNames = getLocaleFlagNames();
        return $localeFlagNames[$locale] ?? 'fi-placeholder';
    }
}

/**
 * Get current locale from request or session
 * 
 * @return string
 */
if (!function_exists('getCurrentLocale')) {
    function getCurrentLocale()
    {
        $request = service('request');
        $session = session();
        
        // Try to get from request first
        $locale = $request->getLocale();
        
        // If not, try session
        if (!$locale) {
            $locale = $session->get('locale');
        }
        
        // Default to English
        return $locale ?: 'en';
    }
}

/**
 * Get supported locales from config
 * 
 * @return array
 */
if (!function_exists('getSupportedLocales')) {
    function getSupportedLocales()
    {
        $config = config('App');
        return $config->supportedLocales;
    }
}