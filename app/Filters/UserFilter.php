<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UserFilter implements FilterInterface
{
    /**
     * User filter before handler.
     * Checks if the user has the "Admin", "Manager", or "User" role before proceeding.
     *
     * @param {RequestInterface} request - The request object.
     * @param {?Array} arguments - Additional arguments.
     * @returns {ResponseInterface|void} Redirects to "access denied" if not authorized.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user has the "Admin", "Manager", or "User" role
        if (!session()->has('role') || session('role') !== 'Admin' || session('role') !== 'Manager' || session('role') !== 'User') {
            return redirect()->to('account/access-denied');
        }
    }

    /**
     * User filter after handler.
     *
     * @param {RequestInterface} request - The request object.
     * @param {ResponseInterface} response - The response object.
     * @param {?Array} arguments - Additional arguments.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
