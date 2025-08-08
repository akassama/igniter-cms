<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ApiAccessFilter implements FilterInterface
{
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
        $currentUrl = current_url();
        $ipAddress = getDeviceIP();
        $deviceType = getDeviceType();
        $country = getCountry();
        $userAgent = getUserAgent();
        
        $checkApiKey = true;

        // Extract the API key from the second URL segment (immediately after 'api/')
        $uri = $request->getUri();
        $segments = $uri->getSegments();

        // The API key is the second segment (after 'api')
        $apiKey = $segments[1] ?? null;
        $resource = $segments[2] ?? null;

        // Validate the API key using the helper function
        if($checkApiKey){
            if (!$apiKey || !isValidApiKey($apiKey)) {
                return Services::response()
                    ->setStatusCode(401)
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'Invalid API key.'
                    ]);
            }
        }

        // Validate the API key using the helper function
        if($checkApiKey){
            if (!isAllowedModelRoute($resource)) {
                return Services::response()
                    ->setStatusCode(401)
                    ->setJSON([
                        'status' => 'error',
                        'message' => 'Invalid model access.'
                    ]);
            }
        }

        logApiCall(
            $apiKey,
            $ipAddress,
            $deviceType,
            $country,
            $userAgent
        );

        // Continue to the next filter or controller
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
