<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Constants\ActivityTypes;
use App\Models\BlogsModel; 
use App\Models\CodesModel;
use App\Models\CategoriesModel;
use App\Models\NavigationsModel;
use App\Models\ContentBlocksModel;
use App\Models\ThemesModel;
use App\Models\DataGroupsModel;
use App\Services\EmailService;
use CodeIgniter\Validation\Validation;

class APIController extends BaseController
{
    protected $validation;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    // Input sanitization helper
    private function sanitizeInput($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitizeInput'], $data);
        }
        // Sanitize strings to prevent XSS
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    //GENERIC GET METHODS
    public function getModelData()
    {
        // Define the list of allowed models
        $allowedModels = [
            'blogs' => 'App\Models\BlogsModel',
            'pages' => 'App\Models\PagesModel',
            'navigations' => 'App\Models\NavigationsModel',
            'categories' => 'App\Models\CategoriesModel',
            'codes' => 'App\Models\CodesModel',
            'content-blocks' => 'App\Models\ContentBlocksModel',
            'themes' => 'App\Models\ThemesModel',
            'data-groups' => 'App\Models\DataGroupsModel',
        ];

        // Get and validate pagination parameters
        $take = (int)($this->request->getGet('take') ?? 10);
        $skip = (int)($this->request->getGet('skip') ?? 0);
        $modelName = $this->sanitizeInput($this->request->getGet('model'));
        $whereClause = $this->request->getGet('where_clause');

        // Validation rules
        $this->validation->setRules([
            'take' => 'permit_empty|is_natural_no_zero|max_length[4]',
            'skip' => 'permit_empty|is_natural|max_length[4]',
            'model' => 'required|alpha_dash|max_length[50]',
            'where_clause' => 'permit_empty|valid_json'
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation error: ' . implode(', ', $this->validation->getErrors())
            ]);
        }

        // Check if the model name is valid
        if (!$modelName || !array_key_exists($modelName, $allowedModels)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid or unsupported model name provided.'
            ]);
        }

        // Instantiate the model
        $modelClass = $allowedModels[$modelName];
        $model = new $modelClass();

        // Apply multiple filters if the where clause is provided
        if ($whereClause) {
            $filters = json_decode($whereClause, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON format for where_clause.'
                ]);
            }

            // Sanitize filter keys and values
            foreach ($filters as $key => $value) {
                $sanitizedKey = $this->sanitizeInput($key);
                $sanitizedValue = $this->sanitizeInput($value);
                $model->where($sanitizedKey, $sanitizedValue);
            }
        }

        // Order by created_at in descending order (if the column exists)
        if (in_array('created_at', $model->allowedFields)) {
            $model->orderBy('created_at', 'DESC');
        }

        // Get total count
        $totalModelData = $model->countAllResults(false);

        // Fetch paginated data
        $modelData = $model->findAll($take, $skip);

        // Prepare and return the response
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalModelData,
            'take' => $take,
            'skip' => $skip,
            'data' => $modelData,
        ]);
    }

    //GENERIC GET PLUGIN METHODS
    public function getPluginData($param = null)
    {
        // Get and validate pagination parameters
        $take = (int)($this->request->getGet('take') ?? 10);
        $skip = (int)($this->request->getGet('skip') ?? 0);
        $tableName = $this->sanitizeInput($this->request->getGet('table'));
        $whereClause = $this->request->getGet('where_clause');

        // Validation rules
        $this->validation->setRules([
            'take' => 'permit_empty|is_natural_no_zero|max_length[4]',
            'skip' => 'permit_empty|is_natural|max_length[4]',
            'table' => 'required|alpha_dash|max_length[50]',
            'where_clause' => 'permit_empty|valid_json'
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation error: ' . implode(', ', $this->validation->getErrors())
            ]);
        }

        if (empty($tableName)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name is required.'
            ]);
        }

        if (!str_starts_with($tableName, 'icp_')) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid table name. Only plugin tables (prefixed with "icp_") are allowed.'
            ]);
        }

        try {
            $db = \Config\Database::connect();
            $builder = $db->table($tableName);

            // Apply multiple filters if the where clause is provided
            if ($whereClause) {
                $filters = json_decode($whereClause, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setStatusCode(400)->setJSON([
                        'status' => 'error',
                        'message' => 'Invalid JSON format for where_clause.'
                    ]);
                }

                // Sanitize filter keys and values
                foreach ($filters as $key => $value) {
                    $sanitizedKey = $this->sanitizeInput($key);
                    $sanitizedValue = $this->sanitizeInput($value);
                    $builder->where($sanitizedKey, $sanitizedValue);
                }
            }

            // Get total count
            $totalCountData = $builder->countAllResults(false);

            // Get paginated data
            $queryData = $builder->get($take, $skip);
            $data = $queryData->getResult();

            // Prepare and return the response
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'total' => $totalCountData,
                'take' => $take,
                'skip' => $skip,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Database error in getPluginData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Database error: There was an error processing your request.'
            ]);
        }
    }

    // GENERIC ADD PLUGIN DATA
    public function addPluginData($param = null)
    {
        $db = \Config\Database::connect();

        // Get and validate JSON input
        $requestData = $this->request->getJSON(true);
        if (!$requestData) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data.'
            ]);
        }

        // Extract and sanitize table name
        $tableName = $this->sanitizeInput($requestData['table'] ?? null);
        $dataToInsert = array_map([$this, 'sanitizeInput'], $requestData);
        unset($dataToInsert['table']);

        // Validation rules
        $this->validation->setRules([
            'table' => 'required|alpha_dash|max_length[50]'
        ]);

        if (!$this->validation->run(['table' => $tableName])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation error: ' . implode(', ', $this->validation->getErrors())
            ]);
        }

        if (empty($tableName)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name is required.'
            ]);
        }

        if (!str_starts_with($tableName, 'icp_')) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid table name. Only plugin tables (prefixed with "icp_") are allowed.'
            ]);
        }

        if (empty($dataToInsert)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'No data provided for insertion.'
            ]);
        }

        try {
            $builder = $db->table($tableName);
            $builder->insert($dataToInsert);
            $insertedId = $db->insertID();

            return $this->response->setStatusCode(201)->setJSON([
                'status' => 'success',
                'message' => 'Data added successfully.',
                'id' => $insertedId,
                'data' => $dataToInsert
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Database error in addPluginData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Database error: There was an error adding data.'
            ]);
        }
    }

    // GENERIC UPDATE PLUGIN DATA
    public function updatePluginData($param = null)
    {
        $db = \Config\Database::connect();

        // Get and validate JSON input
        $requestData = $this->request->getJSON(true);
        if (!$requestData) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data.'
            ]);
        }

        // Extract and sanitize inputs
        $tableName = $this->sanitizeInput($requestData['table'] ?? null);
        $id = $this->sanitizeInput($requestData['id'] ?? null);
        $dataToUpdate = array_map([$this, 'sanitizeInput'], $requestData);
        unset($dataToUpdate['table'], $dataToUpdate['id']);

        // Validation rules
        $this->validation->setRules([
            'table' => 'required|alpha_dash|max_length[50]',
            'id' => 'required|is_natural_no_zero|max_length[10]'
        ]);

        if (!$this->validation->run(['table' => $tableName, 'id' => $id])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation error: ' . implode(', ', $this->validation->getErrors())
            ]);
        }

        if (empty($tableName) || empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name and record ID are required.'
            ]);
        }

        if (!str_starts_with($tableName, 'icp_')) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid table name. Only plugin tables (prefixed with "icp_") are allowed.'
            ]);
        }

        if (empty($dataToUpdate)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'No data provided for update.'
            ]);
        }

        try {
            $builder = $db->table($tableName);
            $builder->where('id', $id)->update($dataToUpdate);

            if ($db->affectedRows() > 0) {
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'message' => 'Data updated successfully.',
                    'id' => $id,
                    'updated_data' => $dataToUpdate
                ]);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'Record not found or no changes made.'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Database error in updatePluginData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Database error: There was an error updating data.'
            ]);
        }
    }

    // GENERIC DELETE PLUGIN DATA
    public function deletePluginData($param = null)
    {
        $db = \Config\Database::connect();

        // Get and validate JSON input
        $requestData = $this->request->getJSON(true);
        if (!$requestData) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data.'
            ]);
        }

        // Extract and sanitize inputs
        $tableName = $this->sanitizeInput($requestData['table'] ?? null);
        $id = $this->sanitizeInput($requestData['id'] ?? null);

        // Validation rules
        $this->validation->setRules([
            'table' => 'required|alpha_dash|max_length[50]',
            'id' => 'required|is_natural_no_zero|max_length[10]'
        ]);

        if (!$this->validation->run(['table' => $tableName, 'id' => $id])) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation error: ' . implode(', ', $this->validation->getErrors())
            ]);
        }

        if (empty($tableName) || empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name and record ID are required.'
            ]);
        }

        if (!str_starts_with($tableName, 'icp_')) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid table name. Only plugin tables (prefixed with "icp_") are allowed.'
            ]);
        }

        try {
            $builder = $db->table($tableName);
            $builder->where('id', $id)->delete();

            if ($db->affectedRows() > 0) {
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'message' => 'Record deleted successfully.',
                    'id' => $id
                ]);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'Record not found.'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Database error in deletePluginData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Database error: There was an error deleting data.'
            ]);
        }
    }
}