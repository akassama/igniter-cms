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

if (!function_exists('removeDirectory')) {
    /**
     * Recursively removes a directory and all its contents
     * 
     * @param string $path The path to the directory to remove (relative to project root or absolute)
     * @return bool Returns TRUE on success, FALSE on failure
     */
    function removeDirectory($path)
    {
        // Get the project root directory (where index.php is located)
        $projectRoot = ROOTPATH;
        
        // Handle relative paths - if path doesn't start with / and isn't absolute, treat as relative to project root
        if (!isAbsolutePath($path)) {
            $fullPath = rtrim($projectRoot, '/') . '/' . ltrim($path, '/');
        } else {
            $fullPath = $path;
        }
        
        // Normalize path separators for cross-platform compatibility
        $fullPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPath);
        
        // Remove trailing directory separator
        $fullPath = rtrim($fullPath, DIRECTORY_SEPARATOR);
        
        // Check if path exists
        if (!file_exists($fullPath)) {
            return true; // Consider non-existent path as successfully "removed"
        }
        
        // Check if it's a file instead of directory
        if (is_file($fullPath)) {
            return unlink($fullPath);
        }
        
        // It's a directory, so process recursively
        if (!is_dir($fullPath)) {
            return false; // Not a file or directory - something's wrong
        }
        
        try {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($fullPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );
            
            foreach ($iterator as $item) {
                if ($item->isDir()) {
                    if (!rmdir($item->getPathname())) {
                        return false;
                    }
                } else {
                    if (!unlink($item->getPathname())) {
                        return false;
                    }
                }
            }
            
            // Remove the main directory itself
            return rmdir($fullPath);
            
        } catch (Exception $e) {
            // Fallback method if SPL iterators are not available or fail
            return removeDirectoryFallback($fullPath);
        }
    }
}

if (!function_exists('removeDirectoryFallback')) {
    /**
     * Fallback method using traditional recursive approach
     */
    function removeDirectoryFallback($path)
    {
        if (!file_exists($path)) {
            return true;
        }
        
        if (is_file($path)) {
            return unlink($path);
        }
        
        if (!is_dir($path)) {
            return false;
        }
        
        $files = array_diff(scandir($path), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $path . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                if (!removeDirectoryFallback($filePath)) {
                    return false;
                }
            } else {
                if (!unlink($filePath)) {
                    return false;
                }
            }
        }
        
        return rmdir($path);
    }
}

if (!function_exists('isAbsolutePath')) {
    /**
     * Check if a path is absolute
     */
    function isAbsolutePath($path)
    {
        // Check for Windows absolute path (C:\, D:\, etc.)
        if (preg_match('~^[a-zA-Z]:[\\\\/]~', $path)) {
            return true;
        }
        
        // Check for Unix/Linux absolute path (/path/to/file)
        if (strpos($path, '/') === 0 || strpos($path, '\\') === 0) {
            return true;
        }
        
        return false;
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

/**
 * Loads icon libraries for the site.
 *
 * By default, loads Bootstrap Icons and Remixicon. Additional libraries can be loaded
 * by passing their names as parameters (e.g., 'fontawesome', 'heroicons', etc.).
 * Supported additional libraries: fontawesome, heroicons, feather, lucide, material, tabler.
 *
 * @param string ...$libraries Variable number of library names to load additionally.
 * @return void
 * @since 1.0
 */
if (!function_exists('loadSiteIcons')) {
    function loadSiteIcons(...$libraries)
    {
        // Default: Bootstrap Icons and Remixicon
        echo '<!-- Bootstrap Icons -->' . PHP_EOL;
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">' . PHP_EOL;
        echo '<!-- Remix icons -->' . PHP_EOL;
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />' . PHP_EOL;

        // Additional libraries
        $additional = array_map('strtolower', $libraries);
        $supported = ['fontawesome', 'heroicons', 'feather', 'lucide', 'material', 'tabler'];

        foreach ($additional as $lib) {
            if (!in_array($lib, $supported)) {
                continue; // Skip unsupported
            }

            switch ($lib) {
                case 'fontawesome':
                    echo '<!-- Font Awesome -->' . PHP_EOL;
                    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">' . PHP_EOL;
                    break;
                case 'heroicons':
                    echo '<!-- Heroicons (SVG via CDN) -->' . PHP_EOL;
                    echo '<script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js"></script>' . PHP_EOL;
                    break;
                case 'feather':
                    echo '<!-- Feather Icons -->' . PHP_EOL;
                    echo '<link rel="stylesheet" href="https://unpkg.com/feather-icons/dist/feather.min.css">' . PHP_EOL;
                    break;
                case 'lucide':
                    echo '<!-- Lucide Icons (SVG via CDN) -->' . PHP_EOL;
                    echo '<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>' . PHP_EOL;
                    break;
                case 'material':
                    echo '<!-- Material Design Icons -->' . PHP_EOL;
                    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">' . PHP_EOL;
                    break;
                case 'tabler':
                    echo '<!-- Tabler Icons -->' . PHP_EOL;
                    echo '<link rel="stylesheet" href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css">' . PHP_EOL;
                    break;
            }
        }
    }
}

/**
 * Renders posts, and pages search results in grid with theme-agnostic styling
 *
 * @param string $searchQuery search query text
 * @param array $blogsSearchResults Array of blog posts
 * @param array $pagesSearchResults Array of pages
 * @return string HTML content
 */
if (!function_exists('renderSearchResults')) {
    function renderSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults)
    {
        // Check if all search result arrays are empty
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        $totalResults = (!$noResults) ? (count($blogsSearchResults ?? []) + count($pagesSearchResults ?? [])) : 0;

        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        ob_start();
        ?>
        <style>
        .sr-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            font-family: system-ui, -apple-system, sans-serif;
            color: <?=$contrast_color?>;
        }
        .sr-grid {
            display: grid;
            gap: 2rem;
        }
        .sr-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .sr-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .sr-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .sr-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: <?=$heading_color?>;
            margin: 0 0 1rem 0;
        }
        .sr-subtitle {
            font-size: 1.25rem;
            color: <?=$contrast_color?>;
            margin: 0;
        }
        .sr-section {
            margin-bottom: 3rem;
        }
        .sr-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1.5rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid <?=$default_color?>30;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sr-list {
            display: grid;
            gap: 1rem;
        }
        .sr-list-item {
            display: block;
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 8px;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        .sr-list-item:hover {
            border-color: <?=$default_color?>;
            background: <?=$background_color?>;
            transform: translateX(4px);
        }
        .sr-item-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }
        .sr-item-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0;
            flex: 1;
        }
        .sr-badge {
            background: <?=$accent_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .sr-item-desc {
            color: <?=$contrast_color?>;
            margin: 0 0 0.5rem 0;
            line-height: 1.5;
        }
        .sr-item-url {
            color: <?=$default_color?>;
            font-size: 0.875rem;
            margin: 0;
        }
        .sr-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .sr-blog-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .sr-blog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .sr-blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .sr-blog-content {
            padding: 1.5rem;
        }
        .sr-blog-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .sr-blog-category {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .sr-blog-date {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
        }
        .sr-blog-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }
        .sr-blog-excerpt {
            color: <?=$contrast_color?>;
            margin: 0 0 1.25rem 0;
            line-height: 1.5;
        }
        .sr-button {
            display: inline-block;
            background: <?=$default_color?>;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .sr-button:hover {
            background: <?=$accent_color?>;
            transform: translateY(-1px);
        }
        .sr-button-outline {
            background: transparent;
            border: 2px solid <?=$default_color?>;
            color: <?=$default_color?>;
        }
        .sr-button-outline:hover {
            background: <?=$default_color?>;
            color: white;
        }
        .sr-form {
            width: 100%;
        }
        .sr-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid <?=$default_color?>30;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s ease;
        }
        .sr-input:focus {
            outline: none;
            border-color: <?=$default_color?>;
        }
        .sr-icon {
            font-size: 1.2em;
            line-height: 1;
        }
        .sr-icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        .sr-center {
            text-align: center;
        }
        .sr-count {
            color: <?=$accent_color?>;
            font-weight: 600;
        }
        .sr-highlight {
            color: <?=$accent_color?>;
            font-weight: 600;
        }
        </style>

        <div class="sr-container">
            <?php if ($noResults): ?>
                <!-- No Results Found -->
                <div class="sr-header">
                    <h1 class="sr-title">No Results Found</h1>
                    <p class="sr-subtitle">Sorry, we couldn't find any content matching "<strong><?= esc($searchQuery) ?></strong>".</p>
                </div>

                <!-- Search Suggestion Card -->
                <div class="sr-grid">
                    <div class="sr-card sr-center">
                        <span class="sr-icon sr-icon-large"><i class="ri-heart-fill text-danger"></i></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Not the results you were looking for?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Help us improve your search experience by telling us what you were looking for.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="sr-form">
                            <input type="text" name="q" class="sr-input" placeholder="What were you searching for?" value="<?= esc($searchQuery) ?>" required>
                            <button type="submit" class="sr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php else: ?>
                <!-- Search Header -->
                <div class="sr-header">
                    <h1 class="sr-title">Search Results for "<span class="sr-highlight"><?= esc($searchQuery) ?></span>"</h1>
                    <p class="sr-subtitle"><span class="sr-count"><?= $totalResults ?></span> result(s) found</p>
                </div>

                <!-- Pages Results -->
                <?php if (!empty($pagesSearchResults)): ?>
                    <div class="sr-section">
                        <h2 class="sr-section-title">
                            <span class="sr-icon"><i class="ri-file-line"></i></span>
                            Pages
                        </h2>
                        <div class="sr-list">
                            <?php foreach ($pagesSearchResults as $page): ?>
                                <a href="<?= base_url($page['slug']) ?>" class="sr-list-item">
                                    <div class="sr-item-header">
                                        <h3 class="sr-item-title"><?= esc($page['title']) ?></h3>
                                        <span class="sr-badge">Page</span>
                                    </div>
                                    <p class="sr-item-desc">
                                        <?= !empty($page['excerpt']) ? esc(getTextSummary($page['excerpt'], 120)) : 'Learn more about this page.' ?>
                                    </p>
                                    <p class="sr-item-url"><?= base_url($page['slug']) ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Blogs Results -->
                <?php if (!empty($blogsSearchResults)): ?>
                    <div class="sr-section">
                        <h2 class="sr-section-title">
                            <span class="sr-icon"><i class="ri-newspaper-line"></i></span>
                            Blog Posts
                        </h2>
                        <div class="sr-blog-grid">
                            <?php foreach ($blogsSearchResults as $blog): ?>
                                <div class="sr-blog-card">
                                    <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                        <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                                             class="sr-blog-image"
                                             alt="<?= esc($blog['title']) ?>">
                                    </a>
                                    <div class="sr-blog-content">
                                        <div class="sr-blog-meta">
                                            <span class="sr-blog-category">
                                                <?= getBlogCategoryName($blog['category']) ?: 'Uncategorized' ?>
                                            </span>
                                            <span class="sr-blog-date">
                                                <span class="sr-icon"><i class="ri-calendar-line"></i></span>
                                                <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                                            </span>
                                        </div>
                                        <h3 class="sr-blog-title"><?= esc($blog['title']) ?></h3>
                                        <p class="sr-blog-excerpt">
                                            <?= getTextSummary($blog['excerpt'] ?? $blog['content'], 100) ?>
                                        </p>
                                        <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="sr-button sr-button-outline">Read More</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Feedback Section -->
                <div class="sr-section">
                    <div class="sr-card sr-center">
                        <span class="sr-icon sr-icon-large"><i class="ri-search-line"></i></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Not what you were looking for?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Help us improve your search experience.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="sr-form">
                            <input type="text" name="q" class="sr-input" placeholder="Try a different search term" value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="sr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Renders filtered posts, and pages search results in grid with theme-agnostic styling
 *
 * @param string $searchQuery search query text
 * @param array $blogsSearchResults Array of blog posts
 * @param array $pagesSearchResults Array of pages
 * @param string $type type of filter applied
 * @return string HTML content
 */
if (!function_exists('renderFilterSearchResults')) {
    function renderFilterSearchResults($searchQuery, $blogsSearchResults, $pagesSearchResults, $type = '')
    {
        // Check if all search result arrays are empty
        $noResults = empty($blogsSearchResults) && empty($pagesSearchResults);
        $totalResults = (!$noResults) ? (count($blogsSearchResults ?? []) + count($pagesSearchResults ?? [])) : 0;
        
        $typeLabel = ucfirst($type);
        $typeIcon = match($type) {
            'category' => '&#127991;', // 🏷️
            'tag' => '&#035;', // #
            'author' => '&#128100;', // 👤
            default => '&#128193;' // 📁
        };

        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        ob_start();
        ?>
        <style>
        .fr-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
            font-family: system-ui, -apple-system, sans-serif;
            color: <?=$contrast_color?>;
        }
        .fr-header {
            background: <?=$default_color?>;
            color: white;
            border-radius: 12px;
            padding: 2.5rem;
            margin-bottom: 3rem;
        }
        .fr-type-indicator {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 20px;
            padding: 0.75rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .fr-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            color: white;
        }
        .fr-subtitle {
            font-size: 1.125rem;
            margin: 0;
            opacity: 0.9;
            color: white;
        }
        .fr-highlight {
            color: #FFD700;
            font-weight: 600;
        }
        .fr-section {
            margin-bottom: 3rem;
        }
        .fr-section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1.5rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid <?=$default_color?>30;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .fr-count {
            background: <?=$accent_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: auto;
        }
        .fr-list {
            display: grid;
            gap: 1rem;
        }
        .fr-list-item {
            display: block;
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 8px;
            padding: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }
        .fr-list-item:hover {
            border-color: <?=$default_color?>;
            background: <?=$background_color?>;
            transform: translateX(4px);
        }
        .fr-item-header {
            display: flex;
            justify-content: between;
            align-items: start;
            margin-bottom: 0.75rem;
            gap: 1rem;
        }
        .fr-item-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0;
            flex: 1;
        }
        .fr-badge {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .fr-item-desc {
            color: <?=$contrast_color?>;
            margin: 0 0 0.5rem 0;
            line-height: 1.5;
        }
        .fr-item-url {
            color: <?=$default_color?>;
            font-size: 0.875rem;
            margin: 0;
        }
        .fr-blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .fr-blog-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .fr-blog-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        .fr-blog-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .fr-blog-content {
            padding: 1.5rem;
        }
        .fr-blog-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .fr-blog-category {
            background: <?=$default_color?>;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .fr-blog-date {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
        }
        .fr-blog-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 0.75rem 0;
            line-height: 1.4;
        }
        .fr-blog-excerpt {
            color: <?=$contrast_color?>;
            margin: 0 0 1.25rem 0;
            line-height: 1.5;
        }
        .fr-button {
            display: inline-block;
            background: <?=$default_color?>;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .fr-button:hover {
            background: <?=$accent_color?>;
            transform: translateY(-1px);
        }
        .fr-button-outline {
            background: transparent;
            border: 2px solid <?=$default_color?>;
            color: <?=$default_color?>;
        }
        .fr-button-outline:hover {
            background: <?=$default_color?>;
            color: white;
        }
        .fr-form {
            width: 100%;
        }
        .fr-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid <?=$default_color?>30;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s ease;
        }
        .fr-input:focus {
            outline: none;
            border-color: <?=$default_color?>;
        }
        .fr-icon {
            font-size: 1.2em;
            line-height: 1;
        }
        .fr-icon-large {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
        .fr-center {
            text-align: center;
        }
        .fr-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .fr-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        </style>

        <div class="fr-container">
            <?php if ($noResults): ?>
                <!-- No Results Found -->
                <div class="fr-header">
                    <div class="fr-type-indicator">
                        <span class="fr-icon"><?= $typeIcon ?></span>
                        <span><?= $typeLabel ?> Filter</span>
                    </div>
                    <h1 class="fr-title">No <?= $typeLabel ?> Results Found</h1>
                    <p class="fr-subtitle">No content found for "<strong><?= esc($searchQuery) ?></strong>" in <?= strtolower($typeLabel) ?>.</p>
                </div>

                <!-- Feedback Card -->
                <div class="fr-section">
                    <div class="fr-card fr-center">
                        <span class="fr-icon fr-icon-large"><i class="ri-filter-line"></i></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Refine Your Search</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Try a different <?= strtolower($typeLabel) ?> or search with different criteria.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="fr-form">
                            <input type="text" name="q" class="fr-input" placeholder="Try a different keyword" value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="fr-button">Search Again</button>
                        </form>
                    </div>
                </div>

            <?php else: ?>
                <!-- Search Header -->
                <div class="fr-header">
                    <div class="fr-type-indicator">
                        <span class="fr-icon"><?= $typeIcon ?></span>
                        <span><?= $typeLabel ?> Filter</span>
                    </div>
                    <h1 class="fr-title"><?= $typeLabel ?>: "<span class="fr-highlight"><?= esc($searchQuery) ?></span>"</h1>
                    <p class="fr-subtitle"><?= $totalResults ?> result(s) found in <?= strtolower($typeLabel) ?></p>
                </div>

                <!-- Pages Results -->
                <?php if (!empty($pagesSearchResults)): ?>
                    <div class="fr-section">
                        <h2 class="fr-section-title">
                            <span class="fr-icon"><i class="ri-file-line"></i></span>
                            Pages
                            <span class="fr-count"><?= count($pagesSearchResults) ?> result(s) found</span>
                        </h2>
                        <div class="fr-list">
                            <?php foreach ($pagesSearchResults as $page): ?>
                                <a href="<?= base_url($page['slug']) ?>" class="fr-list-item">
                                    <div class="fr-item-header">
                                        <h3 class="fr-item-title"><?= esc($page['title']) ?></h3>
                                        <span class="fr-badge">Page</span>
                                    </div>
                                    <p class="fr-item-desc">
                                        <?= !empty($page['excerpt']) ? esc(getTextSummary($page['excerpt'], 120)) : 'Learn more about this page.' ?>
                                    </p>
                                    <p class="fr-item-url"><?= base_url($page['slug']) ?></p>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Blogs Results -->
                <?php if (!empty($blogsSearchResults)): ?>
                    <div class="fr-section">
                        <h2 class="fr-section-title">
                            <span class="fr-icon"><i class="ri-newspaper-line"></i></span>
                            Blog Posts
                            <span class="fr-count"><?= count($blogsSearchResults) ?> result(s) found</span>
                        </h2>
                        <div class="fr-blog-grid">
                            <?php foreach ($blogsSearchResults as $blog): ?>
                                <div class="fr-blog-card">
                                    <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                        <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>"
                                             class="fr-blog-image"
                                             alt="<?= esc($blog['title']) ?>">
                                    </a>
                                    <div class="fr-blog-content">
                                        <div class="fr-blog-meta">
                                            <span class="fr-blog-category">
                                                <?= getBlogCategoryName($blog['category']) ?: 'Uncategorized' ?>
                                            </span>
                                            <span class="fr-blog-date">
                                                <span class="fr-icon"><i class="ri-calendar-line"></i></span>
                                                <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                                            </span>
                                        </div>
                                        <h3 class="fr-blog-title"><?= esc($blog['title']) ?></h3>
                                        <p class="fr-blog-excerpt">
                                            <?= getTextSummary($blog['excerpt'] ?? $blog['content'], 100) ?>
                                        </p>
                                        <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="fr-button fr-button-outline">Read More</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Final Feedback Section -->
                <div class="fr-section">
                    <div class="fr-card fr-center">
                        <span class="fr-icon fr-icon-large"><i class="ri-filter-line"></i></span>
                        <h2 style="font-size: 1.75rem; margin: 0 0 1rem 0; color: <?=$heading_color?>;">Need Different Results?</h2>
                        <p style="margin: 0 0 2rem 0; color: <?=$contrast_color?>;">Try searching with different criteria or browse all content.</p>
                        <form action="<?= base_url('search') ?>" method="get" class="fr-form">
                            <input type="text" name="q" class="fr-input" placeholder="Search again..." value="<?= esc($searchQuery) ?>">
                            <button type="submit" class="fr-button">Search</button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}


/**
 * Renders blog posts grid with theme-agnostic styling
 * 
 * @param array $blogs Array of blog posts
 * @param string $emptyMessage Message to display when no blogs found
 * @return string HTML content
 */
if (!function_exists('renderBlogsGrid')) {
    function renderBlogsGrid($blogs, $emptyMessage = 'No blog posts available at the moment.') 
    {
        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        ob_start();
        ?>
        <style>
        .bg-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .bg-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .bg-card {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .bg-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .bg-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }
        .bg-content {
            padding: 1.5rem;
        }
        .bg-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .bg-category {
            background: <?=$accent_color?>;
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .bg-date {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        .bg-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1rem 0;
            line-height: 1.4;
        }
        .bg-excerpt {
            color: <?=$contrast_color?>;
            margin: 0 0 1.5rem 0;
            line-height: 1.5;
        }
        .bg-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: <?=$default_color?>;
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .bg-button:hover {
            background: <?=$accent_color?>;
            transform: translateY(-1px);
        }
        .bg-empty {
            text-align: center;
            padding: 3rem 2rem;
            color: <?=$contrast_color?>;
            grid-column: 1 / -1;
        }
        .bg-icon {
            font-size: 1.1em;
            line-height: 1;
        }
        </style>

        <div class="bg-container">
            <div class="bg-grid">
                <?php if ($blogs): ?>
                    <?php foreach ($blogs as $blog): ?>
                        <div class="bg-card">
                            <a href="<?= base_url('blog/' . $blog['slug']) ?>">
                                <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                                     class="bg-image" 
                                     alt="<?= esc($blog['title']) ?>">
                            </a>
                            <div class="bg-content">
                                <div class="bg-meta">
                                    <span class="bg-category">
                                        <?= !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized" ?>
                                    </span>
                                    <span class="bg-date">
                                        <span class="bg-icon"><i class="ri-calendar-line"></i></span>
                                        <?= dateFormat($blog['created_at'], 'M j, Y') ?>
                                    </span>
                                </div>
                                <h3 class="bg-title"><?= esc($blog['title']) ?></h3>
                                <p class="bg-excerpt">
                                    <?= !empty($blog['excerpt']) ? getTextSummary($blog['excerpt'], 100) : getTextSummary($blog['content'], 100) ?>
                                </p>
                                <a href="<?= base_url('blog/' . $blog['slug']) ?>" class="bg-button">
                                    Read More
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="bg-empty">
                        <p><?= $emptyMessage ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Renders blog post content with theme-agnostic styling
 * 
 * @param array $blog_data Blog post data
 * @return string HTML content
 */
if (!function_exists('renderBlogContent')) {
    function renderBlogContent($blog_data) 
    {
        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        ob_start();
        ?>
        <style>
        .bc-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .bc-header {
            margin-bottom: 2rem;
        }
        .bc-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: <?=$heading_color?>;
            margin: 0 0 1.5rem 0;
            line-height: 1.2;
        }
        .bc-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            color: <?=$contrast_color?>;
            font-size: 0.95rem;
        }
        .bc-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .bc-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }
        .bc-author:hover {
            color: <?=$default_color?>;
        }
        .bc-author-image {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
        }
        .bc-category {
            background: <?=$default_color?>;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
            display: inline-block;
        }
        .bc-category:hover {
            background: <?=$accent_color?>;
        }
        .bc-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: block;
        }
        .bc-content {
            color: <?=$heading_color?>;
            line-height: 1.7;
            font-size: 1.1rem;
        }
        .bc-content h2, .bc-content h3, .bc-content h4 {
            color: <?=$heading_color?>;
            margin: 2rem 0 1rem 0;
        }
        .bc-content p {
            margin-bottom: 1.5rem;
        }
        .bc-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }
        .bc-content blockquote {
            border-left: 4px solid <?=$default_color?>;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: <?=$contrast_color?>;
        }
        .bc-icon {
            font-size: 1.1em;
            line-height: 1;
        }
        </style>

        <div class="bc-container">
            <article>
                <header class="bc-header">
                    <h1 class="bc-title"><?= $blog_data['title'] ?></h1>
                    
                    <div class="bc-meta">
                        <div class="bc-meta-item">
                            <span class="bc-icon"><i class="ri-calendar-line"></i></span>
                            Posted on <?= dateFormat($blog_data['created_at'], 'F j, Y'); ?>
                        </div>
                        
                        <div class="bc-meta-item">
                            <a href="<?= base_url('/search/filter/?type=author&key='.getUserData($blog_data['created_by'], "username"))?>" class="bc-author">
                                <img loading="lazy" src="<?=getImageUrl(getUserData($blog_data['created_by'], "profile_picture") ?? getDefaultProfileImagePath())?>" class="bc-author-image" alt="<?= $blog_data['title'] ?>">
                                <?= getActivityBy(esc($blog_data['created_by'])); ?>
                            </a>
                        </div>
                    </div>
                    
                    <?php $categoryName = !empty($blog_data['category']) ? getBlogCategoryName($blog_data['category']) : ""; ?>
                    <?php if ($categoryName): ?>
                        <a class="bc-category" href="<?= base_url('/search/filter/?type=category&key='.$categoryName) ?>">
                            <!-- <span class="bc-icon"><i class="ri-tag-line"></i></span> -->
                            <?= $categoryName?>
                        </a>
                    <?php endif; ?>
                </header>
                
                <?php if ($blog_data['featured_image']): ?>
                    <figure>
                        <img class="bc-image" src="<?= getImageUrl(($blog_data['featured_image']) ?? getDefaultImagePath())?>" alt="<?= $blog_data['title'] ?>" />
                    </figure>
                <?php endif; ?>
                
                <section class="bc-content">
                    <?= $blog_data['content'] ?>
                </section>
            </article>
        </div>
        <?php
        return ob_get_clean();
    }
}

/**
 * Renders blog sidebar widgets with theme-agnostic styling
 * 
 * @param array $categories Array of categories
 * @param array $blogs Array of recent blog posts
 * @param array $blog_data Current blog post data for tags
 * @return string HTML content
 */
if (!function_exists('renderBlogSidebar')) {
    function renderBlogSidebar($categories = [], $blogs = [], $blog_data = []) 
    {
        // Get theme colors
        $theme = getCurrentTheme();
        $default_color = getThemeData($theme, "default_color");
        $heading_color = getThemeData($theme, "heading_color");
        $accent_color = getThemeData($theme, "accent_color");
        $surface_color = getThemeData($theme, "surface_color");
        $contrast_color = getThemeData($theme, "contrast_color");
        $background_color = getThemeData($theme, "background_color");
        
        ob_start();
        ?>
        <style>
        .bs-widget {
            background: <?=$surface_color?>;
            border: 1px solid <?=$default_color?>20;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        .bs-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: <?=$heading_color?>;
            margin: 0 0 1.25rem 0;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid <?=$default_color?>20;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .bs-search-form {
            display: flex;
            gap: 0.5rem;
        }
        .bs-search-input {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid <?=$default_color?>30;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .bs-search-input:focus {
            outline: none;
            border-color: <?=$default_color?>;
        }
        .bs-search-button {
            background: <?=$default_color?>;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .bs-search-button:hover {
            background: <?=$accent_color?>;
        }
        .bs-categories-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .bs-category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .bs-category-item {
            margin-bottom: 0.75rem;
        }
        .bs-category-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: <?=$contrast_color?>;
            text-decoration: none;
            transition: color 0.3s ease;
            padding: 0.25rem 0;
        }
        .bs-category-link:hover {
            color: <?=$default_color?>;
        }
        .bs-category-count {
            background: <?=$default_color?>20;
            color: <?=$default_color?>;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .bs-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .bs-tag {
            background: <?=$heading_color?>;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        .bs-tag:hover {
            background: <?=$default_color?>;
            transform: translateY(-1px);
        }
        .bs-recent-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .bs-recent-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid <?=$default_color?>15;
        }
        .bs-recent-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        .bs-recent-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            flex-shrink: 0;
        }
        .bs-recent-content {
            flex: 1;
        }
        .bs-recent-title {
            margin: 0 0 0.5rem 0;
        }
        .bs-recent-title a {
            color: <?=$heading_color?>;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            line-height: 1.3;
            transition: color 0.3s ease;
        }
        .bs-recent-title a:hover {
            color: <?=$default_color?>;
        }
        .bs-recent-meta {
            color: <?=$contrast_color?>;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .bs-icon {
            font-size: 1.1em;
            line-height: 1;
        }
        </style>

        <div class="bs-sidebar">
            <!-- Search Widget -->
            <div class="bs-widget">
                <h3 class="bs-title">
                    <span class="bs-icon"><i class="ri-search-line"></i></span>
                    Search
                </h3>
                <form action="<?= base_url('search') ?>" method="get" class="bs-search-form">
                    <input type="text" name="q" class="bs-search-input" placeholder="Enter search term..." minlength="2" required />
                    <button type="submit" class="bs-search-button" title="Search">
                        <span class="bs-icon">Go!</span>
                    </button>
                </form>
            </div>

            <!-- Categories Widget -->
            <?php if ($categories): ?>
                <div class="bs-widget">
                    <h3 class="bs-title">
                        <span class="bs-icon"><i class="ri-tag-line"></i></span>
                        Categories
                    </h3>
                    <div class="bs-categories-grid">
                        <?php
                            $totalCategories = count($categories);
                            $halfCategories = ceil($totalCategories / 2);
                            $firstHalf = array_slice($categories, 0, $halfCategories);
                            $secondHalf = array_slice($categories, $halfCategories);
                        ?>
                        
                        <ul class="bs-category-list">
                            <?php foreach ($firstHalf as $category): ?>
                                <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                                <li class="bs-category-item">
                                    <a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>" class="bs-category-link">
                                        <?= $category['title'] ?>
                                        <span class="bs-category-count"><?= getTotalRecords('blogs', $whereClause) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <ul class="bs-category-list">
                            <?php foreach ($secondHalf as $category): ?>
                                <?php $whereClause = "category = '" . $category['category_id'] . "'"; ?>
                                <li class="bs-category-item">
                                    <a href="<?= base_url('/search/filter/?type=category&key='.$category['title']) ?>" class="bs-category-link">
                                        <?= $category['title'] ?>
                                        <span class="bs-category-count"><?= getTotalRecords('blogs', $whereClause) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tags Widget -->
            <?php if (!empty($blog_data['tags'])): ?>
                <div class="bs-widget">
                    <h3 class="bs-title">
                        <span class="bs-icon"><i class="ri-price-tag-line"></i></span>
                        Tags
                    </h3>
                    <div class="bs-tags">
                        <?php
                            $tags = $blog_data['tags'];
                            $tagsArray = explode(',', $tags);
                            
                            foreach ($tagsArray as $tag) {
                                $tag = htmlspecialchars(trim($tag));
                                echo '<a class="bs-tag" href="'.base_url("/search/filter/?type=tag&key=$tag").'">' . $tag . '</a>';
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Recent Posts Widget -->
            <?php if ($blogs): ?>
                <div class="bs-widget">
                    <h3 class="bs-title">
                        <span class="bs-icon"><i class="ri-newspaper-line"></i></span>
                        Recent Posts
                    </h3>
                    <ul class="bs-recent-list">
                        <?php foreach ($blogs as $blog): ?>
                            <?php 
                                $categoryName = !empty($blog['category']) ? getBlogCategoryName($blog['category']) : "Uncategorized"; 
                            ?>
                            <li class="bs-recent-item">
                                <img src="<?= getImageUrl($blog['featured_image'] ?? getDefaultImagePath()) ?>" 
                                    alt="<?= esc($blog['title']) ?>" 
                                    class="bs-recent-image">
                                <div class="bs-recent-content">
                                    <h4 class="bs-recent-title">
                                        <a href="<?= base_url('blog/'.$blog['slug']) ?>">
                                            <?= esc($blog['title']) ?>
                                        </a>
                                    </h4>
                                    <div class="bs-recent-meta">
                                        <span class="bs-icon"><i class="ri-calendar-line"></i></span>
                                        <?= dateFormat($blog['created_at'], 'M j, Y'); ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}


/**
 * Renders the admin bar for logged-in admin users on the frontend.
 *
 * This function generates an HTML admin bar similar to WordPress, visible only to logged-in admins.
 * It includes a logo, quick links to Dashboard and Edit Page (with dynamic URL based on current page),
 * and a user greeting with profile image and dropdown for navigation.
 *
 * @return string The HTML string for the admin bar, or empty string if user is not logged in or not admin.
 * @since 1.0
 */
if (!function_exists('renderAdminBar')) {
    function renderAdminBar()
    {
        if (!session()->get('is_logged_in')) {
            return '';
        }

        $sessionEmail = session()->get('email');
        $userRole = getUserRole($sessionEmail);

        if ($userRole !== 'Admin') {
            return '';
        }

        $sessionName = session()->get('first_name') . ' ' . session()->get('last_name');
        $userId = getLoggedInUserId();
        $userImage = getImageUrl(getUserData($userId, "profile_picture") ?? getDefaultProfileImagePath());
        
        // Determine edit page URL based on current URL
        $currentUrl = current_url();
        $baseUrl = base_url();
        
        // Get the request instance to access URI segments
        $request = \Config\Services::request();
        $uri = $request->getUri();
        $path = $uri->getPath(); // Gets the path without query string
        $query = $uri->getQuery(); // Gets the query string
        
        // Remove base path from the path if needed
        $basePath = rtrim($baseUrl, '/');
        $cleanPath = trim(str_replace(parse_url($baseUrl, PHP_URL_PATH), '', $path), '/');

        // Layout page
        $editLayoutPageUrl = base_url('/account/appearance/theme-editor/layout');
        
        // Determine edit page URL based on path and query parameters
        if ($cleanPath === '' || $cleanPath === 'home') {
            // Home page
            $editPageUrl = base_url('/account/appearance/theme-editor/home');
        } elseif ($cleanPath === 'blogs') {
            // Blogs listing page
            $editPageUrl = base_url('/account/appearance/theme-editor/blogs');
        } elseif (strpos($cleanPath, 'blog/') === 0 && substr_count($cleanPath, '/') === 1) {
            // Individual blog post (matches blog/slug pattern)
            $editPageUrl = base_url('/account/appearance/theme-editor/view-blog');
        } elseif ($cleanPath === 'search' && strpos($query, 'q=') !== false) {
            // Search results page
            $editPageUrl = base_url('/account/appearance/theme-editor/search');
        } elseif ($cleanPath === 'search/filter' && strpos($query, 'type=') !== false) {
            // Filtered search results page
            $editPageUrl = base_url('/account/appearance/theme-editor/search-filter');
        } else {
            // Other pages
            $editPageUrl = base_url('/account/appearance/theme-editor/view-page');
        }

        $adminBarHtml = '
        <style>
            #navbar {
                top: 40px !important;
            }
            .admin-bar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 10000;
                height: 40px;
                background-color: #343a40;
                color: #ffffff;
                padding: 0;
                border-bottom: 1px solid #dee2e6;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                font-size: 14px;
            }
            .admin-bar-container {
                max-width: 1140px;
                margin: 0 auto;
                padding: 0 15px;
                display: flex;
                align-items: center;
                height: 100%;
                justify-content: space-between;
            }
            .admin-bar-logo {
                margin-right: 1rem;
                border-radius: 0.25rem;
                height: 24px;
                width: 24px;
            }
            .admin-bar-link {
                color: #ffffff;
                text-decoration: none;
                margin-right: 1rem;
                display: flex;
                align-items: center;
                line-height: 1;
            }
            .admin-bar-link:hover {
                color: #ffffff;
                text-decoration: none;
                opacity: 0.8;
            }
            .admin-bar-icon {
                margin-right: 0.25rem;
                font-size: 1.1rem;
                color: #ffffff;
            }
            .admin-bar-last-link {
                margin-right: 0;
            }
            .admin-bar-user {
                position: relative;
                color: #ffffff;
                text-decoration: none;
                display: flex;
                align-items: center;
                cursor: pointer;
                margin-left: auto;
            }
            .admin-bar-user:hover {
                opacity: 0.8;
            }
            .admin-bar-dropdown {
                display: none;
                position: absolute;
                top: 100%;
                right: 0;
                background-color: #343a40;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
                min-width: 150px;
                z-index: 10001;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            }
            .admin-bar-user:hover .admin-bar-dropdown {
                display: block;
            }
            .admin-bar-dropdown a {
                color: #ffffff;
                text-decoration: none;
                padding: 0.5rem 1rem;
                display: block;
                line-height: 1.5;
            }
            .admin-bar-dropdown a:hover {
                background-color: #495057;
                color: #ffffff;
            }
            .admin-bar-user-img {
                width: 24px;
                height: 24px;
                border-radius: 50%;
                margin-right: 8px;
                object-fit: cover;
            }
        </style>
        <div class="admin-bar">
            <div class="admin-bar-container">
                <div class="d-flex align-items-center">
                    <img src="https://i.ibb.co/Pv4XWmxv/Igniter-CMS.jpg" alt="Admin Logo" class="admin-bar-logo">
                    <a href="' . base_url('/account') . '" class="admin-bar-link">
                        <i class="ri-dashboard-line admin-bar-icon"></i>
                        Dashboard
                    </a>
                    <a href="' . $editLayoutPageUrl . '" class="admin-bar-link">
                        <i class="ri-layout-grid-line admin-bar-icon"></i>
                        Edit Layout
                    </a>
                    <a href="' . $editPageUrl . '" class="admin-bar-link admin-bar-last-link">
                        <i class="ri-edit-line admin-bar-icon"></i>
                        Edit Current Page
                    </a>
                </div>
                <div class="admin-bar-user">
                    <img src="' . $userImage . '" alt="User Profile" class="admin-bar-user-img">
                    Hello, ' . esc($sessionName) . '
                    <i class="ri-arrow-down-s-line admin-bar-icon" style="margin-left: 0.25rem;"></i>
                    <div class="admin-bar-dropdown">
                        <a href="' . base_url('/account') . '">Dashboard</a>
                        <a href="' . base_url('/sign-out') . '">Logout</a>
                    </div>
                </div>
            </div>
        </div>';

        return $adminBarHtml;
    }
}