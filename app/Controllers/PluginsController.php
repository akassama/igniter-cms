<?php

namespace App\Controllers;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PluginConfigModel;
use ZipArchive;

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

    public function instructions($slug)
    {
        $instructionsPath = APPPATH . 'Plugins/' . $slug . '/instructions.php';
        if (is_file($instructionsPath)) {
            // Start output buffering to capture the instructions.php content
            ob_start();
            include $instructionsPath;
            $content = ob_get_clean();
            return $this->response->setJSON(['content' => $content]);
        } else {
            return $this->response->setJSON(['error' => 'Instructions not found'], 404);
        }
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
            $editSuccessMsg = str_replace('[Record]', 'Plugin Config', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
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
        // Get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        try {
            // Use for any return parameter
            $urlParameter = trim($this->request->getPost('plugin_url_parameter'));

            // Load the processor.php file for the plugin
            $processorFile = APPPATH . 'Plugins/' . $pluginKey . '/processor.php';
            if (!file_exists($processorFile)) {
                throw new \Exception("Processor file not found for plugin: {$pluginKey}");
            }

            // Include the processor file
            include_once $processorFile;

            // Convert pluginKey to a valid namespace (e.g., easy-hide-login to EasyHideLogin)
            $namespaceKey = str_replace('-', '', ucwords($pluginKey, '-'));
            $namespace = "Plugins\\{$namespaceKey}\\Processor";

            // Check if the processor class exists
            if (!class_exists($namespace)) {
                throw new \Exception("Processor class not found for plugin: {$pluginKey}");
            }

            // Instantiate the processor
            $processor = new $namespace();

            // Get all POST data
            $postData = $this->request->getPost();

            // Call the plugin's form processor method
            $processor->processPluginFormData($postData, $pluginKey);

            // Set flash message
            session()->setFlashdata('successAlert', 'Settings saved successfully.');

            logActivity($loggedInUserId, ActivityTypes::PLUGIN_UPDATE, "Plugin data for {$pluginKey} updated.");
        } catch (\Exception $e) {
            // Log error
            logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_UPDATE, "Plugin update data for {$pluginKey} failed: {$e->getMessage()}");
            log_message('error', "Failed to update data for plugin: {$pluginKey} - {$e->getMessage()}");
            session()->setFlashdata('errorAlert', 'Failed to save settings: ' . $e->getMessage());
        }

        // Redirect back to the same page
        if (!empty($urlParameter)) {
            return redirect()->to("/account/plugins/manage/{$pluginKey}?{$urlParameter}");
        }
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
                // Ensure the upload directory exists and is writable
                $uploadPath = WRITEPATH . 'uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $tempFilename = $pluginFile->getRandomName(); // Use a random name for security
                $pluginFile->move($uploadPath, $tempFilename); // Move the file
                $tempPath = $uploadPath . $tempFilename; // Get the full path
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin file moved to temp: ' . $tempPath);
            } catch (\Exception $e) {
                session()->setFlashdata('errorAlert', 'Failed to move uploaded file');
                logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Failed to move uploaded file: ' . $e->getMessage());
                return redirect()->to('/account/plugins/upload-plugin');
            }

            // Extract the archive
            $zip = new ZipArchive(); // Use ZipArchive directly
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
                        // Log this but don't fail the entire process, as extraction was successful.
                        log_message('warning', 'Failed to delete temporary archive: ' . $tempPath);
                    }
                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin extracted to: ' . $pluginDir);
                } catch (\Exception $e) {
                    if ($zip->status !== ZipArchive::ER_NOZIP) { // Only close if it was opened
                        $zip->close();
                    }
                    $this->deleteDirectory($pluginDir); // Clean up partially extracted plugin
                    // Attempt to delete the temp file if it still exists after extraction failure
                    if (file_exists($tempPath)) {
                        unlink($tempPath);
                    }
                    session()->setFlashdata('errorAlert', 'Failed during extraction: ' . $e->getMessage()); // Show specific error
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Extraction failed: ' . $filename . ' - ' . $e->getMessage());
                    return redirect()->to('/account/plugins/upload-plugin');
                }

                // Verify the extracted structure
                if (!file_exists($pluginDir . '/manage.php')) {
                    $this->deleteDirectory($pluginDir);
                    // Attempt to delete the temp file if it still exists
                    if (file_exists($tempPath)) {
                        unlink($tempPath);
                    }
                    session()->setFlashdata('errorAlert', 'Invalid plugin structure - manage.php not found. Make sure the plugin is at the root of the ZIP file.');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Invalid plugin structure: ' . $filename);
                    return redirect()->to('/account/plugins/upload-plugin');
                }

                // Check for database.php and execute queries if present
                $databaseFile = $pluginDir . '/database.php';
                if (file_exists($databaseFile)) {
                    // Initialize variables to avoid undefined variable errors
                    $createTablesQuery = '';
                    $createTableDataQuery = '';
                    $createConfigQuery = '';
                    $pluginKey = $filename; // Ensure pluginKey is set for database.php

                    // --- Sandboxed inclusion of database.php ---
                    $dbFileContent = file_get_contents($databaseFile);

                    // A very basic and limited parse to get the variables.
                    try {
                        // Start output buffering to prevent any accidental output from the included file
                        ob_start();
                        include $databaseFile; // This is the risky part; ensure variables are defined in that file.
                        ob_end_clean(); // Discard any output
                    } catch (\Throwable $e) { // Catch both Exceptions and Errors (like parse errors)
                        $this->deleteDirectory($pluginDir);
                        if (file_exists($tempPath)) {
                            unlink($tempPath);
                        }
                        session()->setFlashdata('errorAlert', 'Error parsing plugin database script: ' . $e->getMessage());
                        logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Error parsing database.php for plugin: ' . $filename . ' - ' . $e->getMessage());
                        return redirect()->to('/account/plugins/upload-plugin');
                    }
                    // --- END CRITICAL SECURITY ---

                    $db = \Config\Database::connect();

                    try {
                        // --- Check createTablesQuery table name prefix ---
                        if (!empty($createTablesQuery)) {
                            // Extract table name from createTablesQuery
                            if (preg_match('/CREATE TABLE\s+`?([a-zA-Z0-9_-]+)`?/i', $createTablesQuery, $matches)) {
                                $tableName = $matches[1];
                                if (!str_starts_with($tableName, 'icp_')) {
                                    throw new \Exception("Table name '$tableName' in createTablesQuery must start with 'icp_'.");
                                }
                                // Drop existing table if override is true
                                // And execute the query.
                                $db->query("DROP TABLE IF EXISTS `$tableName`"); // Use backticks for table name
                                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Dropped existing table: ' . $tableName);
                            } else {
                                // If CREATE TABLE syntax is unexpected, reject it.
                                throw new \Exception('Invalid or unrecognized CREATE TABLE statement in database.php.');
                            }

                            // Execute create tables query
                            // Split queries by semicolon, filter out empty ones
                            $queries = array_filter(array_map('trim', explode(';', $createTablesQuery)));
                            foreach ($queries as $query) {
                                if (!empty($query)) {
                                    // Basic validation that it's a DDL (Data Definition Language) statement.
                                    if (!preg_match('/^\s*(CREATE|ALTER|DROP|TRUNCATE)\s+/i', $query)) {
                                        throw new \Exception('Disallowed SQL command detected in createTablesQuery: ' . substr($query, 0, 50) . '...');
                                    }
                                    $db->query($query);
                                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Executed create table query for: ' . $filename);
                                }
                            }
                        }
                        // --- END PREFIX VALIDATION ---

                        // Execute plugin table data if existing
                        if (!empty($createTableDataQuery)) {
                            // Similar to above, validate insert queries more strictly
                            $queries = array_filter(array_map('trim', explode(';', $createTableDataQuery)));
                            foreach ($queries as $query) {
                                if (!empty($query)) {
                                    if (!preg_match('/^\s*(INSERT|UPDATE|DELETE)\s+/i', $query)) {
                                        throw new \Exception('Disallowed SQL command detected in createTableDataQuery: ' . substr($query, 0, 50) . '...');
                                    }
                                    $db->query($query);
                                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Executed insert table data query for: ' . $filename);
                                }
                            }
                        }

                        // Delete existing plugin_configs entries and execute config query if not empty
                        if (!empty($createConfigQuery)) {
                            // Ensure pluginKey is correctly escaped for the DELETE query
                            $db->query("DELETE FROM plugin_configs WHERE plugin_slug = ?", [$pluginKey]);
                            logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Deleted existing plugin_configs for: ' . $pluginKey);

                            $queries = array_filter(array_map('trim', explode(';', $createConfigQuery)));
                            foreach ($queries as $query) {
                                if (!empty($query)) {
                                    if (!preg_match('/^\s*(INSERT|UPDATE)\s+/i', $query)) {
                                        throw new \Exception('Disallowed SQL command detected in createConfigQuery: ' . substr($query, 0, 50) . '...');
                                    }
                                    $db->query($query);
                                    logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Executed config query for: ' . $filename);
                                }
                            }
                        }

                    } catch (\Exception $e) {
                        $this->deleteDirectory($pluginDir);
                        if (file_exists($tempPath)) {
                            unlink($tempPath);
                        }
                        session()->setFlashdata('errorAlert', 'Failed to execute database queries: ' . $e->getMessage()); // Display specific error
                        logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Database query failed for plugin: ' . $filename . ' - ' . $e->getMessage());
                        return redirect()->to('/account/plugins/upload-plugin');
                    }
                }

                // Success
                $createSuccessMsg = str_replace('[Record]', 'Plugin', config('CustomConfig')->createSuccessMsg);
                session()->setFlashdata('successAlert', $createSuccessMsg);
                logActivity($loggedInUserId, ActivityTypes::PLUGIN_CREATION, 'Plugin uploaded: ' . $filename);

                // Load plugin.json
                $loadPlugins = "";
                $pluginPath = $pluginDir . '/plugin.json';
                if (is_file($pluginPath)) {
                    $json = file_get_contents($pluginPath);
                    $meta = json_decode($json, true);
                    if ($meta && isset($meta['load'])) {
                        // Sanitize the 'load' value if it's meant to be a string path or class name
                        $loadPlugins = esc($meta['load']); // Basic string escape
                    }
                }

                // Add plugin to database
                $tableName = "plugins";
                $pluginsData = [
                    'plugin_id' => getGUID(),
                    'plugin_key' => $filename, // The filename is assumed to be safe (alpha-numeric with dashes/underscores)
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
                    $this->deleteDirectory($pluginDir); // Rollback: delete extracted files
                    if (file_exists($tempPath)) {
                        unlink($tempPath);
                    }
                    session()->setFlashdata('errorAlert', 'Failed to update plugin database record.');
                    logActivity($loggedInUserId, ActivityTypes::FAILED_PLUGIN_CREATION, 'Database record update failed: ' . $filename . ' - ' . $e->getMessage());
                    return redirect()->to('/account/plugins/upload-plugin');
                }

                return redirect()->to('/account/plugins');
            } else {
                // This 'else' block handles if $zip->open($tempPath) fails
                if (file_exists($tempPath)) {
                    unlink($tempPath); // Ensure temp file is removed
                }
                session()->setFlashdata('errorAlert', 'Failed to open plugin archive. It might be corrupted or not a valid ZIP file.');
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
        $url = 'https://ignitercms.com/plugins/';
        $json = @file_get_contents($url);

        if ($json === false) {
            // Handle error, maybe return an empty array or log the error
            return [];
        }

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return [];
        }

        return $data;
    }

}
