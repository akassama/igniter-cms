<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class RateLimitFilter implements FilterInterface
{
    protected $requestsPerMinute = 60; // Max requests per minute per IP
    protected $cache;

    public function __construct()
    {
        $this->cache = \Config\Services::cache();
    }

    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $ipAddress = $request->getIPAddress();
        $cacheKey = 'rate_limit_' . md5($ipAddress);
        $currentTime = time();
        $window = 60; // Time window in seconds (1 minute)

        // Get or initialize rate limit data
        $rateData = $this->cache->get($cacheKey);
        if (!$rateData) {
            $rateData = [
                'count' => 0,
                'start_time' => $currentTime
            ];
        }

        // Reset count if the time window has expired
        if ($currentTime - $rateData['start_time'] > $window) {
            $rateData = [
                'count' => 0,
                'start_time' => $currentTime
            ];
        }

        // Increment request count
        $rateData['count']++;

        // Check if limit is exceeded
        if ($rateData['count'] > $this->requestsPerMinute) {
            return Services::response()
                ->setStatusCode(429)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Rate limit exceeded. Please try again later.'
                ]);
        }

        // Save updated rate data
        $this->cache->save($cacheKey, $rateData, $window);

        return;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the response
    }
}