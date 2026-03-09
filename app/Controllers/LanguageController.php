<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class LanguageController extends Controller
{
    /**
     * Switch language and redirect back
     *
     * @param string $locale
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function switch($locale)
    {
        $config = config('App');
        $session = Services::session();
        $response = Services::response();
        
        // Validate locale
        if (!in_array($locale, $config->supportedLocales)) {
            $locale = $config->defaultLocale;
        }
        
        // Set cookie using response object
        $response->setCookie(
            $config->localeCookieName,  // name
            $locale,                     // value
            $config->localeCookieExpires // expiration in seconds
        );
        
        // Store in session
        $session->set('locale', $locale);
        
        // Set current locale for this request
        Services::request()->setLocale($locale);
        
        // Redirect back to previous page
        return redirect()->back();
    }
}