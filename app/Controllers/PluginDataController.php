<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PluginDataModel;

class PluginDataController extends BaseController
{
    //PLUGIN DATA API
    public function getPluginData($pluginAccessKey, $pluginDataId = null)
    {
        // Check if pluginDataId is provided
        if (!$pluginDataId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'PluginData Id parameter is required.'
            ]);
        }

        // Fetch the PluginData by id
        $pluginDatasModel = new PluginDataModel();
        $pluginData = $pluginDatasModel->where('id', $pluginDataId)->first();

        // Return PluginData or not found error
        if ($pluginData) {
            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'data' => $pluginData
            ]);
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'PluginData not found.'
            ]);
        }
    }

    public function getPluginDatas($pluginAccessKey)
    {
        // Get pagination parameters with defaults
        $take = $this->request->getGet('take') ?? 10;
        $skip = $this->request->getGet('skip') ?? 0;

        // Fetch all pluginDatas
        $pluginDatasModel = new PluginDataModel();
        // Order by plugin_slug in ascending order
        $pluginDatasModel->orderBy('plugin_slug', 'ASC');
        $pluginDatas = $pluginDatasModel->findAll($take, $skip);

        // Get total count
        $totalPluginDatas = $pluginDatasModel->countAllResults();

        // Return the list of pluginDatas
        return $this->response->setStatusCode(200)->setJSON([
            'status' => 'success',
            'total' => $totalPluginDatas,
            'take' => $take,
            'skip' => $skip,
            'data' => $pluginDatas
        ]);
    }

    // Add new PluginData
    public function createPluginData($pluginAccessKey)
    {
        $rules = [
            'plugin_slug' => 'required|string|max_length[255]',
            'plugin_data_1' => 'permit_empty|string|max_length[255]',
            'plugin_data_2' => 'permit_empty|string|max_length[255]',
            'plugin_data_3' => 'permit_empty|string|max_length[255]',
            'plugin_data_4' => 'permit_empty|string|max_length[255]',
            'plugin_data_5' => 'permit_empty|string|max_length[255]',
            'plugin_data_6' => 'permit_empty|string|max_length[255]',
            'plugin_data_7' => 'permit_empty|string|max_length[255]',
            'plugin_data_8' => 'permit_empty|string|max_length[255]',
            'plugin_data_9' => 'permit_empty|string|max_length[255]',
            'plugin_data_10' => 'permit_empty|string|max_length[255]',
            'plugin_data_11' => 'permit_empty|string|max_length[255]',
            'plugin_data_12' => 'permit_empty|string|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $pluginDatasModel = new PluginDataModel();
        $data = $this->request->getJSON(true); // Get JSON input as associative array

        try {
            $pluginDatasModel->createPluginData($data);
            return $this->response->setStatusCode(201)->setJSON([
                'status' => 'success',
                'message' => 'PluginData created successfully.'
            ]);
        } catch (\ReflectionException $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to create PluginData: ' . $e->getMessage()
            ]);
        }
    }

    // Update existing PluginData
    public function updatePluginData($pluginAccessKey, $pluginDataId = null)
    {
        // Check if pluginDataId is provided
        if (!$pluginDataId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'PluginData Id parameter is required.'
            ]);
        }

        $rules = [
            'plugin_slug' => 'required|string|max_length[255]',
            'plugin_data_1' => 'permit_empty|string|max_length[255]',
            'plugin_data_2' => 'permit_empty|string|max_length[255]',
            'plugin_data_3' => 'permit_empty|string|max_length[255]',
            'plugin_data_4' => 'permit_empty|string|max_length[255]',
            'plugin_data_5' => 'permit_empty|string|max_length[255]',
            'plugin_data_6' => 'permit_empty|string|max_length[255]',
            'plugin_data_7' => 'permit_empty|string|max_length[255]',
            'plugin_data_8' => 'permit_empty|string|max_length[255]',
            'plugin_data_9' => 'permit_empty|string|max_length[255]',
            'plugin_data_10' => 'permit_empty|string|max_length[255]',
            'plugin_data_11' => 'permit_empty|string|max_length[255]',
            'plugin_data_12' => 'permit_empty|string|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $pluginDatasModel = new PluginDataModel();
        $data = $this->request->getJSON(true); // Get JSON input as associative array

        try {
            if ($pluginDatasModel->updatePluginData($pluginDataId, $data)) {
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'message' => 'PluginData updated successfully.'
                ]);
            } else {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'PluginData not found for update.'
                ]);
            }
        } catch (\ReflectionException $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to update PluginData: ' . $e->getMessage()
            ]);
        }
    }

    // Delete PluginData
    public function deletePluginData($pluginAccessKey, $pluginDataId = null)
    {
        // Check if pluginDataId is provided
        if (!$pluginDataId) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'PluginData Id parameter is required.'
            ]);
        }

        $pluginDatasModel = new PluginDataModel();

        // Check if record exists before attempting to delete
        if ($pluginDatasModel->find($pluginDataId)) {
            try {
                $pluginDatasModel->delete($pluginDataId);
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'message' => 'PluginData deleted successfully.'
                ]);
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to delete PluginData: ' . $e->getMessage()
                ]);
            }
        } else {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'PluginData not found for deletion.'
            ]);
        }
    }
}