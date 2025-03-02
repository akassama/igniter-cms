<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CorsFilter implements FilterInterface
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
        // Allow all origins (customize as needed)
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET"); // Allow GET. Modify accordingly (GET, POST, OPTIONS, PUT, DELETE)
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // Handle preflight requests
        if ($request->getMethod() === 'options') {
            exit;
        }

        // Restrict disallowed methods
        $allowedMethods = ['GET']; // Add allowed methods here.  Modify accordingly (GET, POST, OPTIONS, PUT, DELETE)
        $currentMethod = $request->getMethod(true); // Get method in uppercase

        if (!in_array($currentMethod, $allowedMethods)) {
            // Return a 405 Method Not Allowed response
            http_response_code(405);
            echo json_encode(['error' => 'Only GET and POST requests are allowed']);
            exit;
        }
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
        //
    }
}
