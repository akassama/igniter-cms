<?php
use App\Models\ActivityLogsModel;
use App\Constants\ActivityTypes;
use App\Models\FileUploadModel;
use App\Models\SiteStatsModel;
use MatthiasMullie\Minify;

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

if (!function_exists('getFileDetailsList')) {
    function getFileDetailsList($fileId) {
        // Define the where clause for the database query
        $whereClause = ["file_id" => $fileId];

        // Get the required data from the database
        $caption = getTableData('file_uploads', $whereClause, 'caption');
        $identifier = getTableData('file_uploads', $whereClause, 'unique_identifier');
        $group = getTableData('file_uploads', $whereClause, 'group');

        // Create the HTML string with the retrieved data
        $html = '
            <ul class="list-group">
                <li class="list-group-item">Caption: ' .$caption . '</li>
                <li class="list-group-item">Identifier: ' .$identifier . '</li>
                <li class="list-group-item">Group: ' .$group . '</li>
            </ul>
        ';

        return $html;
    }
}

if (!function_exists('getFileDetailsInput')) {
    function getFileDetailsInput($fileId) {
        // Define the where clause for the database query
        $whereClause = ["file_id" => $fileId];

        // Get the required data from the database
        $caption = getTableData('file_uploads', $whereClause, 'caption');
        $identifier = getTableData('file_uploads', $whereClause, 'unique_identifier');
        $group = getTableData('file_uploads', $whereClause, 'group');

        // Create the HTML string with the retrieved data
        $html = '
            <form class="row" action="'.base_url("services/update-file-data").'">
                <div class="col-12 mb-1">
                    <input type="text" class="form-control" name="'.$fileId.'_caption" id="'.$fileId.'_caption" value="'.$caption.'" placeholder="caption">
                </div>
                <div class="col-12 mb-1">
                    <input type="text" class="form-control" name="'.$fileId.'_unique_identifier" id="'.$fileId.'_unique_identifier" value="'.$identifier.'" placeholder="unique_identifier">
                </div>
                <div class="col-12 mb-1">
                    <input type="text" class="form-control" name="'.$fileId.'_group" id="'.$fileId.'_group" value="'.$group.'" placeholder="group">
                </div>
                <div class="col-12 my-2">
                    <button type="button" class="btn btn-outline-danger float-start" id="cancel-btn"
                            hx-get="'.base_url().'/htmx/cancel-file-data-form/'.$fileId.'"
                            hx-trigger="click"
                            hx-target="#file-details-'.$fileId.'"
                            hx-swap="innerHTML">
                        <i class="ri-close-circle-line"></i>
                        Cancel
                    </button>
                    <button type="button" class="btn btn-outline-primary float-end" id="submit-btn"
                            hx-post="'.base_url().'/htmx/update-file-data-form/'.$fileId.'"
                            hx-trigger="click"
                            hx-target="#file-details-'.$fileId.'"
                            hx-swap="innerHTML">
                        <i class="ri-edit-box-line"></i>
                        Update
                    </button>
                </div>
            </form>
        ';

        return $html;
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

//TODO : Implement transStart for all
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
 * Update a data record.
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
 * Retrieves data from a specified database table based on the given conditions.
 *
 * @param {string} $tableName - The name of the database table.
 * @param {array} $whereClause - An associative array representing the WHERE clause conditions (e.g., ['column_name' => 'value']).
 * @param {string} $returnColumn - The name of the column to retrieve data from.
 * @return {mixed} The value of the specified column or null if no record is found.
 */
if(!function_exists('getTableData')) {
    function getTableData($tableName, $whereClause, $returnColumn)
    {
        // Connect to the database
        $db = \Config\Database::connect();

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
        return $query->getResult(); // Adjust this based on your query result type
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
 * Generates HTML table rows containing image files for a given user ID.
 *
 * This function fetches image files (e.g., JPG, PNG, GIF) from the database using the
 * FileUploadModel, filters them based on the provided user ID, and returns HTML table rows
 * to display the file information in a structured way.
 *
 * @param int $userId The ID of the user whose image files need to be fetched.
 * @return string HTML string representing the table rows containing image files data.
 */
if (!function_exists('getImageFilesTableData')) {
    function getImageFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get image files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)
            ->whereIn('file_type', ['jpg', 'jpeg', 'png', 'gif']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            $imageFiles = $fileUploadsModel
            ->whereIn('file_type', ['jpg', 'jpeg', 'png', 'gif'])
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();
        }

        $output = '';
        $rowCount = 1;

        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td style='width: 50%;'>
                                    <div class='mb-1'>
                                        <img loading='lazy' src='" . getImageUrl($file['upload_path']) . "' class='img-thumbnail' alt='" . esc($file['file_name']) . "' style='height: 125px; width: 125px'> 
                                    </div>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>" . dateFormat($file['created_at'], 'd-m-Y') . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
    }
}

/**
 * Retrieves table data for document files uploaded by the specified user.
 *
 * @param {number} userId - The ID of the user whose files to retrieve.
 * @returns {string} The HTML output for the document files table.
 */
if (!function_exists('getDocumentFilesTableData')) {
    function getDocumentFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get document files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)
            ->whereIn('file_type', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf', 'odt', 'ods', 'odp']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            $imageFiles = $fileUploadsModel
            ->whereIn('file_type', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'rtf', 'odt', 'ods', 'odp']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();
        }

        $output = '';
        $rowCount = 1;

        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td style='width: 50%;'>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>" . dateFormat($file['created_at'], 'd-m-Y') . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
    }
}

/**
 * Retrieves table data for video files uploaded by the specified user.
 *
 * @param {number} userId - The ID of the user whose files to retrieve.
 * @returns {string} The HTML output for the video files table.
 */
if (!function_exists('getVideoFilesTableData')) {
    function getVideoFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get document files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)
            ->whereIn('file_type', ['mp4', 'mov', 'avi', 'mkv', 'webm', 'flv', 'wmv', 'mpeg', 'mpg']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            $imageFiles = $fileUploadsModel
            ->whereIn('file_type', ['mp4', 'mov', 'avi', 'mkv', 'webm', 'flv', 'wmv', 'mpeg', 'mpg']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();
        }

        $output = '';
        $rowCount = 1;
        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td>" . getFileInputPreview($file['upload_path'], $file['file_type'], 200) . "</td>
                                <td style='width: 50%;'>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>" . dateFormat($file['created_at'], 'd-m-Y') . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
    }
}

/**
 * Retrieves table data for audio files uploaded by the specified user.
 *
 * @param {number} userId - The ID of the user whose files to retrieve.
 * @returns {string} The HTML output for the audio files table.
 */
if (!function_exists('getAudioFilesTableData')) {
    function getAudioFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get document files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)
            ->whereIn('file_type', ['mp3', 'wav', 'ogg', 'flac', 'aac']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            $imageFiles = $fileUploadsModel
            ->whereIn('file_type', ['mp3', 'wav', 'ogg', 'flac', 'aac']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();
        }            

        $output = '';
        $rowCount = 1;

        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td style='width: 50%;'>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>" . dateFormat($file['created_at'], 'd-m-Y') . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
    }
}

/**
 * Retrieves table data for all files uploaded by the specified user.
 *
 * @param {number} userId - The ID of the user whose files to retrieve.
 * @returns {string} The HTML output for the files table.
 */
if (!function_exists('getAllFilesTableData')) {
    function getAllFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get document files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)->limit(intval(getConfigData("queryLimitMax")))->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            // Get document files for the user
            $imageFiles = $fileUploadsModel->limit(intval(getConfigData("queryLimitUltraMax")))->findAll();
        }   

        $output = '';
        $rowCount = 1;

        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td style='width: 50%;'>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>" . dateFormat($file['created_at'], 'd-m-Y') . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
    }
}

/**
 * Retrieves table data for archive files uploaded by the specified user.
 *
 * @param {number} userId - The ID of the user whose files to retrieve.
 * @returns {string} The HTML output for the archive files table.
 */
if (!function_exists('getArchivesFilesTableData')) {
    function getArchivesFilesTableData($userId) {
        $fileUploadsModel = new FileUploadModel();

        // Get document files for the user
        $imageFiles = $fileUploadsModel->where('user_id', $userId)
            ->whereIn('file_type', ['zip', 'rar', 'tar', 'gz', '7z']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitMax")))
            ->findAll();

        $userRole = getUserRole(getLoggedInUserId());
        //check if admin to view all images
        if ($userRole == "Admin"){
            // Get document files for the user
            $imageFiles = $fileUploadsModel
            ->whereIn('file_type', ['zip', 'rar', 'tar', 'gz', '7z']) // Adjust file types accordingly
            ->limit(intval(getConfigData("queryLimitUltraMax")))
            ->findAll();
        }  

        $output = '';
        $rowCount = 1;

        if ($imageFiles) {
            foreach ($imageFiles as $file) {
                $output .= "<tr>
                                <td style='width: 5%;'>{$rowCount}</td>
                                <td style='width: 50%;'>
                                    <div class='input-group col-12 mb-3'>
                                        <span class='input-group-text'>" . getFileInputIcon($file['file_type']) . "</span>
                                        <input type='text' class='form-control' id='name-" . esc($file['file_id']) . "' value='" . esc($file['file_name']) . "' readonly disabled>
                                        <button class='btn btn-outline-secondary btn-modal-copy copy-btn-label' type='button' id='button-addon2' data-clipboard-text='" . esc($file['file_name']) . "'>
                                            <i class='ri-checkbox-multiple-fill'></i>
                                        </button>
                                        <span class='d-none'>
                                            <!--Search Terms-->
                                           ".$file['file_type'].",".$file['file_type'].",".$file['file_name'].",".$file['caption'].",".$file['unique_identifier']."
                                        </span>
                                    </div>
                                    <p class='".(!empty($file['caption']) ? '' : 'd-none')."'>Caption: " . $file['caption'] . "</p>
                                    <p class='".(!empty($file['unique_identifier']) ? '' : 'd-none')."'>Caption: " . $file['unique_identifier'] . "</p>
                                    <p class='".(!empty($file['group']) ? '' : 'd-none')."'>Caption: " . $file['group'] . "</p>
                                </td>
                                <td>" . esc($file['file_type']) . "</td>
                                <td>" . displayFileSize($file['file_size']) . "</td>
                                <td>
                                    <div class='row text-center p-1'>
                                        <div class='col mb-1'>
                                            <a class='text-dark td-none mr-1 mb-1 btn-modal-copy copy-path-label' href='javascript:void(0)' data-clipboard-text='" . $file['upload_path'] . "'>
                                                <i class='h5 ri-file-copy-2-line'></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $rowCount++;
            }
        }

        return $output;
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

/**
 * Determines the user's device based on the user agent string.
 *
 * @return {string} A string describing the user's device and browser.
 */
if (!function_exists('getUserDevice')) {
    function getUserDevice(): string
    {
        $request = \Config\Services::request();
        $userAgent = $request->getUserAgent();

        if ($userAgent->isMobile()) {
            return $userAgent->getMobile() . ' (Mobile)';
        } elseif ($userAgent->isBrowser()) {
            return $userAgent->getBrowser() . ' on ' . $userAgent->getPlatform();
        } elseif ($userAgent->isRobot()) {
            return $userAgent->getRobot();
        }

        return 'Unknown Device';
    }
}

/**
* Get the IP address of the client device
*
* @return string
*/
if(!function_exists('getDeviceIP')) {
   function getDeviceIP(): string
   {
       // Check if the IP is the IPv6 localhost address
       $ip = $_SERVER['REMOTE_ADDR'];
       if ($ip === '::1') {
           return '127.0.0.1';
       }
       return $ip;
   }
}

/**
* Get the type of device (mobile, tablet, desktop) based on user agent
*
* @return string
*/
if(!function_exists('getDeviceType')) {
   function getDeviceType(): string
   {
       $userAgent = $_SERVER['HTTP_USER_AGENT'];
       $deviceType = 'desktop';

       if (stripos($userAgent, 'Mobi') !== false) {
           $deviceType = 'mobile';
       } elseif (stripos($userAgent, 'Tablet') !== false || stripos($userAgent, 'iPad') !== false) {
           $deviceType = 'tablet';
       }

       return $deviceType;
   }
}

/**
 * Get the name of the browser from the user agent string.
 *
 * @return string The name of the browser.
 */
if (!function_exists('getBrowserName')) {
    function getBrowserName(): string
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browserName = 'Unknown';

        // Check for specific browser identifiers in the user agent string
        if (strpos($userAgent, 'Edg') !== false) {
            $browserName = 'Microsoft Edge';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            $browserName = 'Mozilla Firefox';
        } elseif (strpos($userAgent, 'OPR') !== false || strpos($userAgent, 'Opera') !== false) {
            $browserName = 'Opera';
        } elseif (strpos($userAgent, 'Chrome') !== false) {
            $browserName = 'Google Chrome';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            $browserName = 'Apple Safari';
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident/7') !== false) {
            $browserName = 'Internet Explorer';
        }

        return $browserName;
    }
}

/**
* Get the referrer URL
*
* @return string
*/
if(!function_exists('getReferrer')) {
   function getReferrer(): string
   {
       return $_SERVER['HTTP_REFERER'] ?? '';
   }
}

/**
* Get the HTTP request method (GET, POST, etc.)
*
* @return string
*/
if(!function_exists('getReguestMethod')) {
   function getReguestMethod(): string
   {
       return $_SERVER['REQUEST_METHOD'];
   }
}

/**
* Get the operating system of the client device
*
* @return string
*/
if(!function_exists('getOperatingSystem')) {
   function getOperatingSystem(): string
   {
       $userAgent = $_SERVER['HTTP_USER_AGENT'];
       $os = 'Unknown';

       if (stripos($userAgent, 'Windows') !== false) {
           $os = 'Windows';
       } elseif (stripos($userAgent, 'Linux') !== false) {
           $os = 'Linux';
       } elseif (stripos($userAgent, 'Android') !== false) {
           $os = 'Android';
       } elseif (stripos($userAgent, 'iPhone') !== false || stripos($userAgent, 'iPad') !== false || stripos($userAgent, 'iPod') !== false) {
           $os = 'iOS';
       } elseif (stripos($userAgent, 'Mac OS X') !== false) {
           $os = 'macOS';
       }

       return $os;
   }
}

/**
 * Get the country of the client device based on IP address
 *
 * @return string
 */
if(!function_exists('getCountry')) {
    function getCountry($ipAddress = null): string
    {
        if(empty($ipAddress)){
            $ipAddress = getDeviceIP(); //"102.129.135.0";
        }
         
        $apiUrl = "https://api.country.is/$ipAddress";

        try {
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);
            return $data['country'] ?? 'Unknown';
        } catch (\Exception $e) {
            // Log the error or handle it gracefully
            return 'Unknown';
        }
    }
}

/**
* Get the user agent string of the client device
*
* @return string
*/
if(!function_exists('getUserAgent')) {
   function getUserAgent(): string
   {
       return $_SERVER['HTTP_USER_AGENT'];
   }
}

/**
 * Determines the type of page based on the current URL.
 *
 * This function checks if the current URL contains '/blog' to determine
 * if the page is a blog or a regular page. It also handles cases where
 * the current URL is null or empty.
 *
 * @param string|null $currentUrl The current URL to check.
 * @return string Returns 'blog' if the URL contains '/blog', 'page' otherwise.
 */
if (!function_exists('getPageType')) {
    function getPageType($currentUrl)
    {
        // Check if the URL is null or empty
        if (is_null($currentUrl) || $currentUrl === '') {
            return 'page';
        }

        //case it is blogs page
        if(str_contains($currentUrl, '/blog')){
            return 'blog';
        }

        //default return page
        return 'page';
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
 * Get the screen resolution of the client device
 *
 * @return string
 */
if(!function_exists('getScreenResolution')) {
    function getScreenResolution(): string
    {
        $screenResolution = $_COOKIE['screen_resolution'] ?? "NA";
        return $screenResolution;
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
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

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
 * Fetches and displays navigation options in a dropdown.
 *
 * @param int|null $navigationId The ID of the navigation to be selected (optional).
 * @return void
 */
if(!function_exists('getNavigationParents'))
{
    function getNavigationParents($navigationId = null)
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
if(!function_exists('getBlogCategories'))
{
    function getBlogCategories($categoryId = null)
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
 * Fetches and displays product category options in a dropdown.
 *
 * @param int|null $categoryId The ID of the category to be selected (optional).
 * @return void
 */
if(!function_exists('getProductCategories'))
{
    function getProductCategories($categoryId = null)
    {
        $tableName = "product_categories";
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
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

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
 * Generates a unique slug for a given event title.
 *
 * @param {string} title - The event title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateEventTitleSlug')) {

    function generateEventTitleSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

        // Check if the slug exists in the 'categories' table
        $builder = $db->table('events');
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
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

        // List of excluded slugs that should not be used directly
        $excludedSlugs = array("contact", "home", "blog", "blogs", "tag", "tags", "category", "categories", "privacy-policy", "cookie-policy", "sitemap", "rss", "shop", "campaings", "donate");

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
 * Generates a unique slug for a given project title.
 *
 * @param {string} title - The project title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateProjectTitleSlug')) {

    function generateProjectTitleSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

        // Check if the slug exists in the 'portfolios' table
        $builder = $db->table('portfolios');
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
 * Generates a unique slug for a given product title.
 *
 * @param {string} title - The product title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateProductTitleSlug')) {

    function generateProductTitleSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

        // Check if the slug exists in the 'products' table
        $builder = $db->table('products');
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
 * Generates a unique slug for a given donation title.
 *
 * @param {string} title - The donation title to generate a slug for.
 * @returns {string} The generated slug.
 */
if (!function_exists('generateDonationTitleSlug')) {

    function generateDonationTitleSlug(string $title)
    {
        $db = \Config\Database::connect();

        // Convert the title to lower case, remove special characters, and replace spaces with dashes
        $slug = strtolower($title);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove special characters
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with dashes
        $slug = trim($slug, '-'); // Trim any leading or trailing dashes

        // Check if the slug exists in the 'donations' table
        $builder = $db->table('donation_causes');
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
 * Fetches and displays languages options in a dropdown.
 *
 * @param int|null $languagesId The ID of the languages to be selected (optional).
 * @return void
 */
if(!function_exists('getLanguages'))
{
    function getLanguages($languageId = null)
    {
        $tableName = "languages";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->where('language_id !=', 'en')
                     ->orderBy('value', 'ASC')
                     ->get();

        $selected = "";
        foreach ($query->getResult() as $row) {
            $selected = $row->language_id == $languageId ? "selected" : "";
            echo "<option value='$row->language_id' $selected>$row->value</option>";
        }
    }
}

/**
 * Fetches and displays languages as a csv.
 *
 * @param int|null $languagesId The ID of the languages to be selected (optional).
 * @return void
 */
if(!function_exists('getLanguagesList'))
{
    function getLanguagesList()
    {
        $tableName = "translations";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->where('language !=', 'en')
                     ->orderBy('language', 'ASC')
                     ->get();

        $selectedList = "";
        foreach ($query->getResult() as $row) {
            $selectedList = $selectedList.$row->language.",";
        }
        $trimmed_string = rtrim($selectedList, ",");
        return $trimmed_string;
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
        return 'public/uploads/file-uploads/default/default-profile.png';
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
 * Retrieves the name of a product category based on its ID.
 *
 * @param string $categoryId The unique identifier (GUID) of the category.
 * @return string The category name if found, or an empty string if the ID is invalid or the category does not exist.
 */
if(!function_exists('getProductCategoryName'))
{
    function getProductCategoryName($categoryId) {
        // Check if the category ID is empty or not a valid GUID
        if (empty($categoryId) || !isValidGUID($categoryId)) {
            return "";
        }

        // Retrieve the category name from the 'categories' table
        $categoryName = getTableData('product_categories', ['category_id' => $categoryId], 'title');
        
        return $categoryName;
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
 * Logs site statistic data to the database.
 * 
 * @param {string} $ipAddress - The IP address of the visitor.
 * @param {string} $deviceType - The type of device used by the visitor.
 * @param {string} $browserType - The type of browser used by the visitor.
 * @param {string} $pageType - The type of page visited by the visitor.
 * @param {string} $pageVisitedId - The unique identifier for the page visited.
 * @param {string} $pageVisitedUrl - The URL of the page visited.
 * @param {string} $referrer - The referrer URL for the visitor.
 * @param {int} $statusCode - The HTTP status code for the page visit.
 * @param {int|null} $userId - The ID of the user, if logged in.
 * @param {string} $sessionId - The unique session ID for the visitor.
 * @param {string} $requestMethod - The HTTP request method used by the visitor.
 * @param {string} $operatingSystem - The operating system used by the visitor.
 * @param {string} $country - The country of the visitor.
 * @param {string} $screenResolution - The screen resolution of the visitor's device.
 * @param {string} $userAgent - The user agent string of the visitor's browser.
 * @param {mixed|null} $otherParams - Any additional parameters to be stored.
 * 
 * @returns {void}
 */
if (!function_exists('logSiteStatistic')) {
    function logSiteStatistic(
        $ipAddress,
        $deviceType,
        $browserType,
        $pageType,
        $pageVisitedId,
        $pageVisitedUrl,
        $referrer,
        $statusCode,
        $userId,
        $sessionId,
        $requestMethod,
        $operatingSystem,
        $country,
        $screenResolution,
        $userAgent,
        $otherParams = null
    ) {
        $statId = getGUID();
        $db = \Config\Database::connect();
        $tableName = "site_stats";
        $logVisit = shouldLogVisit($pageVisitedUrl);

        try {
            $db->transStart(); // Start transaction

            // Check if there is a record in the past 1 hour with the same attributes
            $oneHourAgo = date('Y-m-d H:i:s', strtotime('-1 hour'));
            $existingRecord = $db->table($tableName)
                ->where('ip_address', $ipAddress)
                ->where('page_visited_id', $pageVisitedId)
                ->where('status_code', $statusCode)
                ->where('user_id', $userId)
                ->where('session_id', $sessionId)
                ->where('created_at >=', $oneHourAgo)
                ->get()->getRowArray();

            if (!$existingRecord && $logVisit) {
                // If no record exists, add the new data
                $data = [
                    'site_stat_id' => $statId,
                    'ip_address' => $ipAddress,
                    'device_type' => $deviceType,
                    'browser_type' => $browserType,
                    'page_type' => strtolower($pageType),
                    'page_visited_id' => $pageVisitedId,
                    'page_visited_url' => $pageVisitedUrl,
                    'referrer' => $referrer,
                    'status_code' => $statusCode,
                    'user_id' => $userId,
                    'session_id' => $sessionId,
                    'request_method' => $requestMethod,
                    'operating_system' => $operatingSystem,
                    'country' => $country,
                    'screen_resolution' => $screenResolution,
                    'user_agent' => $userAgent,
                    'other_params' => $otherParams
                ];

                $db->table($tableName)->insert($data);
            }

            $db->transComplete(); // Complete transaction
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
        }
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
 * Generate a label with an icon and color based on the identified IP service type.
 *
 * @param string $ipAddress The IP address to check.
 * @return string The HTML label with an icon and color.
 */
if (!function_exists('IPIdentifierLabel')) {
    function IPIdentifierLabel(string $ipAddress): string
    {
        // Identify the IP service type
        $ipType = identifyIPServiceType($ipAddress);

        // Get the current device's IP address (example implementation)
        $deviceIP = getDeviceIP();

        // Determine the label based on the IP type
        switch ($ipType) {
            case 'Cloudflare':
                return '<i class="ri-circle-fill text-primary"></i>'; // Blue for Cloudflare
                break;

            case 'Fastly':
                return '<i class="ri-circle-fill text-success"></i>'; // Green for Fastly
                break;

            case 'Akamai':
                return '<i class="ri-circle-fill text-info"></i>'; // Light blue for Akamai
                break;

            case 'Amazon CloudFront':
                return '<i class="ri-circle-fill text-warning"></i>'; // Yellow for CloudFront
                break;

            case 'Sucuri':
                return '<i class="ri-circle-fill text-danger"></i>'; // Red for Sucuri
                break;

            case 'NitroPack':
                return '<i class="ri-circle-fill text-secondary"></i>'; // Gray for NitroPack
                break;

            case 'Microsoft Azure CDN':
                return '<i class="ri-circle-fill text-teal"></i>'; // Gray for Microsoft Azure CDN
                break;

            case 'Google Cloud CDN':
                return '<i class="ri-circle-fill text-orange"></i>'; // Gray for Google Cloud CDN
                break;

            case 'Unknown':
                // Check if the IP matches the current device's IP
                if ($ipAddress === $deviceIP) {
                    return '<i class="ri-circle-fill text-muted"></i>'; // Gray for local device
                }
                return '<i class="ri-checkbox-blank-circle-line text-dark"></i>'; // Dark for unknown IPs
                break;

            default:
                return '<i class="ri-checkbox-blank-circle-line text-dark"></i>'; // Fallback (Unknown)
        }
    }
}

/**
 * Identifies the service type (CDN/proxy) based on IP address
 * 
 * @param string $ipAddress The IP address to check
 * @return string The identified service type
 */
if (!function_exists('identifyIPServiceType')) {
    function identifyIPServiceType(string $ipAddress): string {
        // Normalize IP address to lowercase for consistent matching
        $ipAddress = strtolower($ipAddress);

        // Cloudflare IPv6 ranges
        if (preg_match('/^2a06:98c0:|^2606:4700:|^2803:f800:/i', $ipAddress)) {
            return "Cloudflare";
        }

        // Fastly IPv6 ranges
        if (preg_match('/^2a04:4e42:|^2a04:4e40:/i', $ipAddress)) {
            return "Fastly";
        }

        // Akamai IPv6 ranges
        if (preg_match('/^2600:1400:|^2600:1401:|^2600:1402:|^2600:1403:/i', $ipAddress)) {
            return "Akamai";
        }

        // Amazon CloudFront IPv6 ranges
        if (preg_match('/^2600:9000:|^2406:da00:|^2404:c2c0:/i', $ipAddress)) {
            return "Amazon CloudFront";
        }

        // Microsoft Azure CDN IPv6 ranges
        if (preg_match('/^2620:1ec:|^2a0c::|^2603:1030:/i', $ipAddress)) {
            return "Microsoft Azure CDN";
        }

        // Google Cloud CDN IPv6 ranges
        if (preg_match('/^2600:1901:|^2404:6800:|^2607:f8b0:/i', $ipAddress)) {
            return "Google Cloud CDN";
        }

        // Sucuri IPv6 ranges
        if (preg_match('/^2a02:fe80:/i', $ipAddress)) {
            return "Sucuri";
        }

        // NitroPack IPv6 ranges
        if (preg_match('/^2a01:7c8:/i', $ipAddress)) {
            return "NitroPack";
        }

        // IPv4 address patterns
        $ipPatterns = [
            'Cloudflare' => [
                '/^103\.21\.244\.|^103\.22\.200\.|^103\.31\.4\.|^104\.16\.|^104\.17\.|^104\.18\.|^104\.19\.|^104\.20\.|^104\.21\.|^104\.22\.|^104\.23\.|^104\.24\.|^104\.25\.|^104\.26\.|^104\.27\.|^104\.28\.|^108\.162\.192\.|^141\.101\.|^162\.158\.|^172\.64\.|^173\.245\.48\.|^188\.114\.|^190\.93\.240\.|^197\.234\.240\.|^198\.41\.128\./'
            ],
            'Fastly' => [
                '/^151\.101\.|^199\.27\./'
            ],
            'Akamai' => [
                '/^23\.32\.|^23\.33\.|^23\.34\.|^23\.35\.|^23\.36\.|^23\.37\.|^23\.38\.|^23\.39\.|^23\.40\.|^23\.41\.|^23\.42\.|^23\.43\.|^23\.44\.|^23\.45\.|^23\.46\.|^23\.47\.|^23\.48\.|^23\.49\.|^23\.50\.|^23\.51\.|^23\.52\.|^23\.53\.|^23\.54\.|^23\.55\./'
            ],
            'Amazon CloudFront' => [
                '/^13\.32\.|^13\.33\.|^13\.34\.|^13\.35\.|^13\.224\.|^13\.225\.|^13\.226\.|^13\.227\.|^13\.228\./'
            ],
            'Microsoft Azure CDN' => [
                '/^147\.243\.|^152\.199\.|^204\.79\.|^204\.96\.|^13\.107\.|^72\.21\./'
            ],
            'Google Cloud CDN' => [
                '/^172\.217\.|^172\.253\.|^216\.239\.|^74\.125\.|^108\.177\.|^142\.250\.|^35\.190\.|^35\.191\./'
            ],
            'Sucuri' => [
                '/^192\.124\.249\.|^192\.161\.0\./'
            ],
            'NitroPack' => [
                '/^194\.1\.147\./'
            ]
        ];

        // Check IPv4 patterns
        foreach ($ipPatterns as $service => $patterns) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $ipAddress)) {
                    return $service;
                }
            }
        }

        return "Unknown";
    }
}

/**
 * Determines whether a visit should be logged based on the current URL.
 * 
 * @param string $currentUrl The current URL to check
 * @return bool Whether the visit should be logged
 */
function shouldLogVisit($currentUrl) {
    // Convert current URL to lowercase
    $currentUrlLower = strtolower(removeIndexPhp($currentUrl));

    // Paths to exclude from logging
    $excludedPaths = [
        strtolower(base_url('/account')),
        strtolower(base_url('/services')),
        strtolower(base_url('/htmx'))
    ];

    // Check excluded paths
    $isExcludedPath = array_reduce($excludedPaths, function($carry, $path) use ($currentUrlLower) {
        return $carry || strpos($currentUrlLower, $path) !== false;
    }, false);

    // Check for direct path segments
    $hasExcludedSegment = 
        strpos($currentUrlLower, '/account') !== false || 
        strpos($currentUrlLower, '/services') !== false || 
        strpos($currentUrlLower, '/htmx') !== false;

    // Return true if no excluded paths or segments are found
    return !($isExcludedPath || $hasExcludedSegment);
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
        $black_lested_paths = array(
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
            ".sql", "sql_dump", "database_dump", "db_backup", "backup.sql.gz", "backup.sql.zip", "backup.sql.tar" // SQL paths
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
        foreach ($black_lested_paths as $blocked_path) {
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

/**
 * Validates an API key by checking its existence and status in the database.
 * 
 * @param {string} $apiKey - The API key to validate.
 * @returns {bool} True if the API key is valid and active, false otherwise.
 */
if (!function_exists('isValidApiKey')) {
    function isValidApiKey($apiKey)
    {
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
 * Checks if the given API request model is allowed.
 *
 * @param string $urlSegment The request segment (e.g., 'get-blog').
 * @return bool Returns true if the model is allowed, otherwise false.
 */
if (!function_exists('isAllowedModel')) {
    function isAllowedModel($urlSegment)
    {
        //Mapping of request segments to their respective model names.
        $requestModels = [
            'get-home-page' => 'HomePageModel',
            'get-all-blogs' => 'BlogsModel',
            'get-blog' => 'BlogsModel',
            'get-blogs' => 'BlogsModel',
            'get-category' => 'CategoriesModel',
            'get-categories' => 'CategoriesModel',
            'get-code' => 'CodesModel',
            'get-codes' => 'CodesModel',
            'get-content-block' => 'ContentBlocksModel',
            'get-content-blocks' => 'ContentBlocksModel',
            'get-country' => 'CountriesModel',
            'get-countries' => 'CountriesModel',
            'get-counter' => 'CountersModel',
            'get-counters' => 'CountersModel',
            'get-donation-cause' => 'DonationCausesModel',
            'get-donation-causes' => 'DonationCausesModel',
            'get-event' => 'EventsModel',
            'get-events' => 'EventsModel',
            'get-faq' => 'FrequentlyAskedQuestionsModel',
            'get-faqs' => 'FrequentlyAskedQuestionsModel',
            'get-language' => 'LanguagesModel',
            'get-languages' => 'LanguagesModel',
            'get-navigation' => 'NavigationsModel',
            'get-navigations' => 'NavigationsModel',
            'get-all-pages' => 'PagesModel',
            'get-page' => 'PagesModel',
            'get-pages' => 'PagesModel',
            'get-partner' => 'PartnersModel',
            'get-partners' => 'PartnersModel',
            'get-policy' => 'PoliciesModel',
            'get-policies' => 'PoliciesModel',
            'get-portfolio' => 'PortfoliosModel',
            'get-portfolios' => 'PortfoliosModel',
            'get-pricing' => 'PricingsModel',
            'get-pricings' => 'PricingsModel',
            'get-product-category' => 'ProductCategoriesModel',
            'get-product-categories' => 'ProductCategoriesModel',
            'get-product' => 'ProductsModel',
            'get-products' => 'ProductsModel',
            'get-resume' => 'ResumesModel',
            'get-resumes' => 'ResumesModel',
            'search-results' => 'SearchModel',
            'model-search-results' => 'SearchModel',
            'filter-search-results' => 'SearchModel',
            'get-service' => 'ServicesModel',
            'get-services' => 'ServicesModel',
            'get-social' => 'SocialsModel',
            'get-socials' => 'SocialsModel',
            'get-team' => 'TeamsModel',
            'get-teams' => 'TeamsModel',
            'get-testimonial' => 'TestimonialsModel',
            'get-testimonials' => 'TestimonialsModel',
            'get-theme' => 'ThemesModel',
            'get-themes' => 'ThemesModel',
            'get-translation' => 'TranslationsModel',
            'get-translations' => 'TranslationsModel',
        ];

        // Validates if the given request segment exists in the predefined request models.
        if (!isset($requestModels[$urlSegment])) {
            return false;
        }

        // Retrieves the corresponding model name for the given request segment.
        $modelName = $requestModels[$urlSegment];

        // Fetches the list of allowed models from the configuration.
        $allowedModels = getConfigData("AllowedApiGetModels");

        // Converts the CSV string of allowed models into an array.
        $allowedModelsArray = array_map('trim', explode(',', $allowedModels));

        // Checks if the model name exists in the allowed models array.
        return in_array($modelName, $allowedModelsArray, true);
    }
}


/**
 * Logs an API call with details in the database.
 * 
 * @param {string} $apiKey - The API key used for the call.
 * @param {string} $ipAddress - The IP address of the API call.
 * @param {string} $deviceType - The type of device making the API call.
 * @param {string} $country - The country of origin for the API call.
 * @param {string} $userAgent - The user agent string of the client.
 */
if (!function_exists('logApiCall')) {
    function logApiCall(
        $apiKey,
        $ipAddress,
        $deviceType,
        $country,
        $userAgent
    ) {
        $apiCallId = getGUID();
        $db = \Config\Database::connect();
        $tableName = "api_calls_tracker";

        try {
            $db->transStart(); // Start transaction

            // If no record exists, add the new data
            $data = [
                'api_call_id' => $apiCallId,
                'api_key' => $apiKey,
                'ip_address' => $ipAddress,
                'country' => $country,
                'user_agent' => $userAgent
            ];

            $db->table($tableName)->insert($data);

            $db->transComplete(); // Complete transaction
        } catch (\Exception $e) {
            $db->transRollback(); // Rollback transaction on error
            log_message('error', $e->getMessage());
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
 * Retrieves home-page data for a specific home-page type.
 * 
 * @param {string} $section - The type of home-page to retrieve.
 * @returns {string|null} The home-page value, or null if not found.
 */
if(!function_exists('getHomePageData')) {
    function getHomePageData($section, $returnColumn)
    {
        try {
            // Connect to the database
            $db = \Config\Database::connect();
    
            $tableName = "home_page";
            $whereClause = ["section" => $section];
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
 * Generates HTML list items for unique project filters.
 *
 * Connects to the database, retrieves unique `category_filter` values from the `projects` table,
 * and formats them into HTML list items with a specified prefix.
 *
 * @param string $prefix The prefix to use for the filter classes. Default is "filter".
 * @return string The formatted HTML list items as a string.
 */
if (!function_exists('getProjectFilters')) {
    function getProjectFilters($prefix = "filter")
    {
        // Connect to the database
        $db = \Config\Database::connect();

        // Query to get unique category_filter values
        $query = $db->table('portfolios')
                    ->select('category,category_filter')
                    ->distinct()
                    ->get();

        // Initialize an empty array to store filters
        $filters = [];

        // Loop through the results and format the filters
        foreach ($query->getResult() as $row) {
            $category = $row->category;
            $filter = $row->category_filter;
            $filters[] = '<li data-filter=".' . $prefix . '-' . $filter . '">' . $category . '</li>';
        }

        // Return the filters as a string
        return implode("\n", $filters);
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
 * Retrieves page meta information based on the given URL and meta type.
 * 
 * This function dynamically determines meta information for different page types
 * by analyzing the URL and fetching data from various sources (config, database).
 * 
 * @param {string} $pageUrl - The full URL of the page
 * @param {string} $metaType - The type of meta information to retrieve 
 *                              (e.g., 'metaTitle', 'metaDescription', etc.)
 * @returns {string} The requested meta information
 */
if (!function_exists('getPageMetaInfo')) {
    function getPageMetaInfo($pageUrl, $metaType)
    {
        try {

            // Remove index.php from URL if it exists
            $pageUrl = removeIndexPhp($pageUrl);
            $baseUrl = base_url();

            // Initialize default meta data from configuration
            $metaAuthor = getConfigData("MetaAuthor");
            $metaTitle = getConfigData("MetaTitle");
            $metaDescription = getConfigData("MetaDescription");
            $metaKeywords = getConfigData("MetaKeywords");
            $metaOgImage = getConfigData("MetaOgImage");
            $metaPageUrl = $pageUrl;

            // Remove base URL to get relative path
            $relativePath = str_replace($baseUrl, '', $pageUrl);
            $relativePath = rtrim($relativePath, '/');

            // Default model and slug
            $model = "default";
            $slugId = "";

            // Determine the model and slugId based on the relative path
            // This section uses an array-based approach for easier maintenance
            $pathMappings = [
                'blog/' => [
                    'model' => 'blogs',
                    'metaFields' => [
                        'author' => 'created_by',
                        'title' => 'meta_title',
                        'description' => 'meta_description',
                        'keywords' => 'meta_keywords',
                        'ogImage' => 'featured_image'
                    ]
                ],
                'portfolio/' => [
                    'model' => 'portfolios',
                    'metaFields' => [
                        'author' => 'created_by',
                        'title' => 'meta_title',
                        'description' => 'meta_description',
                        'keywords' => 'meta_keywords',
                        'ogImage' => 'featured_image'
                    ]
                ],
                'event/' => [
                    'model' => 'events',
                    'metaFields' => [
                        'author' => 'created_by',
                        'title' => 'meta_title',
                        'description' => 'meta_description',
                        'keywords' => 'meta_keywords',
                        'ogImage' => 'image'
                    ]
                ]
            ];

            // Special page mappings
            $specialPages = [
                'blogs' => [
                    'model' => 'blogsPage',
                    'metaTitleConfig' => 'BlogsPageMetaTitle',
                    'metaDescConfig' => 'BlogsPageMetaDescription',
                    'metaKeywordsConfig' => 'BlogsPageMetaKeywords'
                ],
                'portfolios' => [
                    'model' => 'portfoliosPage',
                    'metaTitleConfig' => 'PortfoliosPageMetaTitle',
                    'metaDescConfig' => 'PortfoliosPageMetaDescription',
                    'metaKeywordsConfig' => 'PortfoliosPageMetaKeywords'
                ],
                'events' => [
                    'model' => 'eventsPage',
                    'metaTitleConfig' => 'EventsPageMetaTitle',
                    'metaDescConfig' => 'EventsPageMetaDescription',
                    'metaKeywordsConfig' => 'EventsPageMetaKeywords'
                ],
                'contact' => [
                    'model' => 'contactsPage',
                    'metaTitleConfig' => 'ContactUsPageMetaTitle',
                    'metaDescConfig' => 'ContactUsPageMetaDescription',
                    'metaKeywordsConfig' => 'ContactUsPageMetaTitle'
                ],
                'search' => [
                    'model' => 'searchPage',
                    'metaTitleConfig' => 'SearchPageMetaTitle',
                    'metaDescConfig' => 'SearchPageMetaDescription',
                    'metaKeywordsConfig' => 'SearchPageMetaKeywords'
                ],
                'search/filter' => [
                    'model' => 'searchPageFilter',
                    'metaTitleConfig' => 'SearchFilterPageMetaTitle',
                    'metaDescConfig' => 'SearchFilterPageMetaDescription',
                    'metaKeywordsConfig' => 'SearchFilterPageMetaKeywords'
                ]
            ];

            // Check for specific page types first
            if (isset($specialPages[$relativePath])) {
                $pageConfig = $specialPages[$relativePath];
                $model = $pageConfig['model'];

                $metaTitle = getConfigData($pageConfig['metaTitleConfig']);
                $metaDescription = getConfigData($pageConfig['metaDescConfig']);
                $metaKeywords = getConfigData($pageConfig['metaKeywordsConfig']);
            }
            // Check for dynamic pages with prefixes
            else {
                foreach ($pathMappings as $prefix => $config) {
                    if (strpos($relativePath, $prefix) !== false) {
                        $model = $config['model'];
                        $slugId = str_replace($prefix, '', $relativePath);

                        // Dynamically fetch meta information
                        $metaAuthor = getActivityBy(
                            getTableData($model, ['slug' => $slugId], $config['metaFields']['author'])
                        );
                        $metaTitle = getTableData($model, ['slug' => $slugId], $config['metaFields']['title']);
                        $metaDescription = getTableData($model, ['slug' => $slugId], $config['metaFields']['description']);
                        $metaKeywords = getTableData($model, ['slug' => $slugId], $config['metaFields']['keywords']);
                        $metaOgImage = getTableData($model, ['slug' => $slugId], $config['metaFields']['ogImage']);
                        break;
                    }
                }

                // Handle single page without prefix
                if ($model === 'default' && strpos($relativePath, '/') === false) {
                    $model = "pages";
                    $slugId = $relativePath;
                    $metaAuthor = getActivityBy(
                        getTableData('pages', ['slug' => $slugId], 'created_by')
                    );
                    $metaTitle = getTableData('pages', ['slug' => $slugId], 'meta_title');
                    $metaDescription = getTableData('pages', ['slug' => $slugId], 'meta_description');
                    $metaKeywords = getTableData('pages', ['slug' => $slugId], 'meta_keywords');
                }
            }

            // Return specific meta information based on type
            switch (strtolower($metaType)) {
                /**
                 * Retrieve the page meta author
                 * @type {string}
                 */
                case 'metaauthor':
                    return $metaAuthor;

                /**
                 * Retrieve the page meta title, falling back to default if not set
                 * @type {string}
                 */
                case 'metatitle':
                    return $metaTitle ?? getConfigData("MetaTitle");

                /**
                 * Retrieve the page meta description
                 * @type {string}
                 */
                case 'metadescription':
                    return $metaDescription ?? getConfigData("MetaDescription");

                /**
                 * Retrieve the page meta keywords
                 * @type {string}
                 */
                case 'metakeywords':
                    return $metaKeywords ?? getConfigData("MetaKeywords");

                /**
                 * Retrieve the page Open Graph image
                 * @type {string}
                 */
                case 'metaogimage':
                    return $metaOgImage ?? getConfigData("MetaOgImage");

                /**
                 * Retrieve the full page URL
                 * @type {string}
                 */
                case 'metapageurl':
                    return $metaPageUrl;

                /**
                 * Default case - return empty string for unrecognized meta types
                 * @type {string}
                 */
                default:
                    return "";
            }
        }
            //catch exception
        catch(Exception $e) {
            return "NA";
        }

    }
}


/**
 * Gets the HTML label for a subscriber's status.
 *
 * @param string $status The subscriber's status.
 * @return string The HTML label for the status.
 */
if (!function_exists('getSubscriberStatusLabel')) {
    function getSubscriberStatusLabel($status) {
        if($status == '0'){
            return "<span class='badge bg-secondary'>Unsubscribed</span>";
        }
        else if($status == '1'){
            return "<span class='badge bg-success'>Subscribed</span>";
        }
        else {
            return "<span class='badge bg-danger'>NA</span>";
        }
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
 * Formats the Gemini API response for display in HTML.
 *
 * @param string $aiResponse The AI response string.
 * @return string The formatted HTML string.
 */
if (!function_exists('formatGeminiAIResponse')) {
    function formatGeminiAIResponse($aiResponse) {
        if ($aiResponse === false || $aiResponse === null || empty($aiResponse)) {
            return "<div class='ai-response'>Error getting a response from the AI.</div>";
        }

        $formattedResponse = nl2br($aiResponse);

        // List formatting (improved)
        $formattedResponse = preg_replace('/^\* (.+)$/m', '<ul><li>$1</li></ul>', $formattedResponse);
        $formattedResponse = preg_replace('/^(\d+)\. (.+)$/m', '<ol><li>$2</li></ol>', $formattedResponse);

        // Code blocks (with language highlighting and improved regex)
        $formattedResponse = preg_replace_callback('/```([a-z]+)?\n(.*?)\n```/s', function ($matches) {
            $lang = isset($matches[1]) ? strtolower($matches[1]) : ''; // Get language or default to empty string
            $code = htmlentities(trim($matches[2]));

            $class = $lang ? " class='language-" . $lang . "'" : ""; // Add language class for highlight.js
            return "<pre><code" . $class . ">" . $code . "</code></pre>";
        }, $formattedResponse);

        // Bold and italics
        $formattedResponse = preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $formattedResponse);
        $formattedResponse = preg_replace('/\b\*([^*]+)\*\b/', '<em>$1</em>', $formattedResponse);
        $formattedResponse = preg_replace('/\_([^_]+)\_/', '<em>$1</em>', $formattedResponse);


        $formattedResponse = "<div class='ai-response'>" . $formattedResponse . "</div>";

        return $formattedResponse;
    }
}


/**
 * Calls the Gemini API and returns the AI response as a string.
 *
 * @param string $prompt The prompt to send to the Gemini API.
 * @return string|bool The AI response as a string, or false on error.
 */
if (!function_exists('callGeminiAPI')) {
    function callGeminiAPI($prompt) {
        $apiKey = empty(!getConfigData("AIServiceKey")) ? getConfigData("AIServiceKey") : env('AI_API_KEY');
        $apiUrl = getConfigData("GeminiBaseURL") . $apiKey;
        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ]
        ];

        $jsonData = json_encode($data);

        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => $jsonData,
        ]);


        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // Handle cURL errors
            error_log('cURL Error: ' . curl_error($ch));  // Log the error
            curl_close($ch);
            return false; // Or return a specific error message
        }

        curl_close($ch);

        //Check HTTP code for success
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            error_log("HTTP Error: " . $httpCode . " - " . $response);
            return false; //Or return a specific error message
        }

        // Decode the JSON response
        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding errors
            error_log('JSON Error: ' . json_last_error_msg());
            return false;
        }


        if (isset($decodedResponse['candidates'][0]['content']['parts'][0]['text'])) {
            return $decodedResponse['candidates'][0]['content']['parts'][0]['text'];
        } else {
            // Handle cases where the expected data is not present
            error_log('Unexpected API response format: ' . print_r($decodedResponse, true)); // Log the full response for debugging
            return false;
        }
    }
}

/**
 * Extracts the text content from a string, removing code blocks and other non-text elements.
 *
 * @param string $input The input string containing text and potentially code or other markup.
 * @return string The extracted text content.
 */
if (!function_exists('extractPromptText')) {
    function extractPromptText($input) {
        // Remove code blocks enclosed in triple backticks (```).
        $input = preg_replace('/```.*?```/s', '', $input);

        // Remove single backticks used for inline code.
        $input = str_replace("`", '', $input);

        //Remove HTML tags
        $input = strip_tags($input);

        // Remove any remaining non-text characters (e.g., control characters).  This is an optional step, and you may want to customize the regex to suit your exact needs.
        $input = preg_replace('/[^a-zA-Z0-9\s.,?!:;\'"-]/', '', $input); // Keep alphanumeric, whitespace, and common punctuation

        // Trim whitespace from the beginning and end of the string.
        $input = trim($input);

        //Remove new lines and multiple spaces
        $input = preg_replace('/\s+/', ' ', $input);

        return $input;
    }
}

/**
 * Cleans and formats the activity logs analysis response by removing markdown, 
 * normalizing HTML, and extracting the security analysis content.
 *
 * @param string $analysis The raw analysis response containing HTML and markdown
 * @return string Cleaned HTML content ready for display
 *
 * @example
 * $cleanedHtml = cleanActivityLogsAnalysisResponse($apiResponse);
 * // Returns: <div class="security-analysis">...</div>
 */
if (!function_exists('cleanActivityLogsAnalysisResponse')) {
    function cleanActivityLogsAnalysisResponse($analysis)
    {
        $cleaned = preg_replace('/```html/', '', $analysis);
        $cleaned = preg_replace('/```/', '', $cleaned);
        
        $cleaned = html_entity_decode($cleaned);
    
        $cleaned = preg_replace('/(?<=>)\s+|\s+(?=<)/', '', $cleaned);
        
        preg_match('/<div class="security-analysis">.*<\/div>/s', $cleaned, $matches);
        
        $result = $matches[0] ?? '<div class="security-analysis"><p>Error processing analysis</p></div>';
        
        return preg_replace('/\s+/', ' ', trim($result));
    }
}

/**
 * Cleans and sanitizes the AI-generated HTML response from error analysis.
 * Ensures only the relevant .error-analysis block is extracted and returned,
 * removing any markdown or extra formatting.
 * @param {string} $response - The raw AI-generated HTML response.
 * @returns {string} Sanitized HTML string containing only the desired .error-analysis content.
*/
if (!function_exists('cleanErrorAnalysisResponse')) {
    function cleanErrorAnalysisResponse($response)
    {
        // Remove markdown code blocks if present
        $cleaned = preg_replace('/```html/', '', $response);
        $cleaned = preg_replace('/```/', '', $cleaned);
        
        // Decode HTML entities
        $cleaned = html_entity_decode($cleaned);
        
        // Extract just our error-analysis div
        preg_match('/<div class="error-analysis">.*<\/div>/s', $cleaned, $matches);
        
        return $matches[0] ?? '<div class="error-analysis"><p>Error processing analysis</p></div>';
    }
}

/**
 * Cleans and sanitizes the AI-generated HTML response from the visit stats analysis.
 * Ensures only the relevant `.visit-analysis` block is extracted and returned,
 * removing any markdown or extra formatting.
 *
 * @param {string} $analysis - The raw AI-generated HTML response.
 * @returns {string} Sanitized HTML string with only the desired content.
 */
if (!function_exists('cleanVisitStatsAnalysisResponse')) {
    function cleanVisitStatsAnalysisResponse($analysis)
    {
        $cleaned = preg_replace('/```html/', '', $analysis);
        $cleaned = preg_replace('/```/', '', $cleaned);
        $cleaned = html_entity_decode($cleaned);
        $cleaned = preg_replace('/(?<=>)\s+|\s+(?=<)/', '', $cleaned);
        preg_match('/<div class="visit-analysis">.*?<\/div>/s', $cleaned, $matches);
        $result = $matches[0] ?? '<div class="visit-analysis"><p>Error processing analysis</p></div>';
        return preg_replace('/\s+/', ' ', trim($result));
    }
}

/**
 * Render hCaptcha widget if enabled.
 *
 * @return void
 */
if (!function_exists('renderHcaptcha')) {
    function renderHcaptcha()
    {
        $useCaptcha = getConfigData("UseCaptcha");
        if(strtolower($useCaptcha) === "yes")
        {
            // Get the hCaptcha site key from environment or configuration
            $hcaptchaSiteKey = getConfigData("HCaptchaSiteKey");
            if (!empty($hcaptchaSiteKey)) {
                // Render the hCaptcha widget
                echo '<div class="col-12">';
                echo '<div class="h-captcha" data-sitekey="' . $hcaptchaSiteKey . '"></div>';
                echo '</div>';
            } else {
                log_message('error', 'hCaptcha site key is not set.');
            }
        }
    }
}


/**
 * Validate hCaptcha response.
 *
 * @return bool|string Returns true if CAPTCHA is valid, otherwise returns an error message.
 */
if (!function_exists('validateHcaptcha')) {
    function validateHcaptcha($returnUrl = null)
    {
        // Check if CAPTCHA is enabled
        $useCaptcha = getConfigData("UseCaptcha");
        if (strtolower($useCaptcha) !== "yes") {
            return true; // CAPTCHA is not enabled, so validation is skipped
        }

        // Get hCaptcha secret key
        $hcaptcha_secret = getConfigData("HCaptchaSecretKey");
        if (empty($hcaptcha_secret)) {
            log_message('error', 'hCaptcha secret key is not set.');
            return 'CAPTCHA configuration error. Please contact support.';
        }

        // Get hCaptcha response from the form
        $hcaptcha_response = service('request')->getPost('h-captcha-response');
        if (empty($hcaptcha_response)) {
            return 'CAPTCHA response is missing. Please complete the CAPTCHA.';
        }

        // Verify the CAPTCHA with hCaptcha API
        $verify_url = "https://hcaptcha.com/siteverify";
        $data = [
            'secret' => $hcaptcha_secret,
            'response' => $hcaptcha_response
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($verify_url, false, $context);
        $response = json_decode($result);

        if (!$response->success) {
            return 'CAPTCHA validation failed. Please try again.';
        }

        return true; // CAPTCHA validation successful
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
 * Generates a lighter or darker shade of a given CSS color code.
 *
 * @param string $colorCode The CSS color code (e.g., #00050a, rgb(0, 5, 10), rgba(0, 5, 10, 1.0)).
 * @param string $shade     'lighter' or 'darker'.
 * @param int    $percent   The percentage to lighten or darken (0-100).
 *
 * @return string The modified color code, or the original if an error occurs.
 */
if (!function_exists('adjustColorShade')) {
    function adjustColorShade($colorCode, $shade = "lighter", $percent = 25)
    {
        // Validate inputs
        if (!in_array($shade, ['lighter', 'darker']) || !is_numeric($percent) || $percent < 0 || $percent > 100) {
            return $colorCode; // Return the original color on invalid input
        }

        // Normalize color code to hex format
        $colorCode = normalizeHex($colorCode);

        if (!$colorCode) {
            return $colorCode; // Return the original color if normalization fails
        }

        // Remove '#' if present
        $colorCode = ltrim($colorCode, '#');

        // Convert hex to RGB
        $rgb = hexToRgb($colorCode);

        if (!$rgb) {
            return "#" . $colorCode; // Return Original hex if RGB conversion fails
        }

        // Adjust RGB values
        $adjustedRgb = [];
        foreach ($rgb as $value) {
            $change = round(($percent / 100) * (255 - $value));
            if ($shade === 'darker') {
                $change = -$change;
            }
            $adjustedValue = max(0, min(255, $value + $change));
            $adjustedRgb[] = $adjustedValue;
        }

        // Convert adjusted RGB back to hex
        return '#' . rgbToHex($adjustedRgb);
    }

    /**
     * Normalizes a color code to hex format.
     *
     * @param string $colorCode The color code.
     *
     * @return string|false The normalized hex code, or false on error.
     */
    function normalizeHex($colorCode)
    {
        $colorCode = trim($colorCode);
        if (strpos($colorCode, 'rgb') !== false) {
            preg_match_all('/\d+/', $colorCode, $matches);
            if (count($matches[0]) >= 3) {
                return rgbToHex($matches[0]);
            }
            return false;
        }

        if (strpos($colorCode, '#') === 0 && (strlen($colorCode) === 4 || strlen($colorCode) === 7)) {
            if (strlen($colorCode) === 4) {
                $colorCode = '#' . $colorCode[1] . $colorCode[1] . $colorCode[2] . $colorCode[2] . $colorCode[3] . $colorCode[3];
            }
            return $colorCode;
        }

        if (preg_match('/^[0-9a-fA-F]{3}$/', $colorCode)){
            return '#' . $colorCode[0] . $colorCode[0] . $colorCode[1] . $colorCode[1] . $colorCode[2] . $colorCode[2];
        }

        if (preg_match('/^[0-9a-fA-F]{6}$/', $colorCode)){
            return '#' . $colorCode;
        }

        return false;
    }

    /**
     * Converts a hex color code to RGB.
     *
     * @param string $hex The hex color code.
     *
     * @return array|false The RGB values, or false on error.
     */
    function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) !== 6) {
            return false;
        }
        $rgb = [];
        for ($i = 0; $i < 3; $i++) {
            $rgb[] = hexdec(substr($hex, $i * 2, 2));
        }
        return $rgb;
    }

    /**
     * Converts RGB values to a hex color code.
     *
     * @param array $rgb The RGB values.
     *
     * @return string The hex color code.
     */
    function rgbToHex($rgb)
    {
        $hex = '';
        foreach ($rgb as $value) {
            $hex .= str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }
        return $hex;
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
                     ->limit(intval(getConfigData("queryLimit200")))
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

if(!function_exists('getRecentActivityLogsInJson'))
{
    function getRecentActivityLogsInJson()
    {
        $tableName = "activity_logs";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(getConfigData("queryLimit200")))
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

if(!function_exists('getRecentVisitStats'))
{
    function getRecentVisitStats()
    {
        $tableName = "site_stats";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(getConfigData("queryLimit200")))
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

if(!function_exists('getRecentVisitStatsInJson'))
{
    function getRecentVisitStatsInJson()
    {
        $tableName = "site_stats";
        $db = \Config\Database::connect();
        $query = $db->table($tableName)
                     ->orderBy('created_at', 'DESC')
                     ->limit(intval(getConfigData("queryLimit200")))
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