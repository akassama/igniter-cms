<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PluginsController extends BaseController
{
    public function index()
    {
        $pluginDir = APPPATH . 'Plugins/';
        $plugins = [];

        if (is_dir($pluginDir)) {
            foreach (scandir($pluginDir) as $folder) {
                if ($folder === '.' || $folder === '..') {
                    continue;
                }

                $pluginPath = $pluginDir . $folder . '/plugin.json';
                if (is_file($pluginPath)) {
                    $json = file_get_contents($pluginPath);
                    $meta = json_decode($json, true);

                    if ($meta) {
                        $meta['folder'] = $folder; // Keep the folder name for reference
                        $plugins[] = $meta;
                    }
                }
            }
        }

        return view('back-end/plugins/index', ['plugins' => $plugins]);
    }

    public function installPlugins()
    {
        // Fetch plugins from API with better error handling
        $apiUrl = 'https://api.ignitercms.com/api/get-plugins/';
        $client = \Config\Services::curlrequest();
        
        // Try to get from cache first
        $cache = \Config\Services::cache();
        $plugins = $cache->get('plugins_list');
        
        if ($plugins === null) {
            try {
                $response = $client->get($apiUrl, [
                    'timeout' => 10,
                    'connect_timeout' => 5,
                    'verify' => false // Only for development, remove in production
                ]);
                
                if ($response->getStatusCode() !== 200) {
                    throw new \Exception('API returned status: '.$response->getStatusCode());
                }
                
                $result = json_decode($response->getBody(), true);
                
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON response');
                }
                
                if (!isset($result['status']) || $result['status'] !== 'success') {
                    throw new \Exception('API returned error: '.($result['message'] ?? 'Unknown error'));
                }
                
                $plugins = $result['data'] ?? [];
                $cache->save('plugins_list', $plugins, 3600); // Cache for 1 hour
            } catch (\Exception $e) {
                log_message('error', 'Failed to fetch plugins: '.$e->getMessage());
                
                // Fallback to local sample data if API fails
                $plugins = $this->getSamplePlugins();
                session()->setFlashdata('warning', 'Using cached plugin data. Could not connect to plugin repository.');
            }
        }
        
        $data = [
            'plugins' => $plugins,
            'has_error' => session()->getFlashdata('warning')
        ];
        
        return view('back-end/plugins/install-plugins', $data);
    }

    protected function getSamplePlugins()
    {
        return [
            [
                "name" => "SEO Optimizer",
                "description" => "Improves your website search engine optimization with advanced tools",
                "author" => "Ablie Kassama",
                "version" => "1.2.0",
                "plugin_url" => "https://example.com/plugins/seo-optimizer",
                "download_url" => "https://example.com/downloads/seo-optimizer.zip",
                "image" => "https://ps.w.org/mihdan-index-now/assets/icon.svg?rev=3190776",
                "last_updated" => "2023-10-15",
                "min_php_requirement" => "8.0",
                "min_igniter_requirement" => "1.0.0",
                "rating" => "4/5"
            ],
            [
                "name" => "Cache Manager",
                "description" => "Speeds up your website with advanced caching techniques",
                "author" => "Ablie Kassama",
                "version" => "2.1.3",
                "plugin_url" => "https://example.com/plugins/cache-manager",
                "download_url" => "https://example.com/downloads/cache-manager.zip",
                "image" => "https://ps.w.org/w3-total-cache/assets/icon-256x256.png?rev=1041806",
                "last_updated" => "2023-09-28",
                "min_php_requirement" => "7.4",
                "min_igniter_requirement" => "1.0.2",
                "rating" => "5/5",
            ],
            [
                "name" => "Security Scanner",
                "description" => "Protects your website from malware and security threats",
                "author" => "Ablie Kassama",
                "version" => "1.5.2",
                "plugin_url" => "https://example.com/plugins/security-scanner",
                "download_url" => "https://example.com/downloads/security-scanner.zip",
                "image" => "https://ps.w.org/security-malware-firewall/assets/icon-256x256.gif?rev=2295231",
                "last_updated" => "2023-11-05",
                "min_php_requirement" => "8.1",
                "min_igniter_requirement" => "1.0.1",
                "rating" => "4.5/5",
            ],
            [
                "name" => "Contact Form Pro",
                "description" => "Create beautiful contact forms with advanced features",
                "author" => "Ablie Kassama",
                "version" => "3.0.1",
                "plugin_url" => "https://example.com/plugins/contact-form-pro",
                "download_url" => "https://example.com/downloads/contact-form-pro.zip",
                "image" => "https://ps.w.org/ninja-forms/assets/icon-256x256.png?rev=1649747",
                "last_updated" => "2023-10-30",
                "min_php_requirement" => "8.0",
                "min_igniter_requirement" => "1.2.1",
                "rating" => "3/5",
            ]
        ];
    }

}
