<?php
use App\Models\ActivityLogsModel;
use App\Constants\ActivityTypes;
use App\Models\SiteStatsModel;
use App\Models\BlogsModel;
use App\Models\CategoriesModel;

/**
 * Get the logged-in user ID from the session
 * 
 * @returns {string} The logged-in user ID, or an empty string if not found
 */
if (!function_exists('getLoggedInUserId')) {
    function getLoggedInUserId()
    {
        // Check if the 'user_id' key exists in the session
        if (session()->has('user_id')) {
            return session()->get('user_id');
        }

        // Return an empty value if the 'user_id' key does not exist
        return '';
    }
}

/**
 * Checks if a user has a specific role.
 *
 * @param string $userEmail The user's email address.
 * @param string $role The role to check for.
 * @return boolean True if the user has the role, false otherwise.
 */
if(!function_exists('userHasRole')) {
    function userHasRole($userEmail, $role)
    {
        //user role
        $userRole = getUserRole($userEmail);

        if ($userRole == $role) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Gets the role of a user based on their email or username.
 *
 * @param string $userEmailOrUsername The user's email or username.
 * @return string|null The user's role, or null if not found.
 */
if (!function_exists('getUserRole')) {
    function getUserRole($userEmailOrUsername) {
        $db = \Config\Database::connect();

        //check if is UUID
        if(isValidGUID($userEmailOrUsername)){
            //get user email
            $userEmailOrUsername = getTableData("users", ['user_id' => $userEmailOrUsername], "email");
        }

        $column = isEmail($userEmailOrUsername) ? 'email' : 'username';

        $query = $db->table('users')
            ->select('role')
            ->where($column, $userEmailOrUsername)
            ->get();

        return $query->getNumRows() > 0 ? $query->getRow()->role : null;
    }
}

/**
 * Gets the status of a user based on their email or username.
 *
 * @param string $userEmailOrUsername The user's email or username.
 * @return string|null The user's status, or null if not found.
 */
if (!function_exists('getUserStatus')) {
    function getUserStatus($userEmailOrUsername) {
        $db = \Config\Database::connect();

        $column = isEmail($userEmailOrUsername) ? 'email' : 'username';

        $query = $db->table('users')
            ->select('status')
            ->where($column, $userEmailOrUsername)
            ->get();

        return $query->getNumRows() > 0 ? $query->getRow()->status : null;
    }
}

/**
 * Gets the HTML label for a user's status.
 *
 * @param string $status The user's status.
 * @return string The HTML label for the status.
 */
if (!function_exists('getUserStatusLabel')) {
    function getUserStatusLabel($status) {
        if($status == '0'){
            return "<span class='badge bg-secondary'>Inactive</span>";
        }
        else if($status == '1'){
            return "<span class='badge bg-success'>Active</span>";
        }
        else if($status == '2'){
            return "<span class='badge bg-danger'>Closed</span>";
        }
        else {
            return "<span class='badge bg-danger'>NA</span>";
        }
    }
}

/**
 * Gets the plain text status of a user.
 *
 * @param string $status The user's status.
 * @return string The plain text status.
 */
if (!function_exists('getUserStatusOnly')) {
    function getUserStatusOnly($status) {
        if($status == '0'){
            return "Inactive";
        }
        else if($status == '1'){
            return "Active";
        }
        else if($status == '2'){
            return "Closed";
        }
        else {
            return "NA";
        }
    }
}

/**
 * Determines if a password change is required for the currently logged-in user.
 * 
 * This function checks if the user's account has the password_change_required flag set.
 * It bypasses the check when running in development environment.
 * 
 * @param string|null $currentUrl The current URL (not used in the current implementation)
 * @return boolean Returns true if password change is required, false otherwise
 */
if (!function_exists('passwordChangeRequired')) {
    function passwordChangeRequired($currentUrl = null) 
    {
        // Skip password change requirement in development environment
        if (ENVIRONMENT === 'development') {
            return false;
        }

        $whereClause = ['user_id' => getLoggedInUserId()];
        $changeRequiredStatus = getTableData('users', $whereClause, 'password_change_required');
        if(filter_var($changeRequiredStatus, FILTER_VALIDATE_BOOLEAN)){
            return true;
        }
        return false;
    }
}

/**
 * Updates the user's "remember me" token and expiration date in the database.
 *
 * @param int|null    $userId      The user ID to update.
 * @param string|null $cookieToken The new remember-me token.
 * @param int|null    $expiresAt   The Unix timestamp when the token should expire.
 *
 * @return bool True on success.
 */
if (!function_exists('updateUserRememberMeTokens')) {
    function updateUserRememberMeTokens($userId = null, $cookieToken = null, $expiresAt = null) 
    {
        // Update DB
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('user_id', $userId)->update([
            'remember_token' => $cookieToken,
            'expires_at'     => $expiresAt
        ]);

        return true;
    }
}

/**
 * Creates, updates, or deletes a "remember me" cookie for the user.
 *
 * - If both $cookieName and $cookieToken are provided: creates/updates the cookie.
 * - If only $cookieName is provided: deletes the cookie by expiring it.
 *
 * @param string|null $cookieName     The cookie name.
 * @param string|null $cookieToken    The cookie token value. If null/empty, the cookie will be deleted.
 * @param int|null    $cookieExpiresAt The Unix timestamp for cookie expiration.
 *
 * @return bool True if a cookie was set or deleted, false otherwise.
 */
if (!function_exists('updateCookieRememberMeTokens')) {
    function updateCookieRememberMeTokens($cookieName = null, $cookieToken = null, $cookieExpiresAt = null) 
    {
        helper('cookie');

        if(!empty($cookieName) && !empty($cookieToken)){
            if(!isset($_COOKIE[$cookieName])) {
                setcookie($cookieName, $cookieToken, $cookieExpiresAt, "/");
            }
            return true;
        }
        else if (!empty($cookieName) && empty($cookieToken)) {
            $cookieExpiresAt = time() - 3600;
            setcookie($cookieName, $cookieToken, $cookieExpiresAt, "/");
            return true;
        }

        return false;
    }
}

/**
 * Generates breadcrumb HTML based on an array of links.
 *
 * @param {Array<{ title: string, url?: string }>} links - An array of link objects.
 * Each link object should have a 'title' property representing the link text,
 * and an optional 'url' property representing the link URL.
 * @returns {string} The HTML representation of the breadcrumbs.
 */
if (!function_exists('generateBreadcrumb')) {
    function generateBreadcrumb($links)
    {
        $output = '<ol class="breadcrumb mb-4 mt-2">';
        foreach ($links as $link) {
            if (isset($link['url']) && !empty($link['url'])) {
                $output .= '<li class="breadcrumb-item"><a href="' . base_url($link['url']) . '">' . $link['title'] . '</a></li>';
            } else {
                $output .= '<li class="breadcrumb-item active">' . $link['title'] . '</li>';
            }
        }
        $output .= '</ol>';
        return $output;
    }
}


/**
 * Generates a directory name based on a username.
 *
 * @param string $username The username to use.
 * @return string The generated directory name.
 */
if(!function_exists('generateUserDirectory')) {
    function generateUserDirectory($username) {
        $randomString = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 5);

        if (empty($username)) {
            $directoryName = $randomString;
        } else {
            $directoryName = $username . '_' . $randomString;
        }

        return $directoryName;
    }
}

/**
 * Generate a content identifier string.
 *
 * This function generates a random alphanumeric string of length 5
 * using lowercase letters and digits, and prefixes it with 'cb-'.
 * The resulting string is in the format 'cb-xxxxx' where 'xxxxx' is
 * the random alphanumeric string.
 *
 * @return string The generated content identifier.
 */
if (!function_exists('generateContentIdentifier')) {
    function generateContentIdentifier($prefix="content") {
        // Generate a random alphanumeric string of length 5
        $randomString = substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 5);

        // Prefix the random string with '$prefix' and return
        return $prefix ."-". $randomString;
    }
}

/**
 * Generate a random alphanumeric string with an optional file extension.
 *
 * @param string|null $fileExtension The file extension to append, if any.
 * @return string The generated string.
 */
if (!function_exists('getRandomFileName')) {
    function getRandomFileName($fileExtension = null) {
        // Generate a random integer and a random hexadecimal string
        $intPart = mt_rand(1000000000, 9999999999);
        $hexPart = bin2hex(random_bytes(10));

        // Combine them with an underscore
        $randomFileName = $intPart . '_' . $hexPart;

        // Append the file extension if provided
        if ($fileExtension) {
            $randomFileName .= '.' . ltrim($fileExtension, '.');
        }

        return $randomFileName;
    }
}

/**
 * Get the string name after the last "/" in a given URL.
 *
 * @param string $url The URL to extract the string name from.
 * @return string The extracted string name, or "NA" if the URL is null or empty.
 */
if (!function_exists('getFileNameFromUrl')) {
    function getFileNameFromUrl($url) {
        // Check if the URL is null or empty
        if (empty($url)) {
            return getRandomFileName(getFileExtension($url));
        }

        // Parse the URL and get the path component
        $path = parse_url($url, PHP_URL_PATH);

        // Get the base name of the path
        $fileName = basename($path);

        return $fileName;
    }
}

/**
 * Get the file size of a remote image or video.
 *
 * @param string $fileUrl The URL of the file.
 * @return int The file size in bytes, or 0 if the size cannot be determined.
 */
if (!function_exists('getRemoteFileSize')) {
    function getRemoteFileSize($fileUrl) {
        // Validate URL
        if (!filter_var($fileUrl, FILTER_VALIDATE_URL)) {
            return 0;
        }

        // Initialize curl
        $ch = curl_init($fileUrl);

        // Set curl options
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Execute request
        $headers = curl_exec($ch);

        // Check for errors
        if ($headers === false) {
            curl_close($ch);
            return 0;
        }

        // Get HTTP response code
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            curl_close($ch);
            return 0;
        }

        // Get file size from headers
        $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($ch);

        // Return file size or 0
        return $fileSize > 0 ? $fileSize : 0;
    }
}


if (!function_exists('getAudioPreviewFromUrl')) {
    function getAudioPreviewFromUrl($videoUrl, $width = 120) {
        
        return '<audio controls style="width: '.$width.'px">
                    <source src="'.getImageUrl($videoUrl ?? getDefaultImagePath()).'" type="audio/'.getFileExtension($videoUrl).'">
                    Your browser does not support the audio element.
                </audio>';
    }
}

/**
 * Generates a video preview HTML element from a given video URL.
 * 
 * @param {string} $videoUrl - The URL of the video to preview.
 * @param {int} $width - The desired width of the video preview (default: 320).
 * @returns {string|false} HTML video/iframe element or false if unsupported video URL.
 * 
 * @description Supports direct video files (mp4, webm, ogg) and video platforms:
 * - Direct video files
 * - YouTube
 * - Vimeo
 * - Dailymotion
 * 
 * @example
 * // Direct video file
 * echo getVideoPreviewFromUrl('https://example.com/video.mp4', 640);
 * 
 * @example
 * // YouTube video
 * echo getVideoPreviewFromUrl('https://www.youtube.com/watch?v=dQw4w9WgXcQ', 640);
 */
if (!function_exists('getVideoPreviewFromUrl')) {
    function getVideoPreviewFromUrl($videoUrl, $width = 160) {
        // Calculate height based on 16:9 aspect ratio
        $height = round($width * 9/16);
        
        // Check for direct video files
        if (preg_match('/\.(mp4|webm|ogg)$/i', $videoUrl)) {
            return sprintf(
                '<video width="%d" height="%d" controls>
                    <source src="%s" type="video/%s">
                    Your browser does not support the video tag.
                </video>',
                $width,
                $height,
                getImageUrl($videoUrl),
                strtolower(pathinfo($videoUrl, PATHINFO_EXTENSION))
            );
        }
        
        // Check for YouTube
        if ($youtubeId = getYoutubeId($videoUrl)) {
            return sprintf(
                '<iframe width="%d" height="%d" 
                    src="https://www.youtube.com/embed/%s" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>',
                $width,
                $height,
                htmlspecialchars($youtubeId)
            );
        }
        
        // Check for Vimeo
        if ($vimeoId = getVimeoId($videoUrl)) {
            return sprintf(
                '<iframe width="%d" height="%d" 
                    src="https://player.vimeo.com/video/%s" 
                    frameborder="0" 
                    allow="autoplay; fullscreen; picture-in-picture" 
                    allowfullscreen>
                </iframe>',
                $width,
                $height,
                htmlspecialchars($vimeoId)
            );
        }
        
        // Check for Dailymotion
        if ($dailymotionId = getDailymotionId($videoUrl)) {
            return sprintf(
                '<iframe width="%d" height="%d" 
                    src="https://www.dailymotion.com/embed/video/%s" 
                    frameborder="0" 
                    allow="autoplay; fullscreen; picture-in-picture" 
                    allowfullscreen>
                </iframe>',
                $width,
                $height,
                htmlspecialchars($dailymotionId)
            );
        }
        
        // Return false if no supported video format is found
        return false;
    }
}

/**
 * Extracts YouTube video ID from a URL.
 * 
 * @param {string} $url - YouTube video URL
 * @returns {string|false} Video ID or false if not found
 */
if (!function_exists('getYoutubeId')) {
    function getYoutubeId($url) {
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : false;
    }
}

/**
 * Extracts Vimeo video ID from a URL.
 * 
 * @param {string} $url - Vimeo video URL
 * @returns {string|false} Video ID or false if not found
 */
if (!function_exists('getVimeoId')) {
    function getVimeoId($url) {
        $pattern = '/(?:vimeo\.com\/)?([0-9]+)/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : false;
    }
}

/**
 * Extracts Dailymotion video ID from a URL.
 * 
 * @param {string} $url - Dailymotion video URL
 * @returns {string|false} Video ID or false if not found
 */
if (!function_exists('getDailymotionId')) {
    function getDailymotionId($url) {
        $pattern = '/(?:dailymotion\.com\/(?:video\/|embed\/|))([a-zA-Z0-9]+)/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : false;
    }
}

/**
 * Generates an input group HTML with a copy button.
 *
 * @param string $uniqueId Unique identifier to append to element IDs.
 * @param string|null $link The value to set in the input field. If null or empty, returns "--".
 * @return string The generated HTML string or "--" if $link is null/empty.
 */
if (!function_exists('getInputLinkTag')) {
    function getInputLinkTag(string $uniqueId, ?string $link): string
    {
        // Return "--" if the link is null or empty
        if (empty($link)) {
            return "--";
        }

        // Escape unique ID and link for safe output
        $escapedId = esc($uniqueId);
        $escapedLink = esc($link);

        // Generate and return the HTML string
        return <<<HTML
<div class="input-group col-12 mb-3">
    <input type="text" class="form-control" id="name-{$escapedId}" value="{$escapedLink}" readonly />
    <span class="input-group-text">
        <button class="btn btn-outline-secondary copy-btn copy-btn-label" type="button" id="button-{$escapedId}" data-clipboard-target="#name-{$escapedId}">
            <i class="ri-checkbox-multiple-fill"></i>
        </button>
    </span>
</div>
HTML;
    }  
}


/**
 * Check if records exist in a table.
 *
 * @param string $tableName      The name of the table.
 * @param string $primaryKey     The primary key column name.
 * @param mixed  $primaryKeyValue The value of the primary key.
 * @return bool True if records exist, false otherwise.
 */
if(!function_exists('recordExists')) {
    function recordExists(string $tableName, string $primaryKey, string $primaryKeyValue): bool
    {
        $db = \Config\Database::connect();
        $query = $db->table($tableName)->where($primaryKey, $primaryKeyValue)->get();
        return $query->getNumRows() > 0;
    }
}

/**
 * Checks if a record exists in the specified table based on a WHERE clause.
 *
 * @param {string} $tableName - The name of the table to search.
 * @param {string} $whereClause - The condition for checking (e.g., 'emp_id = 123').
 * @return {bool} Returns true if a matching record exists, otherwise false.
 */
if (!function_exists('checkRecordExists')) {
    function checkRecordExists(string $tableName, string $primaryKey, string $whereClause): bool
    {
        $db = \Config\Database::connect();

        // Build the query
        $query = $db->table($tableName)
            ->select($primaryKey) // Assuming 'emp_id' is the primary key or unique identifier
            ->where($whereClause)
            ->get();

        // Check if any rows match the condition
        return $query->getNumRows() > 0;
    }
}

/**
 * Delete a record if it exists.
 *
 * @param string $tableName      The name of the table.
 * @param string $primaryKey     The primary key column name.
 * @param mixed  $primaryKeyValue The value of the primary key.
 * @return bool True if deletion was successful, false otherwise.
 */
if(!function_exists('deleteRecord')) {
    function deleteRecord(string $tableName, string $primaryKey, $primaryKeyValue): bool
    {
        $db = \Config\Database::connect();

        $db->transStart();

        $builder = $db->table($tableName);
        $builder->where($primaryKey, $primaryKeyValue);
        $result = $builder->delete();

        $db->transComplete();

        return $db->transStatus() && $db->affectedRows() > 0;
    }
}

/**
 * Soft deletes a record in the database by updating the 'deleted' column to 0.
 *
 * @param {string} tableName - The name of the table where the record exists.
 * @param {string} primaryKey - The name of the primary key column.
 * @param {*} primaryKeyValue - The value of the primary key for the record to be deleted.
 * @returns {boolean} - True if the record was successfully soft deleted, false otherwise.
 */
if (!function_exists('softDeleteRecord')) {
    function softDeleteRecord(string $tableName, string $primaryKey, $primaryKeyValue): bool
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart(); // Start transaction

            // Define the data to be updated
            $data = ['deleted' => 1];

            // Build the query
            $db->table($tableName)
                ->where($primaryKey, $primaryKeyValue)
                ->update($data);

            $db->transComplete(); // Complete transaction

            // Check if the update was successful
            return $db->affectedRows() > 0;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

/**
 * Get all records with an optional WHERE clause.
 *
 * @param string $tableName   The name of the table.
 * @param string $whereClause Optional WHERE clause (e.g., "status = 'active'").
 * @return array An array of records.
 */
if(!function_exists('getAllRecords')) {
    function getAllRecords(string $tableName, string $whereClause = ''): array
    {
        $db = \Config\Database::connect();
        if (!empty($whereClause)) {
            $db->where($whereClause);
        }
        $query = $db->table($tableName)->get();
        return $query->getResultArray();
    }
}

/**
 * Get a single record with a WHERE clause.
 *
 * @param string $tableName   The name of the table.
 * @param string $whereClause The WHERE clause (e.g., "user_id = 123").
 * @return array|null The record or null if not found.
 */
if(!function_exists('getSingleRecord')) {
    function getSingleRecord(string $tableName, string $whereClause): ?array
    {
        $db = \Config\Database::connect();
        $query = $db->table($tableName)->where($whereClause)->get();
        $result = $query->getRowArray();
        return $result ?: null;
    }
}

/**
 * Add a data record.
 *
 * @param string $tableName The name of the table.
 * @param array  $data      Associative array of data to insert.
 * @return bool True if insertion was successful, false otherwise.
 */
if (!function_exists('addRecord')) {
    function addRecord(string $tableName, array $data): bool
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart(); // Start transaction

            $result = $db->table($tableName)->insert($data);

            $db->transComplete(); // Complete transaction

            return $result;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

/**
 * Update a data record. updateTableData
 *
 * @param string $tableName   The name of the table.
 * @param array  $data        Associative array of data to update.
 * @param string $whereClause The WHERE clause (e.g., "user_id = 123").
 * @return bool True if update was successful, false otherwise.
 */
if (!function_exists('updateRecord')) {
    function updateRecord(string $tableName, array $data, string $whereClause): bool
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart(); // Start transaction

            $result = $db->table($tableName)
                ->where($whereClause)
                ->update($data);

            $db->transComplete(); // Complete transaction

            return $result;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

/**
 * Updates a specific column in a database table based on the provided parameters.
 *
 * @param string $tableName The name of the table to update.
 * @param string $data The column data to be updated in "column = value" format.
 * @param string $whereClause The WHERE condition to specify which record(s) to update.
 * @return bool Returns true if the update was successful, false otherwise.
 */
if (!function_exists('updateRecordColumn')) {
    function updateRecordColumn(string $tableName, string $data, string $whereClause): bool
    {
        $db = \Config\Database::connect();

        try {
            $db->transStart(); // Start transaction

            // Split the data string into column and value
            list($column, $value) = explode('=', $data);

            // Trim whitespace and remove any surrounding quotes
            $column = trim($column, " '\"");
            $value = trim($value, " '\"");

            // Prepare the data array
            $updateData = [
                $column => $value
            ];

            // Perform the update
            $result = $db->table($tableName)
                ->where($whereClause)
                ->update($updateData);

            $db->transComplete(); // Complete transaction

            return $result;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

/**
 * Get the total count of records with an optional WHERE clause.
 *
 * @param string $tableName The name of the table.
 * @param string|null $whereClause Optional WHERE clause (e.g., "status = 'active'")
 * @return int The total count of records.
 */
if (!function_exists('getTotalRecords')) {
    function getTotalRecords(string $tableName, ?string $whereClause = null): int {
        $db = \Config\Database::connect();
        $builder = $db->table($tableName);

        // Apply WHERE clause if provided
        if ($whereClause !== null) {
            $builder->where($whereClause);
        }

        return $builder->countAllResults();
    }
}

/**
 * Get paginated records from a table.
 *
 * @param string $tableName The name of the table.
 * @param int    $take      Number of records to retrieve.
 * @param int    $skip      Number of records to skip.
 * @param string $where     Optional WHERE clause.
 * @return array An array of paginated records.
 */
if(!function_exists('getPaginatedRecords')) {
    function getPaginatedRecords(string $tableName, int $take, int $skip, string $whereClause = ''): array
    {
        $db = \Config\Database::connect();
        if (!empty($where)) {
            $db->where($where);
        }

        $query = $db->table($tableName)->limit($take, $skip)->get();
        return $query->getResultArray();
    }
}

/**
 * Retrieves data from a specified database table based on given conditions.
 *
 * @param string $tableName      The name of the database table.
 * @param array  $whereClause    An associative array of conditions for the WHERE clause (e.g. ['id' => 5]).
 * @param string $returnColumn   The specific column to return, or '*' to return the entire row object.
 *
 * @return mixed|null            Returns the value of the specified column, the full row object if '*' is passed,
 *                               or null if no matching record is found.
 * @example
 * $title = getTableData('posts', ['id' => 1], 'title');
 * $configValue = getTableData('configs', ['slug' => 'sample-slug', 'key' => 'config_key'], 'config_value');
 * $post = getTableData('posts', ['id' => 1], '*'); // Returns full row object
 */
if (!function_exists('getTableData')) {
    function getTableData($tableName, $whereClause, $returnColumn)
    {
        $db = \Config\Database::connect();
        $query = $db->table($tableName)->where($whereClause)->get();
        
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            // If requesting all columns, return the entire row object
            if ($returnColumn === '*') {
                return $row;
            }
            // Otherwise return the specific column
            return $row->$returnColumn;
        }
        return null;
    }
}

/**
 * Retrieves data from a specified database table based on a 'LIKE' condition.
 *
 * This function is useful for implementing search functionalities where you need to
 * find records that contain a specific keyword within a column, rather than an
 * exact match.
 *
 * @param string $tableName     The name of the database table.
 * @param string $searchColumn  The name of the column to search within (e.g., 'title', 'content').
 * @param string $searchQuery   The keyword or phrase to search for.
 * @param string $returnColumn  The specific column to return, or '*' to return the entire row object.
 *
 * @return mixed|null Returns the value of the specified column, the full row object if '*' is passed,
 * or null if no matching record is found.
 */
// Example 1: Search for a blog post with 'cloud' in the title and get the post's slug
// Assume a table named 'blogs' with columns 'title' and 'slug'
// $blogSlug = searchTableData('blogs', 'title', 'cloud', 'slug');
// Example 2: Search for a page with 'solutions' in the content and get the full row object
// This is useful if you need multiple pieces of data from the result
// Assume a table named 'pages' with a 'content' column
// $pageResult = searchTableData('pages', 'content', 'solutions', '*');
if (!function_exists('searchTableData')) {
    function searchTableData($tableName, $searchColumn, $searchQuery, $returnColumn = '*')
    {
        // Get the database connection
        $db = \Config\Database::connect();
        
        // Build the query using the 'like' method for the LIKE clause
        // The first parameter is the column to search, the second is the search query
        $query = $db->table($tableName)->like($searchColumn, $searchQuery)->get();
        
        // Check if any results were returned
        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            
            // If the user requested all columns, return the entire row object
            if ($returnColumn === '*') {
                return $row;
            }
            
            // Otherwise, return the value of the specific column requested
            // We use a try-catch block to handle cases where the column might not exist
            try {
                return $row->$returnColumn;
            } catch (Exception $e) {
                // If the column doesn't exist, return null
                return null;
            }
        }
        
        // If no matching records were found, return null
        return null;
    }
}

/**
 * Execute a custom SQL query.
 *
 * @param string $sql The SQL query.
 * @return mixed Result of the query (e.g., array, boolean, etc.).
 */
if(!function_exists('executeCustomQuery')) {
    function executeCustomQuery(string $sql)
    {
        $db = \Config\Database::connect();
        $query = $db->query($sql);
        return $query->getResult();
    }
}

/**
 * Truncates a table, permanently removing all data. Use with caution!
 *
 * @param string $tableName  The name of the database table to truncate.
 * @return bool  True if truncation was successful, false otherwise.
 */
if(!function_exists('truncateTable')) {
    function truncateTable(string $tableName): bool
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tableName);
        $result = $builder->truncate();

        return $result;
    }
}

/**
 * Retrieves the size of an existing file.
 *
 * @param {string} $file - The path to the file.
 * @param {string} [$type="MB"] - Measurement type ("KB" or "MB").
 * @return {float|string} The file size in the specified measurement type or an error message.
 */

if (!function_exists('getFileSize')) {
    function getFileSize($file, $type = "MB") {
        // Check if the file exists
        if (!is_file($file)) {
            return "File not found.";
        }

        // Get the file size in bytes
        $size = filesize($file);

        // Convert to the specified measurement type
        switch (strtoupper($type)) {
            case "KB":
                $sizeFormatted = round($size / 1024, 2); // Kilobytes
                break;
            case "MB":
                $sizeFormatted = round($size / (1024 * 1024), 2); // Megabytes
                break;
            default:
                return 0.0;
        }

        return $sizeFormatted;
    }
}

/**
 * Gets the file extension from a given filename.
 *
 * @param string $filename The filename to extract the extension from.
 * @return string The file extension, or an empty string if no extension is found.
 */
if (!function_exists('getFileExtension')) {
    function getFileExtension($filename) {
        // Explode the filename by the dot character.
        $parts = explode('.', $filename);
    
        // If there is at least one part after the dot, return the last part as the extension.
        if (count($parts) > 1) {
            return end($parts);
        }
    
        // If no extension is found, return an empty string.
        return '';
    }
}

/**
 * Converts a file size in bytes to KB, MB, or GB.
 *
 * @param int $sizeInBytes The file size in bytes.
 * @param string $convertTo The desired unit for the converted file size (KB, MB, or GB).
 * @return string The formatted file size with the unit.
 */
if (!function_exists('convertFileSize')) {
    function convertFileSize($sizeInBytes, $convertTo) {
        $units = array('B' => 0, 'KB' => 1024, 'MB' => 1048576, 'GB' => 1073741824);
    
        if (!isset($units[$convertTo])) {
            return 'Invalid conversion unit.';
        }
    
        $convertedSize = $sizeInBytes / $units[$convertTo];
        $formattedSize = number_format($convertedSize, 2);
    
        return $formattedSize . ' ' . $convertTo;
    }
}

/**
 * Converts a file size in bytes to KB, MB, or GB based on the size.
 *
 * @param int $sizeInBytes The file size in bytes.
 * @return string The formatted file size with the unit.
 */
if (!function_exists('displayFileSize')) {
    function displayFileSize($sizeInBytes) {
        $units = array('B', 'KB', 'MB', 'GB');
        $factor = 1024;
    
        for ($i = 0; $i < count($units); $i++) {
            if ($sizeInBytes < $factor) {
                break;
            }
            $sizeInBytes /= $factor;
        }
    
        $formattedSize = number_format($sizeInBytes, 2);
        return $formattedSize . ' ' . $units[$i];
    }
}

/**
 * Checks if the provided file extension is a valid image.
 *
 * @param {object} $file - The uploaded file (CodeIgniter\HTTP\Files\UploadedFile object).
 * @return {boolean} True if the file is a valid image; otherwise, false.
 */
if (!function_exists('isValidImage')) {
    function isValidImage($extension) {
        // Check if file is not empty
        if (empty($extension)) {
            return false;
        }

        // Validate image file types
        $allowedImageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'svg'];

        // Check if the extension is in the allowed list
        return in_array(strtolower($extension), $allowedImageExtensions);
    }
}

/**
 * Checks if the provided file is a valid document.
 *
 * @param {object} $file - The uploaded file (CodeIgniter\HTTP\Files\UploadedFile object).
 * @return {boolean} True if the file is a valid document; otherwise, false.
 */
if (!function_exists('isValidIDocFile')) {
    function isValidIDocFile($file) {
        // Check if file is not empty
        if (empty($file)) {
            return false;
        }

        // Validate document file types
        $allowedDocExtensions = ['pdf', 'doc', 'docx', 'xls'];
        $fileExtension = strtolower(pathinfo($file->getName(), PATHINFO_EXTENSION));
        return in_array($fileExtension, $allowedDocExtensions);
    }
}

/**
 * Checks if the file extension matches the specified extension.
 *
 * @param {object} $file - The uploaded file (CodeIgniter\HTTP\Files\UploadedFile object).
 * @param {string} $ext - The desired file extension (e.g., 'pdf', 'doc').
 * @return {boolean} True if the file extension matches; otherwise, false.
 */
if (!function_exists('hasValidFileExt')) {
    function hasValidFileExt($file, $ext) {
        // Check if file is not empty
        if (empty($file)) {
            return false;
        }

        // Validate against the provided extension
        $fileExtension = strtolower(pathinfo($file->getName(), PATHINFO_EXTENSION));
        return ($fileExtension === strtolower($ext));
    }
}

/**
 * Validates and uploads a file to the specified path.
 *
 * @param {object} $file - The uploaded file (CodeIgniter\HTTP\Files\UploadedFile object).
 * @param {string} $path - The path for saving the file.
 * @param {string} [$defaultResponse=""] - Default response if file or path is null/empty.
 * @return {string} The uploaded file path or the default response.
 */
if (!function_exists('uploadFile')) {
    function uploadFile($file, $path, $defaultResponse = "") {
        // Check if file and path are not empty
        if (empty($file) || empty($path)) {
            return $defaultResponse;
        }

        // Validate file types
        $allowedExtensions = getAllowedFileExtensions();

        $fileExtension = strtolower(pathinfo($file->getName(), PATHINFO_EXTENSION)); // Use getName() method
        if (!in_array($fileExtension, $allowedExtensions)) {
            return "Invalid file type (".$fileExtension.")";
        }

        // Generate a unique filename
        $newName = $file->getRandomName();

        // Move the uploaded file to the specified path
        if ($file->move(ROOTPATH .  $path."/", $newName)) {
            $updatedFileName = $path."/".$newName;
            return $updatedFileName;
        } else {
            echo "Error uploading file.";
            return $defaultResponse;
        }
    }
}

/**
 * Checks if a file extension is allowed.
 *
 * @param {File} file - The file to check.
 * @returns {boolean} True if the file extension is allowed, false otherwise.
 */
if (!function_exists('isAllowedFileExtension')) {
    function isAllowedFileExtension($file) {
        // Validate file types
        $allowedExtensions = getAllowedFileExtensions();

        $fileExtension = strtolower(pathinfo($file->getName(), PATHINFO_EXTENSION)); // Use getName() method
        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }
        else{
            return true;
        }
    }
}

/**
 * Gets a list of allowed file extensions.
 *
 * @returns {string[]} An array of allowed file extensions.
 */
if (!function_exists('getAllowedFileExtensions')) {
    function getAllowedFileExtensions() {
        // Validate file types
        $allowedExtensions = [
            // Images
            'png', 'jpg', 'jpeg', 'gif', 'webp', 'bmp', 'tiff',

            // Documents
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf', 'odt', 'ods', 'odp',

            // Videos
            'mp4', 'mov', 'avi', 'mkv', 'webm', 'flv', 'wmv', 'mpeg', 'mpg',

            // Audio
            'mp3', 'wav', 'ogg', 'flac', 'aac',

            // Archives
            'zip', 'rar', 'tar', 'gz', '7z',

            // Other
            'csv', 'json', 'xml', 'html', 'css'
        ];

        return $allowedExtensions;
    }
}


/**
 * Get the appropriate file input icon based on the file extension.
 *
 * @param {string} $fileExtension - The file extension to check.
 * @return {string} HTML - The HTML string for the corresponding Bootstrap icon.
 *
 * @example
 * // returns '<i class="ri-image-line"></i>'
 * getFileInputIcon('png');
 *
 * @example
 * // returns '<i class="ri-file-pdf-2-line"></i>'
 * getFileInputIcon('pdf');
 *
 * @example
 * // returns '<i class="ri-file-line"></i>'
 * getFileInputIcon('unknown');
 */
if (!function_exists('getFileInputIcon')) {
    function getFileInputIcon($fileExtension) {
        // Normalize the file extension to lower case
        $fileExtension = strtolower(trim($fileExtension));

        switch ($fileExtension) {
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'webp':
            case 'bmp':
            case 'tiff':
                return '<i class="ri-image-line"></i>';

            case 'pdf':
                return '<i class="ri-file-pdf-2-line"></i>';

            case 'doc':
            case 'docx':
                return '<i class="ri-file-word-2-line"></i>';

            case 'xls':
            case 'xlsx':
            case 'csv':
                return '<i class="ri-file-excel-2-line"></i>';

            case 'ppt':
            case 'pptx':
                return '<i class="ri-file-ppt-line"></i>';

            case 'txt':
            case 'rtf':
            case 'odt':
            case 'ods':
            case 'odp':
                return '<i class="ri-file-text-line"></i>';

            case 'mp4':
            case 'mov':
            case 'avi':
            case 'mkv':
            case 'webm':
            case 'flv':
            case 'wmv':
            case 'mpeg':
            case 'mpg':
                return '<i class="ri-movie-fill"></i>';

            case 'mp3':
            case 'wav':
            case 'ogg':
            case 'flac':
            case 'aac':
                return '<i class="ri-music-2-fill"></i>';

            case 'zip':
            case 'rar':
            case 'tar':
            case 'gz':
            case '7z':
                return '<i class="ri-folder-zip-line"></i>';

            case 'html':
                return '<i class="ri-html5-fill"></i>';

            case 'json':
                return '<i class="bi bi-filetype-json"></i>';

            case 'css':
                return '<i class="ri-css3-fill"></i>';

            default:
                return '<i class="ri-file-line"></i>';
        }
    }
}

if (!function_exists('getFileInputPreview')) {
    function getFileInputPreview($fileLink, $fileExtension, $width = 160) {
        // Normalize the file extension to lower case
        $fileExtension = strtolower(trim($fileExtension));

        switch ($fileExtension) {
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'webp':
            case 'bmp':
            case 'tiff':
                return '<img loading="lazy" src="'.getImageUrl($fileLink ?? getDefaultImagePath()).'" class="img-thumbnail" alt="Image file" width="'.$width.'">';

            case 'pdf':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-pdf-2-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'doc':
            case 'docx':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-word-2-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'xls':
            case 'xlsx':
            case 'csv':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-excel-2-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'ppt':
            case 'pptx':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-ppt-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'txt':
            case 'rtf':
            case 'odt':
            case 'ods':
            case 'odp':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-text-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'mp4':
            case 'mov':
            case 'avi':
            case 'mkv':
            case 'webm':
            case 'flv':
            case 'wmv':
            case 'mpeg':
            case 'mpg':
                return getVideoPreviewFromUrl($fileLink, $width);

            case 'mp3':
            case 'wav':
            case 'ogg':
            case 'flac':
            case 'aac':
                return getAudioPreviewFromUrl($fileLink);

            case 'zip':
            case 'rar':
            case 'tar':
            case 'gz':
            case '7z':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-folder-zip-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'html':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-html5-fill" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'json':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="bi bi-filetype-json" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            case 'css':
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-css3-fill" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );

            default:
                return sprintf(
                    '<div class="file-preview" style="width:%dpx; display:flex; justify-content:center; align-items:center;">' .
                    '<i class="ri-file-line" style="font-size:%dpx;"></i>' .
                    '</div>',
                    $width,
                    $width * 0.6 // Icon size is 60% of the width for proportional scaling
                );
        }
    }
}

/**
 * Fetches and displays data group options in a dropdown.
 *
 * @param int|null $data groupId The ID of the data group to be selected (optional).
 * @return void
 */
if (!function_exists('getDataGroupOptions')) {
    function getDataGroupOptions($selectedDataGroup = null, $dataGroupFor = null)
    {
        $optionsList = "";
        $whereClause = ['data_group_for' => $dataGroupFor];
        $dataGrouList = getTableData('data_groups', $whereClause, 'data_group_list');
        $dataGroupArray = preg_split("/,/", $dataGrouList);

        foreach ($dataGroupArray as $dataGroup) {
            $dataGroup = trim($dataGroup); // Clean up extra spaces
            $selected = (strcasecmp($dataGroup, $selectedDataGroup) === 0) ? "selected" : "";
            $optionsList .= "<option value='$dataGroup' $selected>$dataGroup</option>";
        }

        echo $optionsList;
    }
}


/**
 * Gets the countries as select options.
 * Uses "iso" for value and "nicename" for name.
 * If $countryIso value is passed, then sets it as the selected option.
 * Lists only <option></option> tags.
 *
 * @param string|null $countryIso The ISO code of the country to be selected (optional).
 * @return string HTML string of <option> tags.
 */
if (!function_exists('getCountrySelectOptions')) {

    function getCountrySelectOptions($countryIso = null)
    {
        $db = \Config\Database::connect();
        $countries = $db->table('countries')->get()->getResultArray();

        $options = '';
        foreach ($countries as $country) {
            $selected = ($countryIso !== null && $country['iso'] == $countryIso) ? 'selected' : '';
            $options .= '<option value="' . $country['iso'] . '" ' . $selected . '>' . implode(' ', preg_split('/(?=[A-Z])/', $country['nicename'])) . '</option>';
        }

        return $options;
    }
}

/**
 * Retrieves the text name of a country based on its ISO code.
 *
 * @param {string} countryIso - The ISO code of the country.
 * @returns {string} The text name of the country, or "NA" if not found.
 */
//Get country text name
if(!function_exists('getCountryTextName')){
    function getCountryTextName($countryIso){

        if($countryIso != ""){
            $db = \Config\Database::connect();
            //query countries
            $query = $db->table('countries')
                ->select('nicename')
                ->where('iso', $countryIso)
                ->get();

            if ($query->getResult() > 0) {

                try {
                    $row = $query->getRow();
                    $nicename = $row->nicename;
                    return $nicename;
                }
                    //catch exception
                catch(Exception $e) {
                    return "NA";
                }
            }
        }

        return "";
    }
}

/**
 * Logs an activity in the system.
 *
 * @param {string|int} $activityBy - The identifier of the user performing the activity (user ID or email).
 * @param {string} $activityType - The type of activity being performed.
 * @param {string} $activityDetails - Additional details about the activity (optional).
 * @return {bool} Returns true if the activity was successfully logged, false otherwise.
 */
if (!function_exists('logActivity')) {
    function logActivity($activityBy, $activityType, $activityDetails = '')
    {
        $activityLogsModel = new ActivityLogsModel();

        try {
            $db = \Config\Database::connect();
            $db->transStart(); // Start transaction

            $data = [
                'activity_id' => uniqid(), // Generate a unique ID
                'activity_by' => $activityBy,
                'activity_type' => $activityType,
                'activity' => ActivityTypes::getDescription($activityType) . ($activityDetails ? ': ' . $activityDetails : ''),
                'ip_address' => getIPAddress(),
                'country' => getCountry(getIPAddress()),
                'device' => getUserDevice(),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $result = $activityLogsModel->insert($data);

            $db->transComplete(); // Complete transaction

            return $result;
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
            return false;
        }
    }
}

/**
 * Retrieves the full name of the user who performed an activity.
 *
 * @param {string|int} $activityBy - The identifier of the user (user ID or email).
 * @return {string} The full name of the user or "Unknown" if the user cannot be found.
 */
if(!function_exists('getActivityBy'))
{
    function getActivityBy($activityBy, $default = "")
    {
        if (!empty($activityBy)) {
            $primaryKey = 'user_id';
            //check if using email instead
            if(filter_var($activityBy, FILTER_VALIDATE_EMAIL)) {
                // valid address
                $primaryKey = 'email';
            }

            if (recordExists('users',  $primaryKey, $activityBy)) {
                $whereClause = [$primaryKey => $activityBy];
                $firstName = getTableData('users', $whereClause, 'first_name');
                $lastName = getTableData('users', $whereClause, 'last_name');
                return $firstName.' '.$lastName;
            }
        }
        return $default;
    }
}


/**
 * Generates a URL-friendly slug from a given string.
 *
 * Converts the input to lowercase, removes special characters,
 * replaces spaces with dashes, collapses multiple dashes,
 * and trims leading/trailing dashes.
 *
 * @param {string} title - The input string to convert into a slug.
 * @returns {string} The sanitized, URL-friendly slug.
 *
 * @example
 * generateSlug("Dell - Inspiron - 15.6'' - Laptop!");
 * // Returns: "dell-inspiron-156-laptop"
 */
if (!function_exists('generateSlug')) {
    function generateSlug(string $title): string
    {
        // Convert to lowercase
        $slug = strtolower($title);

        // Remove all characters except letters, numbers, spaces, and dashes
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

        // Replace spaces with dashes
        $slug = preg_replace('/\s+/', '-', $slug);

        // Replace multiple dashes with a single dash
        $slug = preg_replace('/-+/', '-', $slug);

        // Trim leading and trailing dashes
        $slug = trim($slug, '-');

        return $slug;
    }
}


/**
 * Generates a unique slug for a given navigation title.
 *
 * @param {string} title - The navigation title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateNavigationSlug')) {

    function generateNavigationSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = generateSlug($title);

        // Check if the slug exists in the 'categories' table
        $builder = $db->table('categories');
        $existingSlug = $builder->where('slug', $slug)->get()->getRow();

        // If the slug exists, add a random 6-digit alphanumeric string
        if ($existingSlug) {
            $randomString = substr(md5(uniqid(rand(), true)), 0, 6);
            $slug .= '-' . $randomString;
        }

        return $slug;
    }
}

/**
 * Outputs HTML <option> elements for content blocks.
 *
 * @param string|null $current_content_blocks A comma-separated string of current content block IDs.
 * @return void
 */
if (!function_exists('getContentBlockOptions')) {
    function getContentBlockOptions($current_content_blocks = null) {
        // Connect to the database
        $db = \Config\Database::connect();
        
        // Query the content_blocks table
        $query = $db->table('content_blocks')->get();
        
        // Convert the current content blocks to an array
        $current_blocks_array = $current_content_blocks ? explode(',', $current_content_blocks) : [];
        
        // Iterate through the query results
        foreach ($query->getResult() as $row) {
            $selected = in_array($row->content_id, $current_blocks_array) ? "selected" : "";
            
            // Output the <option> element
            echo "<option value='$row->content_id' $selected>$row->title ($row->identifier)</option>";
        }
    }
}

/**
 * Renders content blocks in a row div format for the homepage
 * 
 * @param string $content_blocks Comma-separated string of content block IDs
 * @return void Outputs HTML directly
 */
if (!function_exists('renderContentBlocks')) {
    function renderContentBlocks($content_blocks) {
        // Check if content_blocks is empty or null
        if (empty($content_blocks)) {
            return;
        }

        // Connect to the database
        $db = \Config\Database::connect();
        
        // Convert comma-separated IDs to array and sanitize
        $block_ids = array_map('trim', explode(',', $content_blocks));
        if (empty($block_ids)) {
            return;
        }

        // Query content_blocks table for matching IDs, ordered by 'order' field
        $query = $db->table('content_blocks')
                    ->whereIn('content_id', $block_ids)
                    ->orderBy('order', 'ASC')
                    ->get();
        
        $blocks = $query->getResultArray();
        
        // If no blocks found, return early
        if (empty($blocks)) {
            return;
        }
        
        // Determine column class based on max content length for uniformity
        $column_class = 'col-lg-4';
        foreach ($blocks as $block) {
            $content_length = strlen(strip_tags($block['content'] ?? ''));
            if ($content_length > 1000) {
                $column_class = 'col-lg-12';
                break;
            } elseif ($content_length > 500 && $content_length <= 1000) {
                $column_class = 'col-lg-6';
            }
        }
        
        ?>
        <div class="row gx-5 justify-content-center">
            <?php foreach ($blocks as $block): ?>
                <div class="<?php echo $column_class; ?> mb-5">
                    <div class="card h-100 shadow border-0">
                        <?php if (!empty($block['image'])): ?>
                            <img src="<?php echo esc($block['image']); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo esc($block['title'] ?? 'Content Block Image'); ?>">
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <?php if (!empty($block['icon'])): ?>
                                <div class="mb-3 text-center">
                                    <i class="<?php echo esc($block['icon']); ?> text-primary" style="font-size: 2rem;"></i>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($block['title'])): ?>
                                <h5 class="card-title mb-3"><?php echo esc($block['title']); ?></h5>
                            <?php endif; ?>
                            
                            <?php if (!empty($block['description'])): ?>
                                <p class="card-text mb-0"><?php echo esc($block['description']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($block['content'])): ?>
                                <div class="mt-3">
                                    <?php 
                                    // Check if content is HTML by looking for tags
                                    if (strip_tags($block['content']) !== $block['content']) {
                                        echo $block['content']; // Output HTML content directly
                                    } else {
                                        echo esc($block['content']); // Escape plain text
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($block['link'])): ?>
                                <a href="<?php echo esc($block['link']); ?>" 
                                   class="btn btn-primary mt-3"
                                   <?php echo $block['new_tab'] ? 'target="_blank"' : ''; ?>>
                                    Learn More
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}


/**
 * Fetches and displays navigation options in a dropdown.
 *
 * @param int|null $navigationId The ID of the navigation to be selected (optional).
 * @return void
 */
if(!function_exists('getNavigationParentSelectOptions'))
{
    function getNavigationParentSelectOptions($navigationId = null)
    {
        $tableName = "navigations";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('title', 'DESC')
                     ->get();

        $selected = "";
        foreach ($query->getResult() as $row) {
            $selected = $row->navigation_id == $navigationId ? "selected" : "";
            echo "<option value='$row->navigation_id' $selected>$row->title</option>";
        }
    }
}

/**
 * Fetches and displays blog category options in a dropdown.
 *
 * @param int|null $categoryId The ID of the category to be selected (optional).
 * @return void
 */
if(!function_exists('getBlogCategorySelectOptions'))
{
    function getBlogCategorySelectOptions($categoryId = null)
    {
        $tableName = "categories";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('title', 'DESC')
                     ->get();

        $selected = "";
        foreach ($query->getResult() as $row) {
            $selected = $row->category_id == $categoryId ? "selected" : "";
            echo "<option value='$row->category_id' $selected>$row->title</option>";
        }
    }
}


/**
 * Fetches and displays blog category options in a dropdown.
 *
 * @param int|null $categoryId The ID of the category to be selected (optional).
 * @return void
 */
if (!function_exists('getPluginSelectOptions')) {
    function getPluginSelectOptions()
    {
        $tableName = "plugins";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                    ->orderBy('plugin_key', 'DESC')
                    ->get();

        $options = "";
        foreach ($query->getResult() as $row) {
            $options .= "<option value='{$row->plugin_key}'>{$row->plugin_key}</option>";
        }
        return $options;
    }
}

/**
 * Fetches and list plugins in csv
 *
 * @param int|null $categoryId The ID of the category to be selected (optional).
 * @return void
 */
if(!function_exists('getPluginsList'))
{
    function getPluginsList()
    {
        $tableName = "plugins";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('plugin_key', 'ASC')
                     ->get();

        $selectedList = "";
        foreach ($query->getResult() as $row) {
            $selectedList = $selectedList.",".$row->plugin_key;
        }

        $selectedList = ltrim($selectedList, ',');

        return $selectedList;
    }
}

/**
 * Generates a unique slug for a given blog title.
 *
 * @param {string} title - The blog title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateBlogTitleSlug')) {

    function generateBlogTitleSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = generateSlug($title);

        // Check if the slug exists in the 'categories' table
        $builder = $db->table('blogs');
        $existingSlug = $builder->where('slug', $slug)->get()->getRow();

        // If the slug exists, add a random 6-digit alphanumeric string
        if ($existingSlug) {
            $randomString = substr(md5(uniqid(rand(), true)), 0, 6);
            $slug .= '-' . $randomString;
        }

        return $slug;
    }
}



/**
 * Generates a unique slug for a given page title.
 *
 * @param {string} title - The page title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generatePageTitleSlug')) {

    function generatePageTitleSlug(string $title): string
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = generateSlug($title);

        // List of excluded slugs that should not be used directly
        $excludedSlugs = array("home", "blog", "blogs", "sitemap", "rss");

        // Check if the slug exists in the 'pages' table or is in the excluded list
        $builder = $db->table('pages');
        $existingSlug = $builder->where('slug', $slug)->get()->getRow();

        if ($existingSlug || in_array($slug, $excludedSlugs)) {
            // If the slug exists or is in the excluded list, add a random 6-digit alphanumeric string
            $randomString = substr(md5(uniqid(rand(), true)), 0, 6);
            $slug .= '-' . $randomString;
        }

        return $slug;
    }
}


/**
 * Renders a list of tags as HTML badges.
 *
 * This function takes a string representing a list of tags, which can be either
 * a JSON string or a CSV string. It converts each tag into an HTML badge element.
 * The badges are styled using the provided badge style class. If the list is empty
 * or invalid, a 'No tags' message is returned.
 *
 * @param string $tagsList The string representing the list of tags, in JSON or CSV format.
 * @param string $badgeStyle The CSS class to style the badges. Default is 'bg-dark'.
 * @return string The HTML string containing the badges or a 'No tags' message.
 */
if (!function_exists('renderCsvListAsBadges')) {
    function renderCsvListAsBadges(string $tagsList, string $badgeStyle = 'bg-dark'): string
    {
        // Try to decode the input string as JSON
        $tags = json_decode($tagsList, true);
        
        // Check if the JSON decoding was successful and the result is an array
        if (is_array($tags)) {
            // Extract the 'value' from each element in the array
            $values = array_column($tags, 'value');
        } else {
            // If the input is not a valid JSON array, assume it's a CSV string
            $values = explode(',', $tagsList);
        }

        $html = '';

        // Check if the values array is not empty
        if (!empty($values)) {
            // Loop through each value and create a badge
            foreach ($values as $value) {
                $html .= '<span class="badge ' . esc($badgeStyle) . ' me-1">' . esc($value) . '</span>';
            }
        } else {
            // If no values are present, return 'No tags' message
            $html = 'No tags';
        }

        return $html;
    }
}


/**
 * Retrieves the name of a color given its hex code.
 *
 * @param {string|null} colorCode - The hex code of the color (e.g., "#000000").
 * @returns {string} The name of the color or "NA" if the color code is invalid or not found.
 */
if (!function_exists('getColorCodeName')) {
    function getColorCodeName($colorCode = null) {
        $colorName = "NA";

        if (empty($colorCode)) {
            return $colorName;
        }

        // Get color code name
        $colorCodeOnly = str_replace("#", "", $colorCode);
        $json = file_get_contents('https://api.color.pizza/v1/?values=' . $colorCodeOnly);
        $data = json_decode($json);

        if (isset($data->colors[0]->name)) {
            $colorName = $data->colors[0]->name;
        }

        return $colorName. " (".$colorCode.")";
    }
}

/**
 * Retrieves and displays a list of recent blog posts in a table format.
 *
 * @param int $limit The maximum number of posts to retrieve (default is 20).
 * @return void Outputs the HTML table directly with blog post information.
 */
if(!function_exists('getRecentPosts'))
{
    function getRecentPosts($limit = 20)
    {
        $rowCount = 1;

        // Connect to the database
        $db = \Config\Database::connect();
        
        // Query to get published blog posts
        $query = $db->table('blogs')
                   //->where('status', 1)
                   ->get();

        // HTML structure for the table header
        echo "<table class='table datatable table-bordered w-100'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Post Date</th>
                    </tr>
                </thead>
            <tbody>";

        // Loop through each post record and display as a table row
        foreach ($query->getResult() as $row) {
            $blogId = $row->blog_id;
            $title = $row->title;
            $featuredImage = $row->featured_image;
            $slug = $row->slug;
            $category = $row->category;
            $status = $row->status;
            $statusLabel = $status == "1" ? "Published" : "Draft";
            $statusClass = $status == "1" ? "success" : "danger";
            $createdBy = $row->created_by;
            $createdAt = $row->created_at;

            // Display individual post data
            echo "<tr>
                    <td>".$rowCount."</td>
                    <td><img loading='lazy' src='".getImageUrl($featuredImage ?? getDefaultImagePath())."' class='img-thumbnail' alt='".$title."' width='100' height='100'></td>
                    <td>".$title."</td>
                    <td>".getBlogCategoryName($category)."</td>
                    <td><span class='badge bg-".$statusClass." p-2'>".$statusLabel."</span></td>
                    <td>".getActivityBy(esc($createdBy))."</td>
                    <td>".dateFormat($createdAt, 'd-m-Y')."</td>
                </tr>";
            $rowCount++;
        }
        
        // Close the table structure
        echo "</tbody>
        </table>";
    }
}

/**
 * Displays the top browsers based on the browser_type column.
 *
 * This function queries the site_stats table to get the distinct browsers
 * and their session counts. The results are displayed in a table with the
 * specified header.
 *
 * @param int $limit The number of top results to display. Default is 10.
 * @return void
 */
if (!function_exists('getTopBrowsers')) {
    function getTopBrowsers($limit = 10)
    {

        // List of excluded page urls. Do not include if any of the url contains any in this list
        $excludedUrlSlugs = array("/sign-in", "/sign-up", "/sign-out", "/forgot-password");

        // Connect to the database
        $db = \Config\Database::connect();
        
        // Query to get distinct browsers and their session counts
        $query = $db->table('site_stats')
                    ->select('browser_type, COUNT(*) as sessions')
                    ->groupBy('browser_type')
                    ->orderBy('sessions', 'DESC')
                    ->limit($limit)
                    ->get();

        // HTML structure for the table header
        echo "<table class='table simple-datatable table-bordered w-100'>
                <thead>
                    <tr>
                        <th>Browser</th>
                        <th>Sessions</th>
                    </tr>
                </thead>
            <tbody>";

        // Loop through each stat record and display as a table row
        $rowCount = 1;
        foreach ($query->getResult() as $row) {
            $browser = strtolower($row->browser_type);
            $icon = "";
            switch ($browser) {
                case "microsoft edge":
                    $icon = "<i class='ri-edge-fill'></i>";
                    break;
                case "google chrome":
                    $icon = "<i class='ri-chrome-fill'></i>";
                    break;
                case "edge":
                    $icon = "<i class='ri-edge-new-fill'></i>";
                    break;
                case "safari":
                    $icon = "<i class='ri-safari-fill'></i>";
                    break;
                case "firefox":
                    $icon = "<i class='ri-firefox-fill'></i>";
                    break;
                case "opera":
                    $icon = "<i class='ri-opera-fill'></i>";
                    break;
                default:
                $icon = "<i class='ri-global-fill'></i>";
                    
            }

            echo "<tr>
                    <td>".$icon." ".$row->browser_type."</td>
                    <td>".$row->sessions."</td>
                </tr>";
            $rowCount++;
        }
        
        // Close the table structure
        echo "</tbody>
        </table>";
    }
}


/* * Displays the most visited pages based on the page_visited_id column.
 *
 * This function queries the site_stats table to get the most visited pages,
 * excluding any URLs that contain strings from the excludedUrlSlugs array.
 * The results are displayed in a table with the specified header, and the
 * links open in a new tab.
 *
 * @param int $limit The number of top results to display. Default is 10.
 * @return void
 */
if (!function_exists('getMostVisitedPages')) {
    function getMostVisitedPages($limit = 10)
    {
        // Connect to the database
        $db = \Config\Database::connect();

        // Query to get published pages
        $query = $db->table('pages')
                   ->where('status', 1)
                   ->orderBy('total_views', 'DESC')
                   ->limit($limit)
                   ->get(); // Use get() to execute the query and get the result object

        // HTML structure for the table header
        echo "<table class='table simple-datatable table-bordered w-100'>
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Views</th>
                    </tr>
                </thead>
            <tbody>";

        // Loop through each post record and display as a table row
        foreach ($query->getResult() as $row) {
            $pageId = $row->page_id;
            $title = $row->title;
            $slug = $row->slug;
            $status = $row->status;
            $statusLabel = $status == "1" ? "Published" : "Draft";
            $statusClass = $status == "1" ? "success" : "danger";
            $totalViews = $row->total_views;
            $createdBy = $row->created_by;
            $createdAt = $row->created_at;

            // Display individual post data
            echo "<tr>
                    <td><a href='".base_url($slug)."' target='_blank'>".$title."</a></td>
                    <td>".$totalViews."</td>
                </tr>";
        }
        
        // Close the table structure
        echo "</tbody>
        </table>";
    
    }
}


/**
 * Retrieves the name of a blog category based on its ID.
 *
 * @param string $categoryId The unique identifier (GUID) of the category.
 * @return string The category name if found, or an empty string if the ID is invalid or the category does not exist.
 */
if(!function_exists('getBlogCategoryName'))
{
    function getBlogCategoryName($categoryId) {
        // Check if the category ID is empty or not a valid GUID
        if (empty($categoryId) || !isValidGUID($categoryId)) {
            return "";
        }

        // Retrieve the category name from the 'categories' table
        $categoryName = getTableData('categories', ['category_id' => $categoryId], 'title');
        
        return $categoryName;
    }
}


/**
 * Gets the last 7 days including today as a comma-separated string.
 *
 * @return string Comma-separated list of the last 7 days in "M d" format, e.g., "'Nov 7', 'Nov 8', ..."
 */
if(!function_exists('getLastSevenDaysList'))
{
    function getLastSevenDaysList(): string
    {
        $lastSevenDaysList = [];
        
        // Loop to get the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $day = date('M j', strtotime("-$i days"));
            $lastSevenDaysList[] = "'$day'";
        }

        return implode(', ', $lastSevenDaysList);
    }
}

/**
 * Gets the visit counts for the last 7 days, including today.
 *
 * @return string Comma-separated list of visit counts for the last 7 days.
 */
if (!function_exists('getLastSevenDaysListCount')) {
    function getLastSevenDaysListCount(): string
    {
        $siteStatsModel = new SiteStatsModel();
        $counts = [];

        // Loop through the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            // Get the start and end of the day for each of the last 7 days
            $startOfDay = date('Y-m-d 00:00:00', strtotime("-$i days"));
            $endOfDay = date('Y-m-d 23:59:59', strtotime("-$i days"));

            // Query the database for visit counts
            $count = $siteStatsModel
                ->where('created_at >=', $startOfDay)
                ->where('created_at <=', $endOfDay)
                ->countAllResults();

            $counts[] = $count;
        }

        return implode(', ', $counts);
    }
}

/**
 * Gets the last N months as a comma-separated string.
 *
 * @param int $noOfMonths The number of months to retrieve (default is 6).
 * @return string Comma-separated list of the last N months in "F" format, e.g., "'June', 'July', ..."
 */
if(!function_exists('getLastMonthsList'))
{
    function getLastMonthsList(int $noOfMonths = 6): string
    {
        $lastMonthsList = [];
        
        // Loop to get the last N months
        for ($i = $noOfMonths - 1; $i >= 0; $i--) {
            $month = date('F', strtotime("-$i months"));
            $lastMonthsList[] = "'$month'";
        }

        return implode(', ', $lastMonthsList);
    }
}


/**
 * Gets the total visit counts for the last N months.
 *
 * @param int $noOfMonths The number of months to retrieve (default is 6).
 * @return string Comma-separated list of total visits for each month.
 */
if (!function_exists('getLastMonthsListCount')) {
    function getLastMonthsListCount(int $noOfMonths = 6): string
    {
        $siteStatsModel = new SiteStatsModel();
        $counts = [];

        // Loop through the last N months
        for ($i = $noOfMonths - 1; $i >= 0; $i--) {
            // Get the start and end dates of the month
            $startOfMonth = date('Y-m-01 00:00:00', strtotime("-$i months"));
            $endOfMonth = date('Y-m-t 23:59:59', strtotime("-$i months"));

            // Query the database to count the visits within the month
            $count = $siteStatsModel
                ->where('created_at >=', $startOfMonth)
                ->where('created_at <=', $endOfMonth)
                ->countAllResults();

            $counts[] = $count; // Add the count to the array
        }

        // Return the counts as a comma-separated string
        return implode(', ', $counts);
    }
}

/**
 * Finds the maximum value in a comma-separated list of numbers.
 *
 * @param string $list A comma-separated string of numbers.
 * @return int The maximum value in the list.
 */
function getMaximumFromList(string $list, $addToTotal = 0): int
{
    $max = 0;
    // Convert the comma-separated string into an array of numbers
    $numbers = explode(',', $list);

    // Use the built-in max() function to find the highest value
    $max = max($numbers) + $addToTotal;

    return $max;
}

/**
 * Returns the ID of the last blog post based on creation date.
 *
 * @param int $status The status of the blogs to retrieve (1 for active, 0 for inactive).
 * @return string|null The blog ID of the last post, or null if no post is found.
 */
if (!function_exists('getLastPostId')) {
    function getLastPostId($status = 1): ?string
    {
        $blogsModel = new BlogsModel();
        $lastPost = $blogsModel
            ->select('blog_id')
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->first(); // Get only the first (latest) result

        return $lastPost ? $lastPost['blog_id'] : null;
    }
}

/**
 * Get recent post IDs with optional pagination
 * 
 * @param int $status Blog status (default: 1 for active)
 * @param int $skip Number of posts to skip (for pagination)
 * @param int $take Number of posts to return
 * @return array Array of blog IDs
 */
if (!function_exists('getRecentPostIds')) {
    function getRecentPostIds($status = 1, $skip = 0, $take = 10)
    {
        $blogsModel = new BlogsModel();
        return $blogsModel->select('blog_id')
                         ->where('status', $status)
                         ->orderBy('created_at', 'DESC')
                         ->findAll($take, $skip);
    }
}

/**
 * Get trending post IDs based on views in last 48 hours
 * 
 * @param int $total Number of posts to return
 * @return array Array of blog IDs with highest views
 */
if (!function_exists('getRecentTrendingPostIds')) {
    function getRecentTrendingPostIds($skip = 0, $take = 6)
    {
        $blogsModel = new BlogsModel();
        $date = new \DateTime('48 hours ago');
        
        return $blogsModel->select('blog_id')
                         ->where('status', 1)
                         ->where('created_at >=', $date->format('Y-m-d H:i:s'))
                         ->orderBy('created_at', 'DESC')
                         ->orderBy('total_views', 'DESC')
                         ->findAll($take, $skip);
    }
}

/**
 * Get trending category IDs based on post views in last 48 hours
 * 
 * @param int $total Number of categories to return
 * @return array Array of category IDs with view counts
 */
if (!function_exists('getRecentTrendingPostCategoriesIds')) {
    function getRecentTrendingPostCategoriesIds($total = 5)
    {
        $blogsModel = new BlogsModel();
        $date = new \DateTime('48 hours ago');
        
        return $blogsModel->select('category as category_id, SUM(total_views) as total_views')
                         ->where('status', 1)
                         ->where('created_at >=', $date->format('Y-m-d H:i:s'))
                         ->groupBy('category')
                         ->orderBy('total_views', 'DESC')
                         ->findAll($total);
    }
}

/**
 * Get recent posts by category name
 * 
 * @param string $name Category name
 * @param int $total Number of posts to return
 * @return array Array of blog posts
 */
if (!function_exists('getRecentPostByCategoryName')) {
    function getRecentPostByCategoryName($name, $total = 2)
    {
        $categoriesModel = new CategoriesModel();
        $category = $categoriesModel->where('title', $name)
                                   ->where('status', 1)
                                   ->first();
        
        if (!$category) {
            return [];
        }
        
        $blogsModel = new BlogsModel();
        return $blogsModel->where('category', $category['category_id'])
                         ->where('status', 1)
                         ->orderBy('created_at', 'DESC')
                         ->findAll($total);
    }
}

/**
 * Get featured posts
 * 
 * @param int $total Number of posts to return
 * @return array Array of featured blog posts
 */
if (!function_exists('getFeaturedPosts')) {
    function getFeaturedPosts($total = 5)
    {
        $blogsModel = new BlogsModel();
        return $blogsModel->where('is_featured', 1)
                         ->where('status', 1)
                         ->orderBy('created_at', 'DESC')
                         ->findAll($total);
    }
}

/**
 * Get related posts by tags or category
 * 
 * @param string $blogId Current blog ID to exclude
 * @param string $categoryId Category ID for related posts
 * @param string $tags Comma-separated tags for related posts
 * @param int $total Number of posts to return
 * @return array Array of related blog posts
 */
if (!function_exists('getRelatedPosts')) {
    function getRelatedPosts($blogId, $categoryId, $tags = '', $total = 4)
    {
        $blogsModel = new BlogsModel();
        $builder = $blogsModel->where('blog_id !=', $blogId)
                             ->where('status', 1);
        
        if (!empty($tags)) {
            $tagsArray = explode(',', $tags);
            $builder->groupStart();
            foreach ($tagsArray as $tag) {
                $builder->orLike('tags', trim($tag));
            }
            $builder->groupEnd();
        }
        
        $builder->orWhere('category', $categoryId)
               ->orderBy('created_at', 'DESC')
               ->limit($total);
        
        return $builder->findAll();
    }
}

/**
 * Get most popular posts this week
 * 
 * @param int $total Number of posts to return
 * @return array Array of popular blog posts
 */
if (!function_exists('getPopularThisWeek')) {
    function getPopularThisWeek($total = 5)
    {
        $blogsModel = new BlogsModel();
        $date = new \DateTime('7 days ago');
        
        return $blogsModel->where('status', 1)
                         ->where('created_at >=', $date->format('Y-m-d H:i:s'))
                         ->orderBy('total_views', 'DESC')
                         ->findAll($total);
    }
}

/**
 * Get all active categories with their post counts
 * 
 * @return array Array of categories with post counts
 */
if (!function_exists('getCategoryWithPostCount')) {
    function getCategoryWithPostCount()
    {
        $categoriesModel = new CategoriesModel();
        $blogsModel = new BlogsModel();
        
        $categories = $categoriesModel->where('status', 1)->findAll();
        
        foreach ($categories as &$category) {
            $category['post_count'] = $blogsModel->where('category', $category['category_id'])
                                                ->where('status', 1)
                                                ->countAllResults();
        }
        
        return $categories;
    }
}

/**
 * Fetches the image URL for HTMX call.
 *
 * This function checks if the provided image URL contains "http:", "https:", or "www.".
 * If it does, the function returns the image URL as is.
 * Otherwise, it returns the base URL concatenated with the default image path.
 *
 * @param {string} $image - The image URL to check.
 * @return {string} - The original image URL if it contains "http:", "https:", or "www.", otherwise the base URL with the default image path.
 */
if(!function_exists('getImageUrl')){
    function getImageUrl($image) {
        // Check if $image contains "http:", "https:", or "www."
        if (strpos($image, 'http:') !== false || strpos($image, 'https:') !== false || strpos($image, 'www.') !== false) {
            return $image;
        } else {
            return base_url($image);
        }
    }
}

/**
 * Fetches the file URL for HTMX call.
 *
 * This function checks if the provided file URL contains "http:", "https:", or "www.".
 * If it does, the function returns the file URL as is.
 * Otherwise, it returns the base URL concatenated with the default file path.
 *
 * @param {string} $file - The file URL to check.
 * @return {string} - The original file URL if it contains "http:", "https:", or "www.", otherwise the base URL with the default file path/url.
 */
if(!function_exists('getLinkUrl')){
    function getLinkUrl($file) {
        // Check if $file contains "http:", "https:", or "www."
        if (strpos($file, 'http:') !== false || strpos($file, 'https:') !== false || strpos($file, 'www.') !== false) {
            return $file;
        } else {
            return base_url($file);
        }
    }
}

/**
 * Retrieves the currently selected theme path.
 * 
 * @returns {string} The path of the current theme, defaults to "default" if not set.
 */
if (!function_exists('getCurrentTheme')) {
    function getCurrentTheme()
    {
        try {
            $whereClause = ["selected" => 1];
            $theme = getTableData('themes', $whereClause, 'path');
    
            // Remove leading slash if it exists
            $theme = ltrim($theme, '/');
    
            // Check if $theme is empty and set to "default" if it is
            if (empty($theme)) {
                $theme = "default";
            }
    
            return $theme;
        }
            //catch exception
        catch(Exception $e) {
            return "default";
        }
    }
}

/**
 * Retrieves configuration data for a specific configuration type.
 * 
 * @param {string} $configFor - The type of configuration to retrieve.
 * @returns {string|null} The configuration value, or null if not found.
 */
if(!function_exists('getConfigData')) {
    function getConfigData($configFor)
    {
        try {
            // Connect to the database
            $db = \Config\Database::connect();

            $tableName = "configurations";
            $returnColumn = "config_value";
            $whereClause = ["config_for" => $configFor];
            // Build the query
            $query = $db->table($tableName)
                ->select('config_value, data_type')
                ->where($whereClause)
                ->get();

            if ($query->getNumRows() > 0) {
                // Retrieve the result
                $row = $query->getRow();
                $configValue = $row->$returnColumn;
                $dataType = $row->data_type;

                if(strtolower($dataType) === "secret"){
                    $configValue = configDataDecryption($configValue); //decrypt config data if secret
                }
                
                return $configValue;
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
 * Encrypts configuration data using CodeIgniter's Encryption Library
 *
 * @param mixed $configDataValue The value to be encrypted (string, array, or object)
 * @param string|null $encryptionKey Optional custom encryption key
 * @return string Returns encrypted string (base64 encoded)
 * @throws Exception If encryption fails
 */
if (!function_exists('configDataEncryption')) {
    function configDataEncryption($configDataValue) {
        $encryptionKey = env('APP_KEY');
        
        $defaultKey = 'your-default-encryption-key';
        $key = $encryptionKey ?? $defaultKey;
        $method = 'AES-256-CBC';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

        // Encode to Base64 before encryption
        $encodedValue = base64_encode($configDataValue);
        $encryptedData = openssl_encrypt($encodedValue, $method, $key, 0, $iv);
        
        return base64_encode($iv . $encryptedData);
    }
}

/**
 * Decrypts configuration data previously encrypted with configDataEncryption
 *
 * @param string $configDataEncryptedValue The encrypted string to decrypt
 * @param string|null $encryptionKey Optional custom encryption key (must match key used for encryption)
 * @return mixed Returns decrypted data (string, or array/object if originally encrypted as such)
 * @throws Exception If decryption fails
 */
if (!function_exists('configDataDecryption')) {
    function configDataDecryption($configDataEncryptedValue,) {
        $encryptionKey = env('APP_KEY');
        
        $defaultKey = 'your-default-encryption-key';
        $key = $encryptionKey ?? $defaultKey;
        $method = 'AES-256-CBC';

        $decodedData = base64_decode($configDataEncryptedValue);
        $ivLength = openssl_cipher_iv_length($method);
        $iv = substr($decodedData, 0, $ivLength);
        $encryptedData = substr($decodedData, $ivLength);

        // Decrypt and decode from Base64
        $decryptedValue = openssl_decrypt($encryptedData, $method, $key, 0, $iv);
        return base64_decode($decryptedValue);
    }
}

/**
 * Retrieves theme data from the database based on the provided theme path.
 *
 * @param string $themePath The path of the theme.
 * @param string $returnColumn The column to return in the query result.
 * @return mixed The value of the specified column if found, or null if no record is found.
 */
if (!function_exists('getThemeData')) {
    function getThemeData(string $themePath, string $returnColumn)
    {
        try {
            // Connect to the database
            $db = \Config\Database::connect();
            
            // Ensure the theme path starts with a forward slash
            $cleanedThemePath = ltrim($themePath, '/');
            $themePath = '/' . $cleanedThemePath;
            
            $tableName = "themes";
            $whereClause = ["path" => $themePath];
            $orWhereClause = ['path' => $cleanedThemePath];
            
            // Build the query
            $query = $db->table($tableName)
                ->select($returnColumn)
                ->where($whereClause)
                ->orWhere($orWhereClause)
                ->get();
    
            // Check if any rows are returned
            if ($query->getNumRows() === 0) {
                // No record found, return null
                return null;
            }
    
            // Retrieve the result
            $row = $query->getRow();
            return $row->$returnColumn;
        }
            //catch exception
        catch(Exception $e) {
            return "";
        }
    }
}


/**
 * Updates the total view count for a specific record in a table.
 * Checks if a session exists for the record to avoid incrementing on page reloads.
 * If no session exists, increments the total views and updates the database.
 * 
 * @param {string} $tableName - The name of the table (e.g., "blogs").
 * @param {string} $primaryIdName - The name of the primary key column (e.g., "blog_id").
 * @param {string|int} $primaryId - The primary key value of the record (e.g., "7c4d3d90-08e0-451a-b79a-106d3150e6f3").
 * @return {void}
 */
if (!function_exists('updateTotalViewCount')) {
    function updateTotalViewCount($tableName, $primaryIdName, $primaryId)
    {
        try {
            $db = \Config\Database::connect();
            $session = \Config\Services::session();

            // Generate a unique session key for this record
            $sessionKey = 'viewed_' . $tableName . '_' . $primaryId;

            // Check if the session exists for this record
            if (!$session->get($sessionKey)) {
                $db->transStart(); // Start transaction

                // Get the current total views
                $builder = $db->table($tableName);
                $builder->select('total_views');
                $builder->where($primaryIdName, $primaryId);
                $query = $builder->get();
                $row = $query->getRow();

                if ($row) {
                    $currentViews = $row->total_views;

                    // Increment the total views
                    $newViews = $currentViews + 1;

                    // Update the total views in the database
                    $builder->where($primaryIdName, $primaryId);
                    $builder->update(['total_views' => $newViews]);

                    // Set a session to track that the view count has been updated for this record
                    $session->set($sessionKey, true);
                }

                $db->transComplete(); // Complete transaction
            }
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
        }
    }
}