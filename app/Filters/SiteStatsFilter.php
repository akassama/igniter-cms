<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SiteStatsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $currentUrl = current_url();
        $ipAddress = getDeviceIP();
        $deviceType = getDeviceType();
        $browserName = getBrowserName();
        $pageType = getPageType($currentUrl);
        $pageVisitedId = getPageId($request->getUri());
        $pageVisitedUrl = $currentUrl;
        $referrer = getReferrer();
        $statusCode = http_response_code();
        $userId = getLoggedInUserId();
        $sessionId = session_id();
        $requestMethod = getReguestMethod();
        $operatingSystem = getOperatingSystem();
        $country = getCountry();
        $screenResolution = getScreenResolution(); //Set by using js-cookies with key "screen_resolution"
        $userAgent = getUserAgent();
        $otherParams = null;
        $logVisit = shouldLogVisit(current_url());

        if($logVisit){
            logSiteStatistic(
                $ipAddress,
                $deviceType,
                $browserName,
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
                $otherParams
            );
        }
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed in the after filter
    }
}