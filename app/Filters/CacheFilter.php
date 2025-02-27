<?php
// Custom Optimization
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CacheFilter implements FilterInterface
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
        // No action needed before the controller is executed
        return $request;
    }

    /**
     * FilterClass to handle this system-wide
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
        // Only cache GET requests
        if ($request->getMethod() === 'get') {
            $cacheTimeout = isset($arguments[0]) ? $arguments[0] : 3600;
            
            $response->setHeader('Cache-Control', 'public, max-age=' . $cacheTimeout);
            $response->setHeader('Expires', gmdate('D, d M Y H:i:s', time() + $cacheTimeout) . ' GMT');
        } else {
            $response->setHeader('Cache-Control', 'no-store, max-age=0');
        }
        
        return $response;
    }
}
