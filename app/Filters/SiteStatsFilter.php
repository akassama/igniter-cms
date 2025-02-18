<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;

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

        //check if suspicius activity and add to block ip
        if(isBlockedRoute($pageVisitedUrl)){
            //log ip as black listed
            $reason = ActivityTypes::BLOCKED_IP_SUSPICIOUS_ACTIVITY;
            $blockEndTime = date('Y-m-d H:i:s', strtotime(getConfigData("BlockedIPSuspensionPeriod")));
            addBlockedIPAdress($ipAddress, $country, $pageVisitedUrl, $blockEndTime, $reason);

            //log activity
            logActivity("User IP: ".$ipAddress , $reason, 'Suspicious user activity with IP: ' . $ipAddress);
        }

        //check if blocked ip
        if(isBlockedIP($ipAddress)){
            $response = service('response');
            $response->setStatusCode(403); // Forbidden status code
            $response->setBody('Your IP address has been blocked.');
            return $response;
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed in the after filter
    }
}