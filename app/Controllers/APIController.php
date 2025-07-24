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

    private function startsWith($string, $startString) { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }
}
