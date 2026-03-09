<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class LanguageFilter implements FilterInterface
{
    /**
     * This filter checks if a language cookie exists
     * and sets the appropriate locale
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        $config = config('App');
        
        // Get locale from cookie
        $locale = $request->getCookie($config->localeCookieName);
        
        // If no cookie, check session
        if (!$locale) {
            $locale = $session->get('locale');
        }
        
        // If still no locale, use default
        if (!$locale || !in_array($locale, $config->supportedLocales)) {
            $locale = $config->defaultLocale;
        }
        
        // Set the locale
        Services::request()->setLocale($locale);
        
        // Store in session for later use
        $session->set('locale', $locale);
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}