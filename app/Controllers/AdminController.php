<?php

namespace App\Controllers;

use CodeIgniter\Database\Database;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use App\Models\ConfigurationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\APIAccessModel;
use App\Models\BackupsModel;
use App\Models\ActivityLogsModel;
use App\Models\CodesModel;
use App\Models\SiteStatsModel;
use App\Models\BlockedIPsModel;
use App\Models\WhitelistedIPsModel;
use CodeIgniter\Database\BaseConnection;

class AdminController extends BaseController
{
    protected $session;
    protected $db;

    public function __construct()
    {
        $this->session = session();
        $this->db = \Config\Database::connect();
    }

    //############################//
    //           Admin            //
    //############################//
    
    public function index()
    {
        return view('back-end/admin/index');
    }

    //############################//
    //           Users            //
    //############################//
    public function users()
    {
        $tableName = 'users';
        $usersModel = new UsersModel();

        // Set data to pass in view
        $data = [
            'users' => $usersModel->orderBy('first_name', 'ASC')->findAll(),
            'total_users' => getTotalRecords($tableName)
        ];

        return view('back-end/admin/users/index', $data);
    }

    public function newUser()
    {
        return view('back-end/admin/users/new-user');
    }

    public function addUser()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the UsersModel
        $usersModel = new UsersModel();

        // Validation rules from the model
        $validationRules = $usersModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/users/new-user');
        }

        // If validation passes, create the user
        $userData = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => $this->request->getPost('status'),
            'role' => $this->request->getPost('role'),
            'profile_picture' => $this->request->getPost('profile_picture') ?? getDefaultProfileImagePath(),
            'twitter_link' => $this->request->getPost('twitter_link'),
            'facebook_link' => $this->request->getPost('facebook_link'),
            'instagram_link' => $this->request->getPost('instagram_link'),
            'linkedin_link' => $this->request->getPost('linkedin_link'),
            'about_summary' => $this->request->getPost('about_summary'),
            'password_change_required' => $this->request->getPost('password_change_required') ?? false,
        ];

        // Call createUser method from the UsersModel
        if ($usersModel->createUser($userData)) {
            //inserted user_id
            $insertedId = $usersModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'User', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::USER_CREATION, 'User created with id: ' . $insertedId);

            return redirect()->to('/account/admin/users');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_USER_CREATION, 'Failed to create user with email: ' . $this->request->getPost('email'));

            return view('back-end/admin/users/new-user');
        }
    }

    public function editUser($userId)
    {
        $usersModel = new UsersModel();

        // Fetch the data based on the id
        $user = $usersModel->where('user_id', $userId)->first();

        if (!$user) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/users');
        }

        // Set data to pass in view
        $data = [
            'user_data' => $user
        ];

        return view('back-end/admin/users/edit-user', $data);
    }

    public function updateUser()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $usersModel = new UsersModel();

        // Custom validation rules
        $rules = [
            'user_id' => 'required',
            'first_name' => 'required|max_length[50]|min_length[2]',
            'last_name' => 'required|max_length[50]|min_length[2]',
            'status' => 'required',
            'role' => 'required',
        ];

        $userId = $this->request->getPost('user_id');
        $data['user_data'] = $usersModel->where('user_id', $userId)->first();

        if($this->validate($rules)){
            $userId = $this->request->getPost('user_id');

            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'status'  => $this->request->getPost('status'),
                'role'  => $this->request->getPost('role'),
                'profile_picture' => $this->request->getPost('profile_picture') ?? getDefaultProfileImagePath(),
                'twitter_link' => $this->request->getPost('twitter_link'),
                'facebook_link' => $this->request->getPost('facebook_link'),
                'instagram_link' => $this->request->getPost('instagram_link'),
                'linkedin_link' => $this->request->getPost('linkedin_link'),
                'about_summary' => $this->request->getPost('about_summary'),
                'password_change_required' => $this->request->getPost('password_change_required') ?? false,
            ];

            $builder->where('user_id', $userId);
            $builder->update($data);

            // Record updated successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'User', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::USER_UPDATE, 'User updated with id: ' . $userId);

            return redirect()->to('/account/admin/users');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_USER_UPDATE, 'Failed to update user with id: ' . $userId);

            return view('back-end/admin/users/edit-user', $data);
        }
    }

    public function viewUser($userId)
    {
        $usersModel = new UsersModel();

        // Fetch the data based on the id
        $user = $usersModel->where('user_id', $userId)->first();

        if (!$user) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/users');
        }

        // Set data to pass in view
        $data = [
            'user_data' => $user
        ];

        return view('back-end/admin/users/view-user', $data);
    }

    //############################//
    //          API keys          //
    //############################//
    public function apiKeys()
    {
        $tableName = 'api_accesses';
        $apiKeysModel = new APIAccessModel();

        // Set data to pass in view
        $data = [
            'api_keys' => $apiKeysModel->orderBy('created_at', 'DESC')->findAll(),
            'total_api_keys' => getTotalRecords($tableName)
        ];

        return view('back-end/admin/api-keys/index', $data);
    }

    public function newApiKey()
    {
        return view('back-end/admin/api-keys/new-api-key');
    }

    public function addApiKey()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the APIAccessModel
        $apiKeysModel = new APIAccessModel();

        // Validation rules from the model
        $validationRules = $apiKeysModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/api-keys/new-api-key');
        }

        // If validation passes, create the key
        $data = [
            'api_key' => $this->request->getPost('api_key'),
            'assigned_to' => $this->request->getPost('assigned_to'),
            'status' => $this->request->getPost('status'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        // Call createApiAccessKey method from the APIAccessModel
        if ($apiKeysModel->createApiAccessKey($data)) {
            //inserted api_id
            $insertedId = $apiKeysModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'API Key', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::API_KEY_CREATION, 'ApiKey created with id: ' . $insertedId);

            return redirect()->to('/account/admin/api-keys');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_API_KEY_CREATION, 'Failed to create api-key with key: ' . $this->request->getPost('api_key'));

            return view('back-end/admin/api-keys/new-api-key');
        }
    }

    public function editApiKey($apiId)
    {
        $apiKeysModel = new APIAccessModel();

        // Fetch the data based on the id
        $apiKey = $apiKeysModel->where('api_id', $apiId)->first();

        if (!$apiKey) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/api-keys');
        }

        // Set data to pass in view
        $data = [
            'api_key_data' => $apiKey
        ];

        return view('back-end/admin/api-keys/edit-api-key', $data);
    }

    public function updateApiKey()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $apiKeysModel = new APIAccessModel();

        // Custom validation rules
        $rules = [
            'api_id' => 'required',
            'api_key' => 'required',
            'assigned_to' => 'required',
            'status' => 'required'
        ];

        $apiId = $this->request->getPost('api_id');
        $data['api_key_data'] = $apiKeysModel->where('api_id', $apiId)->first();

        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('api_accesses');
            $data = [
                'api_key' => $this->request->getPost('api_key'),
                'assigned_to' => $this->request->getPost('assigned_to'),
                'status' => $this->request->getPost('status'),
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $loggedInUserId
            ];

            $builder->where('api_id', $apiId);
            $builder->update($data);

            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'API Key', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::API_KEY_UPDATE, 'ApiKey updated with id: ' . $apiId);

            return redirect()->to('/account/admin/api-keys');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_API_KEY_UPDATE, 'Failed to update ApiKey with id: ' . $apiId);

            return view('back-end/admin/api-keys/edit-api-key', $data);
        }
    }

    //############################//
    //       Configurations       //
    //############################//
    public function configurations()
    {
        $tableName = 'configurations';
        $configModel = new ConfigurationsModel();

        // Set data to pass in view
        $data = [
            'configurations' => $configModel->orderBy('config_for', 'ASC')->findAll(),
            'total_configurations' => getTotalRecords($tableName)
        ];

        return view('back-end/admin/configurations/index', $data);
    }

    public function newConfiguration()
    {
        return view('back-end/admin/configurations/new-config');
    }

    public function addConfiguration()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the ConfigurationsModel
        $configModel = new ConfigurationsModel();

        // Validation rules from the model
        $validationRules = $configModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/configurations/new-config');
        }

        // If validation passes, create the config
        $dataType = $this->request->getPost('data_type') ;
        $configValue = $this->request->getPost('config_value') ?? $this->request->getPost('default_value');
        $configData = [
            'config_for' => removeTextSpace($this->request->getPost('config_for')),
            'description' => $this->request->getPost('description'),
            'config_value' => strtolower($dataType) === "secret" ? configDataEncryption($configValue) : $configValue,
            'group' => $this->request->getPost('group'),
            'icon' => $this->request->getPost('icon'),
            'data_type' => $dataType,
            'options' => $this->request->getPost('options'),
            'default_value' => $this->request->getPost('default_value'),
            'custom_class' => $this->request->getPost('custom_class'),
            'search_terms' => getCsvFromJsonList($this->request->getPost('search_terms')),
            'deletable' => $this->request->getPost('deletable') ?? 1,
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];
        
        // Call createConfiguration method from the ConfigModel
        if ($configModel->createConfiguration($configData)) {
            //inserted user_id
            $insertedId = $configModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Configuration', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::CONFIG_CREATION, 'Configuration created with id: ' . $insertedId);

            return redirect()->to('/account/admin/configurations');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONFIG_CREATION, 'Failed to create configuration with config_for: ' . $this->request->getPost('config_for'));

            return view('back-end/admin/configurations/new-config');
        }
    }

    public function viewConfiguration($configId)
    {
        $configModel = new ConfigurationsModel();

        // Fetch the data based on the id
        $configuration = $configModel->where('config_id', $configId)->first();

        if (!$configuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/configurations');
        }

        // Set data to pass in view
        $data = [
            'config_data' => $configuration
        ];

        return view('back-end/admin/configurations/view-config', $data);
    }

    public function editConfiguration($configId)
    {
        $configModel = new ConfigurationsModel();

        // Fetch the data based on the id
        $configuration = $configModel->where('config_id', $configId)->first();

        if (!$configuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/configurations');
        }

        // Set data to pass in view
        $data = [
            'config_data' => $configuration
        ];

        return view('back-end/admin/configurations/edit-config', $data);
    }

    public function updateConfiguration()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        $configModel = new ConfigurationsModel();

        // Custom validation rules
        $rules = [
            'config_id' => 'required',
            'config_for' => 'required',
            'config_value' => 'required',
        ];

        $configId = $this->request->getPost('config_id');
        $data['config_data'] = $configModel->where('config_id', $configId)->first();

        $dataType = $this->request->getPost('data_type') ;
        $configValue = $this->request->getPost('config_value') ?? $this->request->getPost('default_value');
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('configurations');
            $data = [
                'config_for' => removeTextSpace($this->request->getPost('config_for')),
                'description' => $this->request->getPost('description'),
                'config_value'  => strtolower($dataType) === "secret" ? configDataEncryption($configValue) : $configValue,
                'group' => $this->request->getPost('group'),
                'icon' => $this->request->getPost('icon'),
                'data_type' => $dataType,
                'options' => $this->request->getPost('options'),
                'default_value' => $this->request->getPost('default_value'),
                'custom_class' => $this->request->getPost('custom_class'),
                'search_terms' => getCsvFromJsonList($this->request->getPost('search_terms')),
                'deletable' => $this->request->getPost('deletable') ?? 1,
                'created_by' => $this->request->getPost('created_by'),
                'updated_by' => $loggedInUserId
            ];

            $builder->where('config_id', $configId);
            $builder->update($data);

            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'Configuration', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::CONFIG_UPDATE, 'Config updated with id: ' . $configId);

            return redirect()->to('/account/admin/configurations?dt-key='.$data["config_for"]);
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_CONFIG_UPDATE, 'Failed to update config with id: ' . $configId);

            return view('back-end/admin/configurations/edit-config', $data);
        }
    }

    //############################//
    //            Codes           //
    //############################//
    public function codes()
    {
        $tableName = 'codes';
        $codesModel = new CodesModel();
    
        // Set data to pass in view
        $data = [
            'codes' => $codesModel->orderBy('code_for', 'ASC')->findAll(),
            'total_codes' => getTotalRecords($tableName)
        ];
    
        return view('back-end/admin/codes/index', $data);
    }
    
    public function newCode()
    {
        return view('back-end/admin/codes/new-code');
    }
    
    public function addCode()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the CodesModel
        $codesModel = new CodesModel();
    
        // Validation rules from the model
        $validationRules = $codesModel->getValidationRules();
    
        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/codes/new-code');
        }
    
        // If validation passes, create the code
        $codeData = [
            'code_for' => $this->request->getPost('code_for'),
            'code' => $this->request->getPost('code'),
            'deletable' => 1,
            'created_by' => $loggedInUserId,
            'updated_by' => ""
        ];
    
        // Call createCode method from the CodeModel
        if ($codesModel->createCode($codeData)) {
            //inserted user_id
            $insertedId = $codesModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Code', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::CODE_CREATION, 'Code created with id: ' . $insertedId);
    
            return redirect()->to('/account/admin/codes');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_CODE_CREATION, 'Failed to create codeuration with code_for: ' .$this->request->getPost('code_for'));
    
            return view('back-end/admin/codes/new-code');
        }
    }
    
    public function editCode($codeId)
    {
        $codesModel = new CodesModel();
    
        // Fetch the data based on the id
        $codeuration = $codesModel->where('code_id', $codeId)->first();
    
        if (!$codeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/codes');
        }
    
        // Set data to pass in view
        $data = [
            'code_data' => $codeuration
        ];
    
        return view('back-end/admin/codes/edit-code', $data);
    }
    
    public function updateCode()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $codesModel = new CodesModel();
    
        // Custom validation rules
        $rules = [
            'code_id' => 'required',
            'code_for' => 'required',
            'code' => 'required',
        ];
    
        $codeId = $this->request->getPost('code_id');
        $data['code_data'] = $codesModel->where('code_id', $codeId)->first();
    
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('codes');
            $data = [
                'code_for' => $this->request->getPost('code_for'),
                'code'  => $this->request->getPost('code'),
                'deletable' => $this->request->getPost('deletable'),
            ];
    
            $builder->where('code_id', $codeId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $editSuccessMsg = str_replace('[Record]', 'Code', config('CustomConfig')->editSuccessMsg);
            session()->setFlashdata('successAlert', $editSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::CODE_UPDATE, 'Code updated with id: ' . $codeId);
    
            return redirect()->to('/account/admin/codes');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_CODE_UPDATE, 'Failed to update code with id: ' . $codeId);
    
            return view('back-end/admin/codes/edit-code', $data);
        }
    }

    //############################//
    //       Activity Logs        //
    //############################//
    public function activityLogs()
    {
        $tableName = 'activity_logs';
        $activityLogsModel = new ActivityLogsModel();

        // Set data to pass in view
        $data = [
            'activity_logs' => $activityLogsModel->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_MAX', 1000))),
            'pager' => $activityLogsModel->pager,
            'total_activities' => $activityLogsModel->pager->getTotal()
        ];

        return view('back-end/admin/activity-logs/index', $data);
    }

    public function viewActivity($activityId)
    {
        $activityLogsModel = new ActivityLogsModel();

        // Fetch the data based on the id
        $activity = $activityLogsModel->where('activity_id', $activityId)->first();

        if (!$activity) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/activity-logs');
        }

        // Set data to pass in view
        $data = [
            'activity_data' => $activity
        ];

        return view('back-end/admin/activity-logs/view-activity', $data);
    }

    //############################//
    //            Logs            //
    //############################//
    public function viewLogFiles()
    {
        // Path to the logs directory
        $logPath = WRITEPATH . 'logs/';

        // Get all log files
        $logFiles = glob($logPath . 'log-*.log');

        // Array to hold log data
        $logData = [];

        // Read each log file
        foreach ($logFiles as $file) {
            // Read the file content
            $fileContent = file_get_contents($file);

            // Split the content into individual log entries
            $logEntries = explode("\n", $fileContent);

            // Filter out empty entries
            $logEntries = array_filter($logEntries, function($entry) {
                return !empty(trim($entry));
            });

            // Parse and add the log entries to the log data array
            foreach ($logEntries as $entry) {
                if (preg_match('/^(.*?) - (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) --> (.*)$/', $entry, $matches)) {
                    $level = $matches[1];      // Log level (e.g., INFO, ERROR, CRITICAL)
                    $timestamp = $matches[2];  // Timestamp (e.g., 2025-02-10 16:36:40)
                    $message = $matches[3];    // Log message

                    // Add the parsed data to the log data array
                    $logData[] = [
                        'file' => basename($file),
                        'level' => $level,
                        'timestamp' => $timestamp,
                        'message' => $message
                    ];
                }
            }
        }

        // Sort log data by timestamp in descending order (most recent first)
        usort($logData, function($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });

        // Paginate the log data
        $pager = \Config\Services::pager();
        $perPage = 100; // Number of entries per page
        $currentPage = $this->request->getPost('page') ?? 1; // Get current page from query string

        // Slice the log data for the current page
        $totalEntries = count($logData);
        $paginatedData = array_slice($logData, ($currentPage - 1) * $perPage, $perPage);

        // Pass the paginated data and pager to the view
        $data['total_logs'] = $totalEntries;
        $data['logData'] = $paginatedData;
        $data['pager'] = $pager->makeLinks($currentPage, $perPage, $totalEntries, 'bootstrap'); // Use custom template

        return view('back-end/admin/logs/index', $data);
    }

    public function viewLogData($filename)
    {
        // Path to the logs directory
        $logPath = WRITEPATH . 'logs/';

        // Full path to the log file
        $logFile = $logPath . $filename;

        // Check if the file exists
        if (!file_exists($logFile)) {
            // If the file doesn't exist, show an error or redirect
            return redirect()->to('/account/admin/logs')->with('error', 'Log file not found.');
        }

        // Read the file content
        $logContent = file_get_contents($logFile);

        // Split the log content into individual entries
        $logEntries = explode("\n", $logContent);

        // Filter out empty entries
        $logEntries = array_filter($logEntries, function($entry) {
            return !empty(trim($entry));
        });

        // Pass the log data to the view
        $data['logEntries'] = $logEntries;
        $data['filename'] = $filename;

        return view('back-end/admin/logs/view-log', $data);
    }

    //############################//
    //        Site Stats          //
    //############################//
    public function viewStats()
    {
        $tableName = 'site_stats';
        $visitStatsModel = new SiteStatsModel();

        // Set data to pass in view
        $data = [
            'visit_stats' => $visitStatsModel->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_MAX', 1000))),
            'pager' => $visitStatsModel->pager,
            'total_stats' => $visitStatsModel->pager->getTotal()
        ];

        return view('back-end/admin/visit-stats/index', $data);
    }

    public function viewStat($visitId)
    {
        $visitStatsModel = new SiteStatsModel();

        // Fetch the data based on the id
        $visit = $visitStatsModel->where('site_stat_id', $visitId)->first();

        if (!$visit) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/visit-stats');
        }

        // Set data to pass in view
        $data = [
            'visit_data' => $visit
        ];

        return view('back-end/admin/visit-stats/view-stat', $data);
    }

    //############################//
    //       Blocked IPS          //
    //############################//
    public function blockedIps()
    {
        $tableName = 'blocked_ips';
        $blockedIPsModel = new BlockedIPsModel();

        // Set data to pass in view
        $data = [
            'blocked_ips' => $blockedIPsModel->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_VERY_HIGH', 100))),
            'pager' => $blockedIPsModel->pager,
            'total_blocked_ips' => $blockedIPsModel->pager->getTotal()
        ];

        return view('back-end/admin/blocked-ips/index', $data);
    }

    public function newBlockedIP()
    {
        return view('back-end/admin/blocked-ips/new-blocked-ip');
    }

    public function addBlockedIP()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the BlockedIPsModel
        $blockedIPsModel = new BlockedIPsModel();

        // Validation rules from the model
        $validationRules = $blockedIPsModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/blocked-ips/new-blocked-ip');
        }

        // If validation passes, create the user
        $blockedIPData = [
            'ip_address' => $this->request->getPost('ip_address'),
            'country' => $this->request->getPost('country'),
            'block_start_time' => $this->request->getPost('block_start_time'),
            'block_end_time' => $this->request->getPost('block_end_time'),
            'reason' => $this->request->getPost('reason'),
            'notes' => $this->request->getPost('notes'),
            'page_visited_url' => $this->request->getPost('page_visited_url')
        ];

        // Call createBlockedIP method from the BlockedIPsModel
        if ($blockedIPsModel->createBlockedIP($blockedIPData)) {
            //inserted user_id
            $insertedId = $blockedIPsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Blocked IP', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::BLOCKED_IP_CREATION, 'Blocked IP added with id: ' . $insertedId);

            return redirect()->to('/account/admin/blocked-ips');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_BLOCKED_IP_CREATION, 'Failed to add blocked IP with IP: ' . $this->request->getPost('ip_address'));

            return view('back-end/admin/blocked-ips/new-blocked-ip');
        }
    }

    //############################//
    //      Whitelisted IPS       //
    //############################//
    public function whitelistedIps()
    {
        $tableName = 'whitelisted_ips';
        $whitelistedIPsModel = new WhitelistedIPsModel();

        // Set data to pass in view
        $data = [
            'whitelisted_ips' => $whitelistedIPsModel->orderBy('created_at', 'DESC')->paginate(intval(env('QUERY_LIMIT_VERY_HIGH', 100))),
            'pager' => $whitelistedIPsModel->pager,
            'total_whitelisted_ips' => $whitelistedIPsModel->pager->getTotal()
        ];

        return view('back-end/admin/whitelisted-ips/index', $data);
    }

    public function newWhitelistedIP()
    {
        return view('back-end/admin/whitelisted-ips/new-whitelisted-ip');
    }

    public function addWhitelistedIP()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the WhitelistedIPsModel
        $whitelistedIPsModel = new WhitelistedIPsModel();

        // Validation rules from the model
        $validationRules = $whitelistedIPsModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/whitelisted-ips/new-whitelisted-ip');
        }

        // If validation passes, create the user
        $whitelistedIPData = [
            'ip_address' => $this->request->getPost('ip_address'),
            'reason' => $this->request->getPost('reason'),
        ];

        // Call createWhitelistedIP method from the WhitelistedIPsModel
        if ($whitelistedIPsModel->createWhitelistedIP($whitelistedIPData)) {
            //inserted user_id
            $insertedId = $whitelistedIPsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = str_replace('[Record]', 'Whitelisted IP', config('CustomConfig')->createSuccessMsg);
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::WHITELISTED_IP_CREATION, 'Whitelisted IP added with id: ' . $insertedId);

            return redirect()->to('/account/admin/whitelisted-ips');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_WHITELISTED_IP_CREATION, 'Failed to add whitelisted IP with IP: ' . $this->request->getPost('ip_address'));

            return view('back-end/admin/whitelisted-ips/new-whitelisted-ip');
        }
    }

    //############################//
    //          Backups           //
    //############################//
    public function backups()
    {
        $tableName = 'backups';
        $backupsModel = new BackupsModel();

        // Set data to pass in view
        $data = [
            'backups' => $backupsModel->orderBy('created_at', 'DESC')->findAll(),
            'total_backups' => getTotalRecords($tableName)
        ];

        return view('back-end/admin/backups/index', $data);
    }

    public function generateDbBackup()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the BackupsModel
        $backupsModel = new BackupsModel();

        try {
            // Get database configuration
            $hostname = env('database.default.hostname', 'localhost');
            $databaseName = env('database.default.database', 'igniter_cms_pro_db');
            
            // Generate file name with date and time
            $fileName = 'backup_' . date('Y-m-d_H-i-s') .'-'. rand(). '.sql';
            $filePath = WRITEPATH . 'backups/' . $fileName; // Save path in writable directory

            
            // Start output buffering
            ob_start();
            
            // Add SQL header comments
            echo "-- Database Backup\n";
            echo "-- Generated: " . date('Y-m-d H:i:s') . "\n";
            echo "-- Server: " . $hostname . "\n";
            echo "-- Database: " . $databaseName . "\n\n";
            
            // Get all tables
            $tables = $this->db->listTables();
            
            foreach ($tables as $table) {
                // Get create table syntax
                $query = $this->db->query("SHOW CREATE TABLE " . $this->db->escapeIdentifiers($table));
                $row = $query->getRow();
                
                if ($row) {
                    $createTableField = "Create Table";
                    echo "\n\n-- Table structure for table `" . $table . "`\n\n";
                    echo "DROP TABLE IF EXISTS `" . $table . "`;\n";
                    echo $row->$createTableField . ";\n\n";
                    
                    // Get table data
                    $query = $this->db->query("SELECT * FROM " . $this->db->escapeIdentifiers($table));
                    
                    if ($query->getNumRows() > 0) {
                        echo "-- Dumping data for table `" . $table . "`\n";
                        
                        foreach ($query->getResultArray() as $row) {
                            $fields = array_map(function($value) {
                                if ($value === null) {
                                    return 'NULL';
                                }
                                return $this->db->escape($value);
                            }, $row);
                            
                            echo "INSERT INTO `" . $table . "` VALUES (" . implode(', ', $fields) . ");\n";
                        }
                    }
                }
            }
            
            $backup = ob_get_clean();

            // Save the backup content to a file
            if (!is_dir(WRITEPATH . 'backups')) {
                mkdir(WRITEPATH . 'backups', 0777, true); // Create directory if not exists
            }
            file_put_contents($filePath, $backup);

            // Prepare data for insertion
            $data = [
                'backup_file_path' => $fileName,
                'created_by' => $loggedInUserId
            ];

            if ($backupsModel->createBackup($data)) {
                $insertedId = $backupsModel->getInsertID();
    
                // Record created successfully. Redirect to view
                $createSuccessMsg = str_replace('[Record]', 'Database Backup', config('CustomConfig')->createSuccessMsg);
                session()->setFlashdata('successAlert', $createSuccessMsg);
    
                //log activity
                logActivity($loggedInUserId, ActivityTypes::BACKUP_CREATION, 'Backup created with id: ' . $insertedId);
    
                return redirect()->to('/account/admin/backups');
            } else {
                // Failed to create record. Redirect to view
                $errorMsg = config('CustomConfig')->errorMsg;
                session()->setFlashdata('errorAlert', $errorMsg);
    
                //log activity
                logActivity($loggedInUserId, ActivityTypes::FAILED_BACKUP_CREATION, 'Failed to create backup.');
    
                return view('back-end/admin/backups');
            }
            
        } catch (\Exception $e) { 

            var_dump($e->getMessage());
            exit();
            // Set flash message and redirect
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            return redirect()->to('/account/admin/backups');
        }
    }

    public function downloadDbBackup($fileName)
    {
        // Path to the backup file in the writable directory
        $filePath = WRITEPATH . 'backups/' . $fileName;

        // Check if the file exists
        if (file_exists($filePath)) {
            // Use CodeIgniter's response to download the file
            return $this->response->download($filePath, null)->setFileName($fileName);
        } else {
            // File not found, set an error message
            session()->setFlashdata('errorAlert', 'Backup file not found.');
            return redirect()->to('/account/admin/backups');
        }
    }

    public function downloadPublicFolderBackup()
    {
        // Define the path to the public folder
        $publicFolderPath = FCPATH . 'public'; // FCPATH points to the root directory
    
        // Generate a unique name for the zip file
        $zipFileName = 'public_backup_' . date('Y-m-d_H-i-s') . '.zip';
        $zipFilePath = WRITEPATH . 'backups/' . $zipFileName;
    
        // Ensure the backups directory exists
        if (!is_dir(WRITEPATH . 'backups')) {
            mkdir(WRITEPATH . 'backups', 0777, true);
        }
    
        // Initialize the ZipArchive class
        $zip = new \ZipArchive();
    
        // Attempt to create the zip file
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            // Add the public folder contents to the zip file
            $this->addFolderToZip($publicFolderPath, $zip);
    
            // Close the zip file
            $zip->close();
    
            // Check if the zip file was created successfully
            if (file_exists($zipFilePath)) {
                // Use CodeIgniter's response to download the file
                return $this->response->download($zipFilePath, null)->setFileName($zipFileName);
            } else {
                // Handle error if the zip file could not be created
                session()->setFlashdata('errorAlert', 'Failed to create the public folder backup.');
                return redirect()->to('/account/admin/backups');
            }
        } else {
            // Handle error if the zip file could not be opened
            session()->setFlashdata('errorAlert', 'Failed to open the zip archive.');
            return redirect()->to('/account/admin/backups');
        }
    }
    
    /**
     * Helper function to recursively add folder contents to a zip archive.
     *
     * @param string $folderPath Path to the folder being added.
     * @param ZipArchive $zip ZipArchive instance.
     * @param string $parentFolder Parent folder path (used for recursion).
     */
    private function addFolderToZip($folderPath, $zip, $parentFolder = '')
    {
        // Open the folder
        $files = new \DirectoryIterator($folderPath);
    
        foreach ($files as $file) {
            // Skip "." and ".." directories
            if ($file->isDot()) {
                continue;
            }
    
            // Construct the full path and relative path
            $filePath = $file->getPathname();
            $relativePath = $parentFolder ? $parentFolder . '/' . $file->getFilename() : $file->getFilename();
    
            if ($file->isDir()) {
                // If it's a directory, add it to the zip and recurse into it
                $zip->addEmptyDir($relativePath);
                $this->addFolderToZip($filePath, $zip, $relativePath);
            } else {
                // If it's a file, add it to the zip
                $zip->addFile($filePath, $relativePath);
            }
        }
    }
}
