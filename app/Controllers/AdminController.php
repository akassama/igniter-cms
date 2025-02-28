<?php

namespace App\Controllers;

use CodeIgniter\Database\Database;
use App\Constants\ActivityTypes;
use App\Controllers\BaseController;
use App\Models\ConfigurationsModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\TranslationsModel;
use App\Models\APIAccessModel;
use App\Models\BackupsModel;
use App\Models\ActivityLogsModel;
use App\Models\CodesModel;
use App\Models\ThemesModel;
use App\Models\SubscribersModel;
use App\Models\ContactMessagesModel;
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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

        $userId = $this->request->getVar('user_id');
        $data['user_data'] = $usersModel->where('user_id', $userId)->first();

        if($this->validate($rules)){
            $userId = $this->request->getVar('user_id');

            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $data = [
                'first_name' => $this->request->getVar('first_name'),
                'last_name'  => $this->request->getVar('last_name'),
                'status'  => $this->request->getVar('status'),
                'role'  => $this->request->getVar('role'),
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
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
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
    //        Subscribers         //
    //############################//
    public function subscribers()
    {
        $tableName = 'subscribers';
        $subscribersModel = new SubscribersModel();

        // Set data to pass in view
        $data = [
            'subscribers' => $subscribersModel->orderBy('created_at', 'DESC')->paginate(500),
            'pager' => $subscribersModel->pager,
            'total_subscribers' => $subscribersModel->pager->getTotal()
        ];

        return view('back-end/admin/subscribers/index', $data);
    }
    
    //############################//
    //     Contact Messages       //
    //############################//
    public function contactMessages()
    {
        $tableName = 'contact_messages';
        $contactMessagesModel = new ContactMessagesModel();

        // Set data to pass in view
        $data = [
            'contact_messages' => $contactMessagesModel->orderBy('created_at', 'DESC')->paginate(500),
            'pager' => $contactMessagesModel->pager,
            'total_contact_messages' => $contactMessagesModel->pager->getTotal()
        ];

        return view('back-end/admin/contact-messages/index', $data);
    }

    public function viewContactMessage($contactMessageId)
    {
        //mark as read
        $updateColumn =  "'is_read' = '1'";
        $updateWhereClause = "contact_message_id = '$contactMessageId'";
        $result = updateRecordColumn("contact_messages", $updateColumn, $updateWhereClause);

        $contactMessagesModel = new ContactMessagesModel();

        // Fetch the data based on the id
        $contactMessage = $contactMessagesModel->where('contact_message_id', $contactMessageId)->first();

        if (!$contactMessage) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/contact-messages');
        }

        // Set data to pass in view
        $data = [
            'contact_message_data' => $contactMessage
        ];

        return view('back-end/admin/contact-messages/view-contact', $data);
    }

    //############################//
    //        Translations        //
    //############################//
    public function translations()
    {
        $tableName = 'translations';
        $translationsModel = new TranslationsModel();

        // Set data to pass in view
        $data = [
            'translations' => $translationsModel->orderBy('language', 'ASC')->findAll(),
            'total_translations' => getTotalRecords($tableName)
        ];

        return view('back-end/admin/translations/index', $data);
    }

    public function newTranslation()
    {
        return view('back-end/admin/translations/new-translation');
    }

    public function addTranslation()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the TranslationsModel
        $translationsModel = new TranslationsModel();

        // Validation rules from the model
        $validationRules = $translationsModel->getValidationRules();

        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/translations/new-translation');
        }

        // If validation passes, create the translation
        $translationData = [
            'language' => $this->request->getPost('language'),
            'created_by' => $loggedInUserId
        ];

        // Call createTranslation method from the TranslationsModel
        if ($translationsModel->createTranslation($translationData)) {
            //inserted translation_id
            $insertedId = $translationsModel->getInsertID();

            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::USER_CREATION, 'Translation created with id: ' . $insertedId);

            return redirect()->to('/account/admin/translations');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_USER_CREATION, 'Failed to create translation with language: ' . $this->request->getPost('language'));

            return view('back-end/admin/translations/new-translation');
        }
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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

        $apiId = $this->request->getVar('api_id');
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
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

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
        $configData = [
            'config_for' => removeTextSpace($this->request->getPost('config_for')),
            'description' => $this->request->getPost('description'),
            'config_value' => $this->request->getPost('config_value') ?? $this->request->getPost('default_value'),
            'group' => $this->request->getPost('group'),
            'icon' => $this->request->getPost('icon'),
            'data_type' => $this->request->getPost('data_type'),
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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

        $configId = $this->request->getVar('config_id');
        $data['config_data'] = $configModel->where('config_id', $configId)->first();

        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('configurations');
            $data = [
                'config_for' => removeTextSpace($this->request->getVar('config_for')),
                'description' => $this->request->getPost('description'),
                'config_value'  => $this->request->getVar('config_value') ?? $this->request->getPost('default_value'),
                'group' => $this->request->getPost('group'),
                'icon' => $this->request->getPost('icon'),
                'data_type' => $this->request->getPost('data_type'),
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
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);

            //log activity
            logActivity($loggedInUserId, ActivityTypes::CONFIG_UPDATE, 'Config updated with id: ' . $configId);

            return redirect()->to('/account/admin/configurations');
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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
    
        $codeId = $this->request->getVar('code_id');
        $data['code_data'] = $codesModel->where('code_id', $codeId)->first();
    
        if($this->validate($rules)){
            $db = \Config\Database::connect();
            $builder = $db->table('codes');
            $data = [
                'code_for' => $this->request->getVar('code_for'),
                'code'  => $this->request->getVar('code'),
                'deletable' => $this->request->getPost('deletable'),
            ];
    
            $builder->where('code_id', $codeId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
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
    //           Themes           //
    //############################//
    public function themes()
    {
        $tableName = 'themes';
        $themesModel = new ThemesModel();
    
        // Set data to pass in view
        $data = [
            'themes' => $themesModel->orderBy('name', 'ASC')->findAll(),
            'total_themes' => getTotalRecords($tableName)
        ];
    
        return view('back-end/admin/themes/index', $data);
    }
    
    public function newTheme()
    {
        return view('back-end/admin/themes/new-theme');
    }
    
    public function addTheme()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        // Load the ThemesModel
        $themesModel = new ThemesModel();
    
        // Validation rules from the model
        $validationRules = $themesModel->getValidationRules();
    
        // Validate the incoming data
        if (!$this->validate($validationRules)) {
            // If validation fails, return validation errors
            $data['validation'] = $this->validator;
            return view('back-end/admin/themes/new-theme');
        }

        // If validation passes, create the theme
        $themeData = [
            'name' => $this->request->getPost('name'),
            'path' => $this->request->getPost('path'),
            'primary_color'  => $this->request->getVar('primary_color'),
            'secondary_color'  => $this->request->getVar('secondary_color'),
            'other_color'  => $this->request->getVar('other_color'),
            'image'  => $this->request->getVar('image'),
            'theme_url'  => $this->request->getVar('theme_url'),
            'footer_copyright'  => $this->request->getVar('footer_copyright'),
            'category'  => $this->request->getVar('category'),
            'sub_category'  => $this->request->getVar('sub_category'),
            'selected'  => $this->request->getVar('selected') ?? 0,
            'deletable' => $this->request->getVar('deletable') ?? 1,
            'home_page'  => $this->request->getVar('home_page'),
            'created_by' => $loggedInUserId,
            'updated_by' => null
        ];

        //if selected, set the rest as not selected
        if($themeData["selected"] == "1"){
            $updatedData = [
                'selected' => 0
            ];

            $updateWhereClause = "theme_id != 'NULL'";

            updateRecord('themes', $updatedData, $updateWhereClause);
        }
    
        // Call createTheme method from the ThemeModel
        if ($themesModel->createTheme($themeData)) {
            //inserted user_id
            $insertedId = $themesModel->getInsertID();
    
            // Record created successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::THEME_CREATION, 'Theme created with id: ' . $insertedId);
    
            return redirect()->to('/account/admin/themes');
        } else {
            // Failed to create record. Redirect to dashboard
            $errorMsg = config('CustomConfig')->errorMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_CREATION, 'Failed to create themeuration with name: ' . $this->request->getPost('name'));
    
            return view('back-end/admin/themes/new-theme');
        }
    }
    
    public function editTheme($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeuration = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeuration
        ];
    
        return view('back-end/admin/themes/edit-theme', $data);
    }
    
    public function updateTheme()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');
    
        $themesModel = new ThemesModel();
    
        // Custom validation rules
        $rules = [
            'theme_id' => 'required',
            'name' => 'required',
            'path' => 'required',
        ];
    
        $themeId = $this->request->getVar('theme_id');
        $data['theme_data'] = $themesModel->where('theme_id', $themeId)->first();
    
        if($this->validate($rules)){       

            //if selected, set the rest as not selected
            if($this->request->getVar('selected') == "1"){
                $updatedData = [
                    'selected' => 0
                ];

                $updateWhereClause = "theme_id != 'NULL'";

                updateRecord('themes', $updatedData, $updateWhereClause);
            }

            $db = \Config\Database::connect();
            $builder = $db->table('themes');
            $data = [
                'name' => $this->request->getVar('name'),
                'path'  => $this->request->getVar('path'),
                'primary_color'  => $this->request->getVar('primary_color'),
                'secondary_color'  => $this->request->getVar('secondary_color'),
                'other_color'  => $this->request->getVar('other_color'),
                'image'  => $this->request->getVar('image'),
                'theme_url'  => $this->request->getVar('theme_url'),
                'footer_copyright'  => $this->request->getVar('footer_copyright'),
                'category'  => $this->request->getVar('category'),
                'sub_category'  => $this->request->getVar('sub_category'),
                'selected'  => $this->request->getVar('selected') ?? 0,
                'deletable' => $this->request->getVar('deletable') ?? 1,
                'home_page'  => $this->request->getVar('home_page'),
                'created_by' => $this->request->getVar('created_by'),
                'updated_by' => $loggedInUserId
            ];
    
            $builder->where('theme_id', $themeId);
            $builder->update($data);
    
            // Record updated successfully. Redirect to dashboard
            $createSuccessMsg = config('CustomConfig')->editSuccessMsg;
            session()->setFlashdata('successAlert', $createSuccessMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::THEME_UPDATE, 'Theme updated with id: ' . $themeId);
    
            return redirect()->to('/account/admin/themes');
        }
        else{
            $data['validation'] = $this->validator;
            $errorMsg = config('CustomConfig')->missingRequiredInputsMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
    
            //log activity
            logActivity($loggedInUserId, ActivityTypes::FAILED_THEME_UPDATE, 'Failed to update theme with name: ' . $this->request->getPost('name'));
    
            return view('back-end/admin/themes/edit-theme', $data);
        }
    }
    
    public function editThemeHomePage($themeId)
    {
        $themesModel = new ThemesModel();
    
        // Fetch the data based on the id
        $themeuration = $themesModel->where('theme_id', $themeId)->first();
    
        if (!$themeuration) {
            $errorMsg = config('CustomConfig')->notFoundMsg;
            session()->setFlashdata('errorAlert', $errorMsg);
            return redirect()->to('/account/admin/themes');
        }
    
        // Set data to pass in view
        $data = [
            'theme_data' => $themeuration
        ];
    
        return view('back-end/admin/themes/edit-theme-home-page', $data);
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
            'activity_logs' => $activityLogsModel->orderBy('created_at', 'DESC')->paginate(1000),
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
        $perPage = 50; // Number of entries per page
        $currentPage = $this->request->getVar('page') ?? 1; // Get current page from query string

        // Slice the log data for the current page
        $totalEntries = count($logData);
        $paginatedData = array_slice($logData, ($currentPage - 1) * $perPage, $perPage);

        // Pass the paginated data and pager to the view
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
            'visit_stats' => $visitStatsModel->orderBy('created_at', 'DESC')->paginate(1000),
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
            'blocked_ips' => $blockedIPsModel->orderBy('created_at', 'DESC')->paginate(100),
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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
            'whitelisted_ips' => $whitelistedIPsModel->orderBy('created_at', 'DESC')->paginate(100),
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
            $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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

    public function generateBackup()
    {
        //get logged-in user id
        $loggedInUserId = $this->session->get('user_id');

        // Load the BackupsModel
        $backupsModel = new BackupsModel();

        try {
            // Get database configuration
            $hostname = config('CustomConfig')->hostname;
            $databaseName = config('CustomConfig')->database;
            
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
                $createSuccessMsg = config('CustomConfig')->createSuccessMsg;
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

    public function downloadBackup($fileName)
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

    //############################//
    //        Theme Files         //
    //############################//
    public function viewFiles()
    {
        return view('back-end/admin/file-editor/index');
    }

    public function homeFileEditor()
    {
        // Get the file you want to edit
        $homeFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/home/index.php';
        
        // Get only the file name (not the whole path) to display it
        $homeFilename = basename($homeFilePath);

        if (!file_exists($homeFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $homeFileContent = file_get_contents($homeFilePath);
        
        $data = [
            'homeFilename' => $homeFilename, // This is just for display
            'homeFilePath' => $homeFilePath,  // This is used for saving the file
            'homeFileContent' => $homeFileContent
        ];

        return view('back-end/admin/file-editor/home', $data);
    }

    public function layoutFileEditor()
    {
        // Get the file you want to edit
        $layoutFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/layout/_layout.php';
        
        // Get only the file name (not the whole path) to display it
        $layoutFilename = basename($layoutFilePath);

        if (!file_exists($layoutFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $layoutFileContent = file_get_contents($layoutFilePath);
        
        $data = [
            'layoutFilename' => $layoutFilename, // This is just for display
            'layoutFilePath' => $layoutFilePath,  // This is used for saving the file
            'layoutFileContent' => $layoutFileContent
        ];

        return view('back-end/admin/file-editor/layout', $data);
    }

    public function blogsFileEditor()
    {
        // Get the file you want to edit
        $blogsFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/blogs/index.php';
        
        // Get only the file name (not the whole path) to display it
        $blogsFilename = basename($blogsFilePath);

        if (!file_exists($blogsFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $blogsFileContent = file_get_contents($blogsFilePath);
        
        $data = [
            'blogsFilename' => $blogsFilename, // This is just for display
            'blogsFilePath' => $blogsFilePath,  // This is used for saving the file
            'blogsFileContent' => $blogsFileContent
        ];

        return view('back-end/admin/file-editor/blogs', $data);
    }

    public function viewBlogFileEditor()
    {
        // Get the file you want to edit
        $viewBlogFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/blogs/view-blog.php';
        
        // Get only the file name (not the whole path) to display it
        $viewBlogFilename = basename($viewBlogFilePath);

        if (!file_exists($viewBlogFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewBlogFileContent = file_get_contents($viewBlogFilePath);
        
        $data = [
            'viewBlogFilename' => $viewBlogFilename, // This is just for display
            'viewBlogFilePath' => $viewBlogFilePath,  // This is used for saving the file
            'viewBlogFileContent' => $viewBlogFileContent
        ];

        return view('back-end/admin/file-editor/view-blog', $data);
    }

    public function contactFileEditor()
    {
        // Get the file you want to edit
        $contactFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/contact/index.php';
        
        // Get only the file name (not the whole path) to display it
        $contactFilename = basename($contactFilePath);

        if (!file_exists($contactFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $contactFileContent = file_get_contents($contactFilePath);
        
        $data = [
            'contactFilename' => $contactFilename, // This is just for display
            'contactFilePath' => $contactFilePath,  // This is used for saving the file
            'contactFileContent' => $contactFileContent
        ];

        return view('back-end/admin/file-editor/contact', $data);
    }

    public function eventsFileEditor()
    {
        // Get the file you want to edit
        $eventsFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/events/index.php';
        
        // Get only the file name (not the whole path) to display it
        $eventsFilename = basename($eventsFilePath);

        if (!file_exists($eventsFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $eventsFileContent = file_get_contents($eventsFilePath);
        
        $data = [
            'eventsFilename' => $eventsFilename, // This is just for display
            'eventsFilePath' => $eventsFilePath,  // This is used for saving the file
            'eventsFileContent' => $eventsFileContent
        ];

        return view('back-end/admin/file-editor/events', $data);
    }

    public function viewEventFileEditor()
    {
        // Get the file you want to edit
        $viewEventFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/events/view-event.php';
        
        // Get only the file name (not the whole path) to display it
        $viewEventFilename = basename($viewEventFilePath);

        if (!file_exists($viewEventFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewEventFileContent = file_get_contents($viewEventFilePath);
        
        $data = [
            'viewEventFilename' => $viewEventFilename, // This is just for display
            'viewEventFilePath' => $viewEventFilePath,  // This is used for saving the file
            'viewEventFileContent' => $viewEventFileContent
        ];

        return view('back-end/admin/file-editor/view-event', $data);
    }

    public function viewPageFileEditor()
    {
        // Get the file you want to edit
        $viewPageFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/pages/view-page.php';
        
        // Get only the file name (not the whole path) to display it
        $viewPageFilename = basename($viewPageFilePath);

        if (!file_exists($viewPageFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewPageFileContent = file_get_contents($viewPageFilePath);
        
        $data = [
            'viewPageFilename' => $viewPageFilename, // This is just for display
            'viewPageFilePath' => $viewPageFilePath,  // This is used for saving the file
            'viewPageFileContent' => $viewPageFileContent
        ];

        return view('back-end/admin/file-editor/view-page', $data);
    }

    public function portfoliosFileEditor()
    {
        // Get the file you want to edit
        $portfoliosFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/portfolios/index.php';
        
        // Get only the file name (not the whole path) to display it
        $portfoliosFilename = basename($portfoliosFilePath);

        if (!file_exists($portfoliosFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $portfoliosFileContent = file_get_contents($portfoliosFilePath);
        
        $data = [
            'portfoliosFilename' => $portfoliosFilename, // This is just for display
            'portfoliosFilePath' => $portfoliosFilePath,  // This is used for saving the file
            'portfoliosFileContent' => $portfoliosFileContent
        ];

        return view('back-end/admin/file-editor/portfolios', $data);
    }

    public function viewPortfolioFileEditor()
    {
        // Get the file you want to edit
        $viewPortfolioFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/portfolios/view-portfolio.php';
        
        // Get only the file name (not the whole path) to display it
        $viewPortfolioFilename = basename($viewPortfolioFilePath);

        if (!file_exists($viewPortfolioFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewPortfolioFileContent = file_get_contents($viewPortfolioFilePath);
        
        $data = [
            'viewPortfolioFilename' => $viewPortfolioFilename, // This is just for display
            'viewPortfolioFilePath' => $viewPortfolioFilePath,  // This is used for saving the file
            'viewPortfolioFileContent' => $viewPortfolioFileContent
        ];

        return view('back-end/admin/file-editor/view-portfolio', $data);
    }

    public function donationsFileEditor()
    {
        // Get the file you want to edit
        $donationsFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/donate/index.php';
        
        // Get only the file name (not the whole path) to display it
        $donationsFilename = basename($donationsFilePath);

        if (!file_exists($donationsFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $donationsFileContent = file_get_contents($donationsFilePath);
        
        $data = [
            'donationsFilename' => $donationsFilename, // This is just for display
            'donationsFilePath' => $donationsFilePath,  // This is used for saving the file
            'donationsFileContent' => $donationsFileContent
        ];

        return view('back-end/admin/file-editor/donations', $data);
    }

    public function viewDonationFileEditor()
    {
        // Get the file you want to edit
        $viewDonationFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/donate/view-donation-campaign.php';
        
        // Get only the file name (not the whole path) to display it
        $viewDonationFilename = basename($viewDonationFilePath);

        if (!file_exists($viewDonationFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewDonationFileContent = file_get_contents($viewDonationFilePath);
        
        $data = [
            'viewDonationFilename' => $viewDonationFilename, // This is just for display
            'viewDonationFilePath' => $viewDonationFilePath,  // This is used for saving the file
            'viewDonationFileContent' => $viewDonationFileContent
        ];

        return view('back-end/admin/file-editor/view-donation', $data);
    }

    public function shopsFileEditor()
    {
        // Get the file you want to edit
        $shopsFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/shop/index.php';
        
        // Get only the file name (not the whole path) to display it
        $shopsFilename = basename($shopsFilePath);

        if (!file_exists($shopsFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $shopsFileContent = file_get_contents($shopsFilePath);
        
        $data = [
            'shopsFilename' => $shopsFilename, // This is just for display
            'shopsFilePath' => $shopsFilePath,  // This is used for saving the file
            'shopsFileContent' => $shopsFileContent
        ];

        return view('back-end/admin/file-editor/shops', $data);
    }

    public function viewShopFileEditor()
    {
        // Get the file you want to edit
        $viewshopFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/shop/view-product.php';
        
        // Get only the file name (not the whole path) to display it
        $viewshopFilename = basename($viewshopFilePath);

        if (!file_exists($viewshopFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $viewshopFileContent = file_get_contents($viewshopFilePath);
        
        $data = [
            'viewshopFilename' => $viewshopFilename, // This is just for display
            'viewshopFilePath' => $viewshopFilePath,  // This is used for saving the file
            'viewshopFileContent' => $viewshopFileContent
        ];

        return view('back-end/admin/file-editor/view-shop', $data);
    }

    public function searchFileEditor()
    {
        // Get the file you want to edit
        $searchFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/search/index.php';
        
        // Get only the file name (not the whole path) to display it
        $searchFilename = basename($searchFilePath);

        if (!file_exists($searchFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $searchFileContent = file_get_contents($searchFilePath);
        
        $data = [
            'searchFilename' => $searchFilename, // This is just for display
            'searchFilePath' => $searchFilePath,  // This is used for saving the file
            'searchFileContent' => $searchFileContent
        ];

        return view('back-end/admin/file-editor/search', $data);
    }

    public function searchFilterFileEditor()
    {
        // Get the file you want to edit
        $searchFilterFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/search/filter.php';
        
        // Get only the file name (not the whole path) to display it
        $searchFilterFilename = basename($searchFilterFilePath);

        if (!file_exists($searchFilterFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $searchFilterFileContent = file_get_contents($searchFilterFilePath);
        
        $data = [
            'searchFilterFilename' => $searchFilterFilename, // This is just for display
            'searchFilterFilePath' => $searchFilterFilePath,  // This is used for saving the file
            'searchFilterFileContent' => $searchFilterFileContent
        ];

        return view('back-end/admin/file-editor/search-filter', $data);
    }

    public function sitemapFileEditor()
    {
        // Get the file you want to edit
        $sitemapFilePath = APPPATH . 'Views/front-end/themes/' . getCurrentTheme() . '/sitemap/index.php';
        
        // Get only the file name (not the whole path) to display it
        $sitemapFilename = basename($sitemapFilePath);

        if (!file_exists($sitemapFilePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }

        // Load the file content
        $sitemapFileContent = file_get_contents($sitemapFilePath);
        
        $data = [
            'sitemapFilename' => $sitemapFilename, // This is just for display
            'sitemapFilePath' => $sitemapFilePath,  // This is used for saving the file
            'sitemapFileContent' => $sitemapFileContent
        ];

        return view('back-end/admin/file-editor/sitemap', $data);
    }

    public function saveFile()
    {
        $filePage = $this->request->getPost('filePage');
        $filePath = $this->request->getPost('filePath');
        $fileContent = $this->request->getPost('fileContent');
    
        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found");
        }
    
        if (file_put_contents($filePath, $fileContent) === false) {
            return redirect()->to('/account/admin/file-editor/'.$filePage)->with('error', 'Failed to save the file.');
        }
    
        return redirect()->to('/account/admin/file-editor/'.$filePage)->with('success', 'File saved successfully.');
    }
}
