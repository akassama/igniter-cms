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

class APIController extends BaseController
{
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

        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Get model and optional where clause from query parameters
        $modelName = $this->request->getGet('model');
        $whereClause = $this->request->getGet('where_clause'); // Should be in JSON format if passed

        // Check if the model name is provided and valid
        if (!$modelName || !array_key_exists($modelName, $allowedModels)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid or unsupported model name provided.',
            ]);
        }

        // Instantiate the model from the allowed list
        $modelClass = $allowedModels[$modelName];
        $model = new $modelClass();

        // Apply multiple filters if the where clause is provided
        if ($whereClause) {
            $filters = json_decode($whereClause, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid JSON format for where_clause.',
                ]);
            }

            // Loop through each condition and apply it to the query
            foreach ($filters as $key => $value) {
                $model->where($key, $value);
            }
        }

        // Order by created_at in descending order (if the column exists)
        if (in_array('created_at', $model->allowedFields)) {
            $model->orderBy('created_at', 'DESC');
        }

        // Get total count
        $totalModelData = $model->countAllResults(false); // Passing `false` to not reset the query

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
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        $db = \Config\Database::connect();
        $tableName = $this->request->getGet('table');
        $whereClause = $this->request->getGet('where_clause'); // Get the where_clause

        if (empty($tableName)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name is required.'
            ]);
        }

        if(!$this->startsWith($tableName, "icp_")){
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name must be plugin type.'
            ]);
        }

        try {
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

                // Loop through each condition and apply it to the query builder
                foreach ($filters as $key => $value) {
                    $builder->where($key, $value);
                }
            }
            
            // Get the total count before applying limit and offset
            // Passing `false` to countAllResults ensures that the WHERE clause applied above is retained.
            $totalCountData = $builder->countAllResults(false); 

            // Get the paginated data
            // The WHERE clause applied above will also apply to this query
            $queryData = $builder->get($take, $skip); 
            $data = $queryData->getResult(); // Get data as an array of objects

            // Prepare and return the response
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'total' => $totalCountData,
                'take' => $take,
                'skip' => $skip,
                'data' => $data, // This will now be an array of objects
            ]);
        } catch (\Exception $e) {
            // Log the actual error for debugging
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
        
        // Get JSON raw body and decode it to an associative array
        $requestData = $this->request->getJSON(true); 

        // Extract table name and data from the decoded JSON
        $tableName = $requestData['table'] ?? null;
        $dataToInsert = $requestData; // The entire JSON body is the data to insert, excluding 'table'

        // Unset the 'table' key from dataToInsert as it's not a column
        if (isset($dataToInsert['table'])) {
            unset($dataToInsert['table']);
        }

        if (empty($tableName)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name is required.'
            ]);
        }

        // Security check for table name prefix
        if (!$this->startsWith($tableName, "icp_")) {
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
            
            // Insert the data
            $builder->insert($dataToInsert);
            
            // Get the ID of the newly inserted record
            $insertedId = $db->insertID();

            return $this->response->setStatusCode(201)->setJSON([
                'status' => 'success',
                'message' => 'Data added successfully.',
                'id' => $insertedId,
                'data' => $dataToInsert // Return the data that was inserted
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Database error in addPluginData: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Database error: There was an error adding data.',
                'debug' => $e->getMessage() // For debugging, remove in production
            ]);
        }
    }

    // GENERIC UPDATE PLUGIN DATA
    public function updatePluginData($param = null)
    {
        $db = \Config\Database::connect();
        
        // Get JSON raw body and decode it to an associative array
        $requestData = $this->request->getJSON(true); 

        // Extract table name, ID, and data from the decoded JSON
        $tableName = $requestData['table'] ?? null;
        $id = $requestData['id'] ?? null;
        $dataToUpdate = $requestData; // The entire JSON body is the data to update

        // Unset 'table' and 'id' keys from dataToUpdate as they are not columns to update
        if (isset($dataToUpdate['table'])) {
            unset($dataToUpdate['table']);
        }
        if (isset($dataToUpdate['id'])) {
            unset($dataToUpdate['id']);
        }

        if (empty($tableName) || empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name and record ID are required.'
            ]);
        }

        // Security check for table name prefix
        if (!$this->startsWith($tableName, "icp_")) {
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
            
            // Perform the update based on ID
            $builder->where('id', $id)->update($dataToUpdate);

            // Check if any rows were affected
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
                'message' => 'Database error: There was an error updating data.',
                'debug' => $e->getMessage() // For debugging, remove in production
            ]);
        }
    }

    // GENERIC DELETE PLUGIN DATA
    public function deletePluginData($param = null)
    {
        $db = \Config\Database::connect();
        
        // Get JSON raw body and decode it to an associative array
        $requestData = $this->request->getJSON(true); 

        // Extract table name and ID from the decoded JSON
        $tableName = $requestData['table'] ?? null;
        $id = $requestData['id'] ?? null;

        if (empty($tableName) || empty($id)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Table name and record ID are required.'
            ]);
        }

        // Security check for table name prefix
        if (!$this->startsWith($tableName, "icp_")) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Invalid table name. Only plugin tables (prefixed with "icp_") are allowed.'
            ]);
        }

        try {
            $builder = $db->table($tableName);
            
            // Perform the delete based on ID
            $builder->where('id', $id)->delete();

            // Check if any rows were affected
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
                'message' => 'Database error: There was an error deleting data.',
                'debug' => $e->getMessage() // For debugging, remove in production
            ]);
        }
    }

    private function startsWith($string, $startString) { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }
}
