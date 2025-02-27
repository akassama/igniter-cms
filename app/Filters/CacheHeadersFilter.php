<?php
// Custom Optimization
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CacheHeadersFilter implements FilterInterface
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
        // Default cache duration (in seconds)
        $duration = isset($arguments[0]) ? $arguments[0] : 3600;
        
        // Only cache GET requests
        if ($request->getMethod() === 'get') {
            // Parse the URI to determine content type
            $uri = $request->getUri()->getPath();
            $fileExt = pathinfo($uri, PATHINFO_EXTENSION);
            
            // Different cache settings based on content type
            switch ($fileExt) {
                case 'css':
                case 'js':
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'svg':
                case 'woff':
                case 'woff2':
                    // Long cache for static assets
                    $response->setHeader('Cache-Control', 'public, max-age=31536000'); // 1 year
                    break;
                    
                default:
                    // Check if we're requesting an API endpoint
                    if (strpos($uri, 'api') === 0) {
                        // Short cache for API responses
                        $response->setHeader('Cache-Control', 'public, max-age=60'); // 1 minute
                    } else {
                        // Standard cache for regular pages
                        $response->setHeader('Cache-Control', 'public, max-age=' . $duration);
                    }
                    break;
            }
            
            // Set expires header
            $response->setHeader('Expires', gmdate('D, d M Y H:i:s', time() + $duration) . ' GMT');
            
            // Set ETag for content validation
            $etag = md5($response->getBody());
            $response->setHeader('ETag', '"' . $etag . '"');
            
            // Check If-None-Match header
            $requestEtag = $request->getHeaderLine('If-None-Match');
            if ($requestEtag && $requestEtag === '"' . $etag . '"') {
                $response->setStatusCode(304); // Not Modified
                return $response;
            }
        } else {
            // No caching for non-GET requests
            $response->setHeader('Cache-Control', 'no-store, max-age=0');
        }
        
        return $response;
    }
}
