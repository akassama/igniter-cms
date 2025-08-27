<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class AuthFilter implements FilterInterface
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
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the current URL
        $currentUrl = current_url();

        //check if blocked ip
        $ipAddress = getDeviceIP();
        if(isBlockedIP($ipAddress)){
            $response = service('response');
            $response->setStatusCode(403); // Forbidden status code
            $response->setBody('Your IP address has been blocked.');
            return $response;
        }

        // If no active session, try cookie
        if (!session()->get('is_logged_in')) {
            $cookieName = env('REMEMBER_ME_COOKIE');
            if (isset($_COOKIE[$cookieName])) {
                $cookieToken = $_COOKIE[$cookieName];

                $db = Database::connect();
                $builder = $db->table('users');
                $user = $builder->select('*')
                    ->where('remember_token', $cookieToken)
                    ->get()
                    ->getRow();

                if ($user && $user->expires_at > time()) {
                    // Valid cookie: log user back in
                    session()->set([
                        'user_id' => $user->user_id,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role,
                        'upload_directory' => $user->upload_directory,
                        'is_logged_in' => TRUE
                    ]);
                } else {
                    // Invalid/expired cookie → force sign-out
                    return redirect()->to('/sign-out');
                }
            } else {
                // No session, no cookie → redirect to login
                $encodedUrl = urlencode($currentUrl);
                return redirect()->to('/sign-in?returnUrl=' . $encodedUrl);
            }
        }

        //check if user exists even with session
        $userId = session()->get('user_id');
        if (!recordExists('users', 'user_id', $userId)) {
           // Redirect to the sign-out page to clear session
           return redirect()->to('/sign-out');
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
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
