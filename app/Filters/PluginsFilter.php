<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PluginsFilter implements FilterInterface
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
        try {
            // Load before_filter plugin helpers for active plugins
            loadPlugin("before_filter");
        } catch (\Exception $e) {
            // Log error
            log_message('error', 'Failed to before_filter load plugins in filter: ' . $e->getMessage());
        }

        return null; // Continue processing the request
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
        try {
            // Load after_filter plugin helpers for active plugins
            loadPlugin("after_filter");
        } catch (\Exception $e) {
            // Log error
            log_message('error', 'Failed to load after_filter plugins in filter: ' . $e->getMessage());
        }

    }
}
