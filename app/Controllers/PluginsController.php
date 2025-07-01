<?php

namespace App\Controllers;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PluginsController extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

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

    public function managePlugin($slug)
    {
        $data = ['pluginName' => $slug];
        
        // Set the path to the plugin's manage file
        $manageFile = APPPATH . "Plugins/$slug/manage.php";
        
        // Store the file path in data (we'll check it in the view)
        $data['pluginManageFile'] = file_exists($manageFile) ? $manageFile : false;
        
        return view('back-end/plugins/manage-plugin', $data);
    }

    public function installPlugins()
    {
        $plugins = $this->getPluginsData();
        
        $data = [
            'plugins' => $plugins,
            'has_error' => session()->getFlashdata('warning')
        ];
        
        return view('back-end/plugins/install-plugins', $data);
    }
    

    public function uploadPlugin()
    {
        return view('back-end/plugins/upload-plugin');
    }

    public function addPlugin()
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $validation = \Config\Services::validation();

        // Validate the file upload
        $validation->setRules([
            'plugin_file' => [
                'label' => 'Plugin File',
                'rules' => 'uploaded[plugin_file]|ext_in[plugin_file,zip]|max_size[plugin_file,10240]', // 10MB max
                'errors' => [
                    'uploaded' => 'Please select a plugin file to upload',
                    'ext_in' => 'Only ZIP files are allowed',
                    'max_size' => 'Maximum file size is 10MB'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $pluginFile = $this->request->getFile('plugin_file');
        $override = boolval($this->request->getPost('override_if_exists'));

        if ($pluginFile->isValid() && !$pluginFile->hasMoved()) {
            // Get the filename without extension
            $filename = pathinfo($pluginFile->getName(), PATHINFO_FILENAME);
            $pluginDir = APPPATH . 'Plugins/' . $filename;

            // Check if plugin directory already exists
            if (is_dir($pluginDir)) {
                if (!$override) {
                    $alreadyExistMsg = config('CustomConfig')->alreadyExistMsg;
                    $alreadyExistMsg = str_replace('[Record]', 'Plugin', $alreadyExistMsg);
                    session()->setFlashdata('errorAlert', $alreadyExistMsg);
                    return redirect()->to('/account/plugins/upload-plugin');
                }
                
                // Remove existing directory recursively
                $this->deleteDirectory($pluginDir);
            }

            // Create plugins directory if it doesn't exist
            if (!is_dir(APPPATH . 'Plugins')) {
                mkdir(APPPATH . 'Plugins', 0755, true);
            }

            // Move the uploaded file to temp directory
            $tempPath = WRITEPATH . 'uploads/' . $pluginFile->store();
            
            // Extract the archive
            $zip = new \ZipArchive();
            if ($zip->open($tempPath)) {
                // Create plugin directory
                mkdir($pluginDir, 0755, true);
                
                // Extract files
                $zip->extractTo($pluginDir);
                $zip->close();
                
                // Delete the temp archive
                unlink($tempPath);
                
                // Verify the extracted structure
                if (!file_exists($pluginDir . '/manage.php')) {
                    $this->deleteDirectory($pluginDir);
                    session()->setFlashdata('errorAlert', 'Invalid plugin structure - manage.php not found');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Invalid plugin structure: ' . $filename);
                    return redirect()->to('/account/plugins/upload-plugin');
                }
                
                // Success
                session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin uploaded: ' . $filename);
                return redirect()->to('/account/plugins');
            } else {
                session()->setFlashdata('errorAlert', 'Failed to extract plugin archive');
                logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to extract plugin: ' . $filename);
                return redirect()->to('/account/plugins/upload-plugin');
            }
        } else {
            session()->setFlashdata('errorAlert', config('CustomConfig')->errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to upload plugin: ' . $pluginFile->getErrorString());
            return redirect()->to('/account/plugins/upload-plugin');
        }
    }

    /**
     * Helper method to recursively delete a directory
     */
    protected function deleteDirectory($dir) 
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    protected function getPluginsData()
    {
        //TODO - Implement
        return [
            [
                "name" => "Easy Hide Login",
                "description" => "Hide / file, prevent attacks on login form, hide login & increase security. No files are changed.",
                "author" => "Ablie Kassama",
                "version" => "1.0.0",
                "plugin_url" => "https://example.com/plugins/easy-hide-login",
                "download_url" => "https://ignitercms.com/plugins/easy-hide-login.zip",
                "image" => "https://ps.w.org/easy-hide-login/assets/icon-256x256.png",
                "last_updated" => "2023-10-15",
                "min_php_requirement" => "7.4",
                "min_igniter_requirement" => "1.0.0",
                "rating" => "4/5"
            ],
            [
                "name" => "SEO Optimizer",
                "description" => "Improves your website search engine optimization with advanced tools",
                "author" => "Ablie Kassama",
                "version" => "1.2.0",
                "plugin_url" => "https://example.com/plugins/seo-optimizer",
                "download_url" => "https://ignitercms.com/plugins/seo-optimizer.zip",
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
                "download_url" => "https://ignitercms.com/plugins/cache-manager.zip",
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
                "download_url" => "https://ignitercms.com/plugins/security-scanner.zip",
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
                "download_url" => "https://ignitercms.com/plugins/contact-form-pro.zip",
                "image" => "https://ps.w.org/ninja-forms/assets/icon-256x256.png?rev=1649747",
                "last_updated" => "2023-10-30",
                "min_php_requirement" => "8.0",
                "min_igniter_requirement" => "1.2.1",
                "rating" => "3/5",
            ]
        ];
    }

}
