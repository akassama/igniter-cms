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
        return 'https://ignitercms.com/assets/img/default/default-profile.png';
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
                        <th>Activity By</th>
                        <th>Activity Type</th>
                        <th>Activity</th>
                        <th>IP Address</th>
                        <th>Device</th>
                        <th>Country</th>
                        <th>Date/Time</th>
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
                        <th>IP</th>
                        <th>Device</th>
                        <th>Browser</th>
                        <th>URL</th>
                        <th>User</th>
                        <th>OS</th>
                        <th>Country</th>
                        <th>Visit Date</th>
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
 * @returns {string} JSON string containing Igniter-CMS knowledge base.
 */
if(!function_exists('getSiteKnowledgeBaseInJson'))
{
    function getSiteKnowledgeBaseInJson()
    {
        $knowledgeBase = [
            "cms_name" => "Igniter-CMS",
            "version" => "1.0.0",
            "description" => "Igniter CMS is a free, open-source content management system built on CodeIgniter, designed to help you manage various types of content with flexibility and extensibility. Supports both MVC and headless architecture.",
            "website" => "https://ignitercms.com/",
            "documentation" => "https://docs.ignitercms.com/",
            "github" => "https://github.com/akassama/igniter-cms",
            "demo" => "https://demo.ignitercms.com/",
            "modules" => [
                [
                    "name" => "Dashboard",
                    "description" => "The dashboard is the landing page of the backend and includes the following features.",
                    "endpoints" => [
                        "/account/dashboard",
                        "/account/"
                    ]
                ],
                [
                    "name" => "CMS (Content Management System)",
                    "description" => "The CMS module allows you to manage the website's content, including blogs, pages, and navigations.",
                    "endpoints" => [
                        // CMS Home
                        "/account/cms",

                        // Blogs
                        "/account/cms/blogs",
                        "/account/cms/blogs/new-blog",
                        "/account/cms/blogs/edit-blog/{blog-id}",
                        "/account/cms/blogs/view-blog/{blog-id}",

                        // Categories
                        "/account/cms/categories",
                        "/account/cms/categories/new-category",
                        "/account/cms/categories/edit-category/{category-id}",
                        "/account/cms/categories/view-category/{category-id}",

                        // Navigations
                        "/account/cms/navigations",
                        "/account/cms/navigations/new-navigation",
                        "/account/cms/navigations/edit-navigation/{navigation-id}",
                        "/account/cms/navigations/view-navigation/{navigation-id}",

                        // Pages
                        "/account/cms/pages",
                        "/account/cms/pages/new-page",
                        "/account/cms/pages/edit-page/{page-id}",
                        "/account/cms/pages/view-page/{page-id}",

                        // Content Blocks
                        "/account/cms/blocks",
                        "/account/cms/blocks/new-block",
                        "/account/cms/blocks/edit-block/{block-id}",
                        "/account/cms/blocks/view-block/{block-id}",
                    ],
                    "management" => "All CMS sub-modules can be manage from '/account/cms/{module-name}'",
                    "deletion" => "To delete any record, go to the management page ('/account/cms/{module-name}'), e.g. '/account/cms/blogs' and click on the delete (x) button, then confirm deletion prompt.",
                ],
                [
                    "name" => "File Manager",
                    "description" => "Upload, manage, and organize files (images, videos, audios, documents, etc.) for use within the application.",
                    "endpoints" => [
                        // File Manager Home
                        "/account/file-manager",

                        // File Uploads
                        "/account/file-manager/upload-file",
                        "/account/file-manager/add-file-url",
                    ],
                    "management" => "All files can be manage from '/account/file-manager'",
                    "deletion" => "To delete any file, go to the management page ('/account/file-manager'), and click on the delete (x) button, then confirm deletion prompt.",
                    "edit name" => "To edit any file data, go to the management page ('/account/file-manager'), and click on the edit file icon (pen) under the 'File' table column.",
                    "file editing" => "To edit any file (e.g. crop or resize), go to the management page ('/account/file-manager'), and click on the edit file icon (pen) under the 'Actions' table column.",
                    "copy file" => "To copy any file, go to the management page ('/account/file-manager'), and click on the copy icon under the 'Actions' table column.",
                    "download file" => "To download any file, go to the management page ('/account/file-manager'), and click on the download icon under the 'Actions' table column.",
                ],
                [
                    "name" => "Settings",
                    "description" => "This is the module for managing your account details and changing passwords.",
                    "endpoints" => [
                        // Settings Home
                        "/account/settings",

                        // Update Account Details
                        "/account/settings/update-details",

                        // Change Password
                        "/account/settings/change-password",
                    ],
                    "management" => "To update your account details, go to '/account/settings/update-details'. To update/change your account password, go to '/account/settings/change-password', enter old and new passwords."
                ],
                [
                    "name" => "Admin Management",
                    "description" => "The Admin module provides features for managing users, system configurations, and website functionality.",
                    "endpoints" => [
                        // Admin Home
                        "/account/settings",

                        // Manage Users
                        "/account/admin/users",
                        "/account/admin/users/new-user",
                        "/account/admin/users/edit-user/{user-id}",
                        "/account/admin/users/view-user/{user-id}",

                        // Configurations
                        "/account/admin/configurations",

                        // Codes (No View)
                        "/account/admin/codes",
                        "/account/admin/codes/new-code",
                        "/account/admin/codes/edit-code/{code-id}",

                        // API Keys (No View)
                        "/account/admin/api-keys",
                        "/account/admin/api-keys/new-api-key",
                        "/account/admin/api-keys/edit-api-key/{api-key-id}",

                        // Activity Logs (Only View)
                        "/account/admin/activity-logs",

                        // Logs (Only View)
                        "/account/admin/logs",

                        // Visit Stats (Only View or Delete)
                        "/account/admin/visit-stats",

                        // Blocked IPs (Only Delete)
                        "/account/admin/blocked-ips",

                        // Whitelisted IPs (Only Delete)
                        "/account/admin/whitelisted-ips",

                        // Backups (Only Delete or Download)
                        "/account/admin/backups",

                        // File Editor
                        "/account/appearance/theme-editor/layout",
                        "/account/appearance/theme-editor/home",
                        "/account/appearance/theme-editor/blogs",
                        "/account/appearance/theme-editor/view-blog",
                        "/account/appearance/theme-editor/view-page",
                        "/account/appearance/theme-editor/search",
                        "/account/appearance/theme-editor/search-filter",
                        "/account/appearance/theme-editor/sitemap",
                    ],
                    "management" => "All Admin sub-modules can be manage from '/account/admin/{module-name}'",
                    "deletion" => "To delete any record, go to the management page ('/account/admin/{module-name}'), e.g. '/account/admin/users' and click on the delete (x) button, then confirm deletion prompt.",
                ]
            ],
            "frontend" => [
                "framework" => "Bootstrap, PHP, and any CSS or JavaScript framework of your choice.",
                "features" => [
                    "Responsive design",
                    "AI assistance support",
                    "Theme customization",
                ],
                "customization" => "To customize your theme, manage theme files in '/your-app/app/Views/front-end/themes/{theme-name}/'. The themes folder has the following directories and files: blogs (index.php, view-blog.php), home (index.php), includes (_functions.php), layout (_layout.php), pages (view-page.php), search (index.php, filter.php)",
                "endpoints" => [
                    // Home Page
                    "/api/{api-key}/get-home-pages", // Retrieves the main homepage content and layout configuration.

                    // Generic Model Data
                    "/api/{api-key}/get-model-data?model=navigations&take=10&skip=0", // Fetch navigations (10 items, skip 0).
                    "/api/{api-key}/get-model-data?model=categories&where_clause={'status':1}", // Filtered categories.
                    "/api/{api-key}/get-model-data?model=blogs&where_clause={'blog_id':'{blog-id}'}", // Filtered blog by ID.
                    "/api/{api-key}/get-model-data?model=blogs&where_clause={'blog_id':'{blog-id}','status':1}", // Multiple filter.

                    // Blogs
                    "/api/{api-key}/get-all-blogs", // All published blogs.
                    "/api/{api-key}/get-blog/{blog_id}", // Blog by ID.
                    "/api/{api-key}/get-blogs?take=10&skip=0", // Paginated blogs.

                    // Categories
                    "/api/{api-key}/get-category/{category_id}",
                    "/api/{api-key}/get-categories",
                    "/api/{api-key}/get-categories?take=10&skip=0",

                    // Codes
                    "/api/{api-key}/get-code/{code_id}",
                    "/api/{api-key}/get-codes",
                    "/api/{api-key}/get-codes?take=10&skip=0",

                    // Content Blocks
                    "/api/{api-key}/get-content-block/{content_id}",
                    "/api/{api-key}/get-content-blocks",
                    "/api/{api-key}/get-content-blocks?take=10&skip=0",

                    // Countries
                    "/api/{api-key}/get-country/{country_id}",
                    "/api/{api-key}/get-countries",
                    "/api/{api-key}/get-countries?take=10&skip=0",

                    // Navigation
                    "/api/{api-key}/get-navigation/{navigation_id}",
                    "/api/{api-key}/get-navigations?take=10&skip=0",

                    // Pages
                    "/api/{api-key}/get-all-pages",
                    "/api/{api-key}/get-page/{page_id}",
                    "/api/{api-key}/get-pages?take=10&skip=0",

                    // Search
                    "/api/{api-key}/search-results?key=the",
                    "/api/{api-key}/model-search-results?type=blog&key=the",
                    "/api/{api-key}/filter-search-results?type=author&key=admin",

                    // Themes
                    "/api/{api-key}/get-theme/{theme_id}",
                    "/api/{api-key}/get-themes",
                    "/api/{api-key}/get-themes?take=10&skip=0",
                ]
            ],
            "backend" => [
                "framework" => "CodeIgniter",
                "features" => [
                    "Admin dashboard",
                    "Advanced logging",
                    "CMS module",
                    "File Management",
                    "Settings & Configurations",
                    "Admin Management",
                    "API-driven architecture"
                ]
            ],
            "setup_instructions" => [
                "Ensure your system meets the following requirements: PHP 8.0+, Composer, MySQL, a web server (Apache/Nginx), and the PHP zip extension enabled.",
                "Clone the repository: `git clone https://github.com/akassama/igniter-cms`.",
                "Navigate into the project directory: `cd igniter-cms`.",
                "Install dependencies using Composer: `composer install`.",
                "Configure the database in the `.env` file (create one if it doesn't exist) with your `hostname`, `database`, `username`, and `password`.",
                "Create the database using your preferred database tool (e.g., PhpMyAdmin) with the name specified in your configuration.",
                "Set the base URL in `.env` to match your local or deployment URL.",
                "Generate App Key: `php spark generate:key`. This command will generate/update the application key (APP_KEY) in `.env` file.",
                "Run migrations to set up database tables: `php spark migrate`.",
                "Ensure the `writable/` and `public/uploads/` directories are writable by the web server.",
                "Start your local web server and access the CMS at `https://localhost/igniter-cms`.",
                "Log in with the default admin credentials: Email: `admin@example.com`, Password: `Admin@1`.",
                "To change the default login, edit the `$ data[]` array in the migration file: `app/Database/Migrations/2024-08-27-210112_Users.php`.",
                "For email features, configure `EmailConfigType` via the Admin Panel: `/account/admin/configurations`.",
                "Delete Tables: if you want to clear all tables from the database, run the command `php spark delete:tables` and type `yes`."
            ],
            "troubleshooting" => [
                "database_connection" => [
                    "issue" => "Unable to connect to the database.",
                    "solution" => "Ensure database settings are correct in the `.env` file (or `app/Config/Database.php` if using that). Also verify the database server is running and accessible."
                ],
                "404_error" => [
                    "issue" => "Page not found.",
                    "solution" => "Check if routes are properly defined in `app/Config/Routes.php` and the controller/method exists. Also ensure mod_rewrite is enabled if using Apache."
                ],
                "500_internal_server" => [
                    "issue" => "Internal server error.",
                    "solution" => "Check `writable/logs/` for detailed error messages. This often indicates a misconfiguration, syntax error, or missing file."
                ],
                "env_file_missing" => [
                    "issue" => "Environment variables not loading.",
                    "solution" => "Ensure you have a valid `.env` file in the root directory and that it's not named `.env.example`. Clear cache with `php spark config:clear` if needed."
                ],
                "migrations_fail" => [
                    "issue" => "Migrations not running or failing.",
                    "solution" => "Check the migration files in `app/Database/Migrations/` for syntax or logic errors. Ensure your database exists and is properly connected."
                ],
                "permissions_error" => [
                    "issue" => "Permission denied on certain folders or files.",
                    "solution" => "Ensure `writable/` and `public/uploads/` directories are writable by the web server (e.g., using `chmod -R 775 writable/`)."
                ],
                "email_not_sending" => [
                    "issue" => "Emails are not being sent.",
                    "solution" => "Verify that your email settings are correctly configured in the Admin Panel (`/account/admin/configurations`). Also confirm your server allows outgoing mail and check logs for errors."
                ],
                "css_js_not_loading" => [
                    "issue" => "CSS or JS files are not loading.",
                    "solution" => "Check that the `baseURL` is correctly set in `app/Config/App.php` and that `public/` is the document root of your server."
                ],
                "composer_autoload" => [
                    "issue" => "Class not found or autoloading issues.",
                    "solution" => "Run `composer dump-autoload` to refresh the autoloader. Ensure namespaces and file paths follow PSR-4."
                ]
            ],
            "faq" => [
                [
                    "question" => "How do I reset my admin password?",
                    "answer" => "You can reset your password using the `Forgot Password` link on the login page or via the database."
                ],
                [
                    "question" => "Can I extend the CMS with plugins?",
                    "answer" => "Yes! You can create and integrate modules to extend functionality."
                ],
                [
                    "question" => "Can I buy themes for Igniter CMS?",
                    "answer" => "Yes, you cn buy modern and professional themes from https://themes.ignitercms.com"
                ],
                [
                    "question" => "Can I buy custom themes from themeforrest or codecanyon?",
                    "answer" => "Yes, you cn buy custom themes from https://themeforest.net"
                ],
                [
                    "question" => "How do I reset the database?",
                    "answer" => "Run 'php spark delete:tables' then run 'php spark migrate'"
                ],
                [
                    "question" => "How do I generate an app key?",
                    "answer" => "Run 'php spark generate:key'. This command will generate/update the application key (APP_KEY) in .env file."
                ],
                [
                    "question" => "How do I set it to demo mode?",
                    "answer" => "Set it to true (DEMO_MODE = true) in the .env file."
                ],
                [
                    "question" => "How do I set, customize the theme colors, set background/slider images, or footer copyright of the themes?",
                    "answer" => "To change any of these (colors, background, copyright) for the theme, go to admin/edit-theme and set it there."
                ],
                [
                    "question" => "How do I configure the email?",
                    "answer" => "In the .env file, see MAILJET_API_KEY, MAILJET_SECRET_KEY, anbd EMAIL_FROM. Default is Mailjet. The EmailService.php is in Services folder."
                ],
                [
                    "question" => "How do I install themes",
                    "answer" => "Go to Themes '/account/appearance/themes', if already added set as active, if not, click on '+ Add Theme' and download the theme. Go back to Theme and 'Upload Theme'."
                ],
                [
                    "question" => "How do I install plugins",
                    "answer" => "Go to Themes '/account/plugins', if already added set as activate and manage the plugin settings, if not, click on '+ Add Plugin' and download the plugin. Go back to Plugins and 'Upload Plugin'."
                ],
            ],
            "image_assets" => [
                [
                    "image_url" => "https://docs.ignitercms.com/images/upload/01-dashboard.png",
                    "image_description" => "Dashboard image"
                ],
                [
                    "image_url" => "https://docs.ignitercms.com/images/upload/02-cms.png",
                    "image_description" => "CMS management image"
                ],
                [
                    "image_url" => "https://docs.ignitercms.com/images/upload/48-files.png",
                    "image_description" => "File manager image"
                ],
                [
                    "image_url" => "https://docs.ignitercms.com/images/upload/50-settings.png",
                    "image_description" => "Settings management image"
                ],
                [
                    "image_url" => "https://docs.ignitercms.com/images/upload/53-admin.png",
                    "image_description" => "Admin Management"
                ],
            ],
            "configurations" => [
                [
                    "config_for" => "SiteName",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteEmail",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "siteSecondaryEmail",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteEnquiryEmail",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SitePhoneNumber",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteSecondaryNumber",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteAddress",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteAddressMap",
                    "data_type" => "Code",
                    "options" => null
                ],
                [
                    "config_for" => "CompanyOpeningHours",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MaintenanceMode",
                    "data_type" => "Select",
                    "options" => "Yes,No"
                ],
                [
                    "config_for" => "MaintenanceModeTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MaintenanceModeText",
                    "data_type" => "Textarea",
                    "options" => null
                ],
                [
                    "config_for" => "MetaTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MetaKeywords",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MetaAuthor",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MetaOgImage",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "BlogsPageMetaTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "BlogsPageSiteTitle",
                    "data_type" => "Textarea",
                    "options" => null
                ],
                [
                    "config_for" => "BlogsPageMetaKeywords",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SearchPageMetaTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SearchPageSiteTitle",
                    "data_type" => "Textarea",
                    "options" => null
                ],
                [
                    "config_for" => "SearchPageMetaKeywords",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SearchFilterPageMetaTitle",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SearchFilterPageSiteTitle",
                    "data_type" => "Textarea",
                    "options" => null
                ],
                [
                    "config_for" => "SearchFilterPageMetaKeywords",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "BackendLogoLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "BackendFaviconLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteLogoLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteLogoTwoLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteFaviconLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteFaviconLink96",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteFaviconLinkAppleTouch",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "SiteFaviconManifestLink",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "FrontEndFormat",
                    "data_type" => "Select",
                    "options" => "MVC,API"
                ],
                [
                    "config_for" => "AllowedApiGetModels",
                    "data_type" => "Textarea",
                    "options" => null
                ],
                [
                    "config_for" => "EnableGeminiAI",
                    "data_type" => "Select",
                    "options" => "Yes,No"
                ],
                [
                    "config_for" => "EnableGeminiAIAnalysis",
                    "data_type" => "Select",
                    "options" => "Yes,No"
                ],
                [
                    "config_for" => "GeminiAPIKey",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "GeminiBaseURL",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "EnableGlobalSearchIcon",
                    "data_type" => "Select",
                    "options" => "Yes,No"
                ],
                [
                    "config_for" => "HoneypotKey",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "TimestampKey",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "MaxFailedAttempts",
                    "data_type" => "Text",
                    "options" => null
                ],
                [
                    "config_for" => "FailedLoginsSuspensionPeriod",
                    "data_type" => "Select",
                    "options" => "+5 minutes,+10 minutes,+30 minutes,+1 hour,+3 hours,+24 hours"
                ],
                [
                    "config_for" => "BlockedIPSuspensionPeriod",
                    "data_type" => "Select",
                    "options" => "+1 day,+1 days,+1 month,+3 months,+6 months,+1 year,+3 years,+5 years,+10 years"
                ],
                [
                    "config_for" => "MaxUploadFileSize",
                    "data_type" => "Select",
                    "options" => "1,3,5,10,50,100,1000"
                ],
                [
                    "config_for" => "EnableIgniterNewsFeed",
                    "data_type" => "Select",
                    "options" => "Yes,No"
                ]
            ],
            
        ];

        return json_encode($knowledgeBase, JSON_PRETTY_PRINT);
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
 * @return string|null Plain text response or null if failed.
 */
if (!function_exists('makeGeminiCall')) {
    function makeGeminiCall($prompt)
    {
        $apiKey = getConfigData("GeminiAPIKey");
        $requestUrl = !empty($apiKey) ? getConfigData("GeminiBaseURL") . $apiKey : env('CUSTOM_GEMINI_REQUEST_URL') . env('PUBLIC_GEMINI_REQUEST_KEY');

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
            CURLOPT_URL             => $requestUrl,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => json_encode($postData),
            CURLOPT_HTTPHEADER      => ['Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER  => false,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        if (!$response) return null;

        $json = json_decode($response, true);
        $returnData =  $json['candidates'][0]['content']['parts'][0]['text'] ?? null;
        return formatAiResponse($returnData);
    }
}

/**
 * Formats AI response by removing unnecessary metadata and enhancing formatting.
 *
 * @param string|null $response The raw AI response
 * @return string|null Cleaned response in plain text or HTML format
 */
if (!function_exists('formatAiResponse')) {
    function formatAiResponse($response)
    {
        if (empty($response)) {
            return null;
        }

        // Check if response is HTML (contains HTML tags)
        if (strpos($response, '<div') !== false || strpos($response, '<ul') !== false || strpos($response, '<li') !== false) {
            // For HTML responses, return as-is after basic cleanup
            $response = preg_replace('/```html/', '', $response);
            $response = preg_replace('/```/', '', $response);
            return trim($response);
        }

        // For plain text responses, enhance formatting
        $response = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $response); // Bold to strong
        $response = preg_replace('/\*(.*?)\*/', '<em>$1</em>', $response); // Italics to em
        $response = preg_replace('/\n\s*\n/', "\n\n", $response); // Remove extra line breaks
        $response = nl2br(trim($response)); // Convert newlines to <br> tags

        // Remove any remaining markdown artifacts
        $response = str_replace(['# ', '## ', '### '], ['', '', ''], $response);

        return $response;
    }
}