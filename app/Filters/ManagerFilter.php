<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ManagerFilter implements FilterInterface
{
    /**
     * Manager filter before handler.
     * Checks if the user has the "Admin" or "Manager" role before proceeding.
     *
     * @param {RequestInterface} request - The request object.
     * @param {?Array} arguments - Additional arguments.
     * @returns {ResponseInterface|void} Redirects to "access denied" if not authorized.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user has the "Admin" or "Manager" role
        if (!session()->has('role') || session('role') !== 'Admin' || session('role') !== 'Manager') {
            return redirect()->to('account/access-denied');
        }
    }

    /**
     * Manager filter after handler.
     *
     * @param {RequestInterface} request - The request object.
     * @param {ResponseInterface} response - The response object.
     * @param {?Array} arguments - Additional arguments.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
    //
}
