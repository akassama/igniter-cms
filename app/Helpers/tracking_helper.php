<?php
use App\Models\BlogsModel;
use App\Models\CategoriesModel;

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
 * Checks if the given API request model is allowed.
 *
 * @param string $urlSegment The request segment (e.g., 'get-blog').
 * @return bool Returns true if the model is allowed, otherwise false.
 */
if (!function_exists('isAllowedModelRoute')) {
    function isAllowedModelRoute($urlSegment)
    {
        $allowedRoutes = array("get-model-data", "get-plugin-data", "add-plugin-data", "update-plugin-data", "delete-plugin-data");
        return in_array($urlSegment, $allowedRoutes);
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