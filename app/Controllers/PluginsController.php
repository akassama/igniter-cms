<?php

namespace App\Controllers;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PluginConfigModel;

class PluginsController extends BaseController
{
    protected $session;
    public function __construct()
    {
        // Initialize session once in the constructor
        $this->session = session();
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

    public function pluginConfigurations()
    {
        $tableName = 'plugin_configs';
        $configModel = new PluginConfigModel();

        // Set data to pass in view
        $data = [
            'plugin_configs' => $configModel->orderBy('plugin_slug', 'ASC')->findAll(),
            'total_configurations' => getTotalRecords($tableName)
        ];


        return view('back-end/plugins/plugin-configurations', $data);
    }

    public function updatePluginConfig()
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $pluginId = $this->request->getPost('plugin_id');
        $configValue = $this->request->getPost('config_value');
        $configKey = $this->request->getPost('config_key');

        // Validate input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'plugin_id' => 'required',
            'config_key' => 'required',
            'config_value' => 'required'
        ]);

        if (!$validation->run([
            'plugin_id' => $pluginId,
            'config_key' => $configKey,
            'config_value' => $configValue
        ])) {
            session()->setFlashdata('errorAlert', 'Invalid input: ' . implode(', ', $validation->getErrors()));
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, 'Plugin config update failed: Invalid input');
            return redirect()->to('/account/plugins/configurations');
        }

        try {
            // Update plugin config
            $db = \Config\Database::connect();
            $db->query("UPDATE plugin_configs SET config_value = ? WHERE id = ?", [$configValue, $pluginId]);
            session()->setFlashdata('successAlert', config('CustomConfig')->editSuccessMsg);
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_UPDATE, 'Plugin config ' . $configKey . ' updated.');
        } catch (\Exception $e) {
            session()->setFlashdata('errorAlert', 'Failed to update plugin config: ' . $e->getMessage());
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, 'Plugin config ' . $configKey . ' update failed: ' . $e->getMessage());
        }
        return redirect()->to('/account/plugins/configurations');
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

    public function managePluginPost($pluginKey)
    {
        $loggedInUserId = $this->session->get('user_id');

        try {
            // Sanitize and validate input
            $uniqueId = trim($this->request->getPost('uniqueId'));
            $enableRedirect = (int) ($this->request->getPost('enableRedirect') !== null);
            $redirectUrl = filter_var(trim($this->request->getPost('redirectUrl')), FILTER_VALIDATE_URL) ? trim($this->request->getPost('redirectUrl')) : '';
            $customErrorMessage = trim($this->request->getPost('errorMessage'));

            if (empty($uniqueId)) {
                throw new \Exception("Unique ID is required.");
            }

            // Table name based on plugin key
            $configTableName = "icp_easy_hide_login_config";

            // Check if table exists
            $db = \Config\Database::connect();
            $tables = $db->listTables();
            if (!in_array($configTableName, $tables)) {
                throw new \Exception("Configuration table does not exist: {$configTableName}");
            }

            // Prepare data
            $data = [
                'unique_identifier' => $uniqueId,
                'enable_redirect'   => $enableRedirect,
                'redirect_url'      => $redirectUrl,
                'custom_error_message' => $customErrorMessage
            ];

            // Update the configuration table
            $db->table($configTableName)
            ->where('id IS NOT NULL')
            ->update($data);

            // Log success
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_UPDATE, "Updated data for plugin: {$pluginKey}");

            // Set flash message
            session()->setFlashdata('successAlert', 'Settings saved successfully.');
        } catch (\Exception $e) {
            // Log error
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, "Failed to update data for plugin: {$pluginKey} - " . $e->getMessage());
            session()->setFlashdata('errorAlert', 'Failed to save settings: ' . $e->getMessage());
        }

        // Redirect back to the same page
        return redirect()->to("/account/plugins/manage/{$pluginKey}");
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
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Validation failed: ' . implode(', ', $validation->getErrors()));
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
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Plugin already exists: ' . $filename);
                    return redirect()->to('/account/plugins/upload-plugin');
                }
                
                // Remove existing directory recursively
                try {
                    if (!$this->deleteDirectory($pluginDir)) {
                        throw new \Exception('Failed to delete existing plugin directory');
                    }
                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Existing plugin directory deleted: ' . $filename);
                } catch (\Exception $e) {
                    session()->setFlashdata('errorAlert', 'Failed to delete existing plugin directory');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to delete directory: ' . $filename . ' - ' . $e->getMessage());
                    return redirect()->to('/account/plugins/upload-plugin');
                }
            }

            // Create plugins directory if it doesn't exist
            if (!is_dir(APPPATH . 'Plugins')) {
                if (!mkdir(APPPATH . 'Plugins', 0755, true)) {
                    session()->setFlashdata('errorAlert', 'Failed to create Plugins directory');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to create Plugins directory');
                    return redirect()->to('/account/plugins/upload-plugin');
                }
            }

            // Move the uploaded file to temp directory
            try {
                $tempPath = WRITEPATH . 'uploads/' . $pluginFile->store();
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin file moved to temp: ' . $tempPath);
            } catch (\Exception $e) {
                session()->setFlashdata('errorAlert', 'Failed to move uploaded file');
                logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to move uploaded file: ' . $e->getMessage());
                return redirect()->to('/account/plugins/upload-plugin');
            }
            
            // Extract the archive
            $zip = new \ZipArchive();
            if ($zip->open($tempPath) === true) {
                try {
                    // Create plugin directory
                    if (!mkdir($pluginDir, 0755, true)) {
                        throw new \Exception('Failed to create plugin directory');
                    }
                    
                    // Extract files
                    if (!$zip->extractTo($pluginDir)) {
                        throw new \Exception('Failed to extract plugin archive');
                    }
                    $zip->close();
                    
                    // Delete the temp archive
                    if (!unlink($tempPath)) {
                        throw new \Exception('Failed to delete temporary archive');
                    }
                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin extracted to: ' . $pluginDir);
                } catch (\Exception $e) {
                    $zip->close();
                    $this->deleteDirectory($pluginDir);
                    session()->setFlashdata('errorAlert', 'Failed during extraction');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Extraction failed: ' . $filename . ' - ' . $e->getMessage());
                    return redirect()->to('/account/plugins/upload-plugin');
                }
                
                // Verify the extracted structure
                if (!file_exists($pluginDir . '/manage.php')) {
                    $this->deleteDirectory($pluginDir);
                    session()->setFlashdata('errorAlert', 'Invalid plugin structure - manage.php not found');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Invalid plugin structure: ' . $filename);
                    return redirect()->to('/account/plugins/upload-plugin');
                }

                // Check for database.php and execute queries if present
                $databaseFile = $pluginDir . '/database.php';
                if (file_exists($databaseFile)) {
                    // Initialize variables to avoid undefined variable errors
                    $createTablesQuery = '';
                    $createConfigQuery = '';
                    $pluginKey = $filename; // Ensure pluginKey is set for database.php
                    
                    // Include database.php
                    include $databaseFile;
                    $db = \Config\Database::connect();

                    try {
                        // Drop existing table if createTablesQuery is not empty
                        if (!empty($createTablesQuery)) {
                            // Extract table name from createTablesQuery (assumes single CREATE TABLE statement)
                            if (preg_match('/CREATE TABLE\s+([^\s\(]+)/i', $createTablesQuery, $matches)) {
                                $tableName = trim($matches[1], '`');
                                $db->query("DROP TABLE IF EXISTS `$tableName`");
                                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Dropped existing table: ' . $tableName);
                            }
                            
                            // Execute create tables query
                            $queries = array_filter(array_map('trim', explode(';', $createTablesQuery)));
                            foreach ($queries as $query) {
                                if (!empty($query)) {
                                    $db->query($query);
                                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Executed create table query for: ' . $filename);
                                }
                            }
                        }

                        // Delete existing plugin_configs entries and execute config query if not empty
                        if (!empty($createConfigQuery)) {
                            $db->query("DELETE FROM plugin_configs WHERE plugin_slug = ?", [$pluginKey]);
                            logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Deleted existing plugin_configs for: ' . $pluginKey);
                            
                            $queries = array_filter(array_map('trim', explode(';', $createConfigQuery)));
                            foreach ($queries as $query) {
                                if (!empty($query)) {
                                    $db->query($query);
                                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Executed config query for: ' . $filename);
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        $this->deleteDirectory($pluginDir);
                        session()->setFlashdata('errorAlert', 'Failed to execute database queries');
                        logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Database query failed for plugin: ' . $filename . ' - ' . $e->getMessage());
                        return redirect()->to('/account/plugins/upload-plugin');
                    }
                }
                
                // Success
                session()->setFlashdata('successAlert', config('CustomConfig')->createSuccessMsg);
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin uploaded: ' . $filename);

                // Load plugin.json
                $loadPlugins = "";
                $pluginPath = $pluginDir . '/plugin.json';
                if (is_file($pluginPath)) {
                    $json = file_get_contents($pluginPath);
                    $meta = json_decode($json, true);
                    if ($meta && isset($meta['load'])) {
                        $loadPlugins = $meta['load'];
                    }
                }

                // Add plugin to database
                $tableName = "plugins";
                $pluginsData = [
                    'plugin_id' => getGUID(),
                    'plugin_key' => $filename,
                    'status' => 0,
                    'update_available' => 0,
                    'load' => $loadPlugins,
                    'created_by' => $loggedInUserId,
                    'updated_by' => null
                ];
                try {
                    $pluginExists = recordExists($tableName, 'plugin_key', $filename);
                    if ($pluginExists) {
                        deleteRecord($tableName, 'plugin_key', $filename);
                    }
                    addRecord($tableName, $pluginsData);
                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin added to database: ' . $filename);
                } catch (\Exception $e) {
                    $this->deleteDirectory($pluginDir);
                    session()->setFlashdata('errorAlert', 'Failed to update plugin database');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Database update failed: ' . $filename . ' - ' . $e->getMessage());
                    return redirect()->to('/account/plugins/upload-plugin');
                }

                return redirect()->to('/account/plugins');
            } else {
                session()->setFlashdata('errorAlert', 'Failed to open plugin archive');
                logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to open plugin archive: ' . $filename);
                return redirect()->to('/account/plugins/upload-plugin');
            }
        } else {
            $errorMsg = $pluginFile->getErrorString() ?: config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to upload plugin: ' . $errorMsg);
            return redirect()->to('/account/plugins/upload-plugin');
        }
    }

    public function activatePlugin($pluginSlug)
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        try {
            //activate plugin
            $updateColumn =  "'status' = '1'";
            $updateWhereClause = "plugin_key = '$pluginSlug'";
            $result = updateRecordColumn("plugins", $updateColumn, $updateWhereClause);
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_UPDATE, 'Plugin ' . $pluginSlug . ' activated.');
        } catch (\Exception $e) {
            session()->setFlashdata('errorAlert', 'Failed to activate plugin');
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, 'Plugin ' . $pluginSlug . ' activation failed: - ' . $e->getMessage());
        }
        return redirect()->to('/account/plugins');
    }

    public function deactivatePlugin($pluginSlug)
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        try {
            //deactivate plugin
            $updateColumn =  "'status' = '0'";
            $updateWhereClause = "plugin_key = '$pluginSlug'";
            $result = updateRecordColumn("plugins", $updateColumn, $updateWhereClause);
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_UPDATE, 'Plugin ' . $pluginSlug . ' deactivated.');
        } catch (\Exception $e) {
            session()->setFlashdata('errorAlert', 'Failed to deactivate plugin');
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, 'Plugin ' . $pluginSlug . ' deactivation failed: - ' . $e->getMessage());
        }
        return redirect()->to('/account/plugins');
    }

    public function deletePlugin()
    {
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
        $pluginKey = $this->request->getPost('plugin_key');

        if (empty($pluginKey)) {
            session()->setFlashdata('errorAlert', 'No plugin key provided');
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, 'No plugin key provided');
            return redirect()->to('/account/plugins');
        }

        try {
            $pluginDir = APPPATH . 'Plugins/' . $pluginKey;
            $db = \Config\Database::connect();

            // Drop tables defined in database.php
            $databaseFile = $pluginDir . '/database.php';
            if (file_exists($databaseFile)) {
                $createTablesQuery = '';
                $pluginKey = $pluginKey; // Ensure pluginKey is available in database.php
                include $databaseFile;

                if (!empty($createTablesQuery)) {
                    // Extract table names from createTablesQuery
                    $tableNames = [];
                    preg_match_all('/CREATE TABLE\s+([^\s\(]+)/i', $createTablesQuery, $matches);
                    if (!empty($matches[1])) {
                        $tableNames = array_map('trim', $matches[1]);
                        $tableNames = array_map(function($name) { return trim($name, '`'); }, $tableNames);
                    }

                    foreach ($tableNames as $tableName) {
                        $db->query("DROP TABLE IF EXISTS `$tableName`");
                        logActivity($loggedInUserId, ActivityTypes::PLUGIN_DELETION, 'Dropped table: ' . $tableName . ' for plugin: ' . $pluginKey);
                    }
                }
            }

            // Delete plugin_configs entries
            $db->query("DELETE FROM plugin_configs WHERE plugin_slug = ?", [$pluginKey]);
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_DELETION, 'Deleted plugin_configs for: ' . $pluginKey);

            // Delete plugin record
            deleteRecord("plugins", "plugin_key", $pluginKey);
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_DELETION, 'Deleted plugin record: ' . $pluginKey);

            // Delete plugin directory
            if (is_dir($pluginDir)) {
                if (!$this->deleteDirectory($pluginDir)) {
                    throw new \Exception('Failed to delete plugin directory');
                }
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_DELETION, 'Deleted plugin directory: ' . $pluginDir);
            }

            session()->setFlashdata('successAlert', 'Plugin ' . $pluginKey . ' deleted successfully');
            logActivity($loggedInUserId, ActivityTypes::PLUGIN_DELETION, 'Plugin ' . $pluginKey . ' deleted.');

        } catch (\Exception $e) {
            session()->setFlashdata('errorAlert', 'Failed to delete plugin: ' . $e->getMessage());
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_DELETION, 'Plugin ' . $pluginKey . ' deletion failed: ' . $e->getMessage());
        }

        return redirect()->to('/account/plugins');
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
                "slug" => "easy-hide-login",
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
                "slug" => "seo-optimizer",
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
                "slug" => "cache-manager",
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
                "slug" => "security-scanner",
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
                "slug" => "contact-form-pro",
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
