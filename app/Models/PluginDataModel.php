<?php

namespace App\Models;

use CodeIgniter\Model;

class PluginDataModel extends Model
{
    protected $table            = 'plugin_data';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'plugin_slug',
        'plugin_data_1',
        'plugin_data_2',
        'plugin_data_3',
        'plugin_data_4',
        'plugin_data_5',
        'plugin_data_6',
        'plugin_data_7',
        'plugin_data_8',
        'plugin_data_9',
        'plugin_data_10',
        'plugin_data_11',
        'plugin_data_12',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createPluginData($param = array())
    {
        $data = [
            'plugin_slug' => $param['plugin_slug'],
            'plugin_data_1'   => $param['plugin_data_1'],
            'plugin_data_2'   => $param['plugin_data_2'],
            'plugin_data_3'   => $param['plugin_data_3'],
            'plugin_data_4'   => $param['plugin_data_4'],
            'plugin_data_5'   => $param['plugin_data_5'],
            'plugin_data_6'   => $param['plugin_data_6'],
            'plugin_data_7'   => $param['plugin_data_7'],
            'plugin_data_8'   => $param['plugin_data_8'],
            'plugin_data_9'   => $param['plugin_data_9'],
            'plugin_data_10'  => $param['plugin_data_10'],
            'plugin_data_11'  => $param['plugin_data_11'],
            'plugin_data_12'  => $param['plugin_data_12'],
        ];
        $this->save($data);

        return true;
    }
    
    public function updatePluginData($pluginDataId, $param = [])
    {
        // Check if record exists
        $existingPluginData = $this->find($pluginDataId);
        if (!$existingPluginData) {
            return false; // not found
        }

        // Update the fields
        $existingPluginData['plugin_slug']    = $param['plugin_slug'];
        $existingPluginData['plugin_data_1']  = $param['plugin_data_1'];
        $existingPluginData['plugin_data_2']  = $param['plugin_data_2'];
        $existingPluginData['plugin_data_3']  = $param['plugin_data_3'];
        $existingPluginData['plugin_data_4']  = $param['plugin_data_4'];
        $existingPluginData['plugin_data_5']  = $param['plugin_data_5'];
        $existingPluginData['plugin_data_6']  = $param['plugin_data_6'];
        $existingPluginData['plugin_data_7']  = $param['plugin_data_7'];
        $existingPluginData['plugin_data_8']  = $param['plugin_data_8'];
        $existingPluginData['plugin_data_9']  = $param['plugin_data_9'];
        $existingPluginData['plugin_data_10'] = $param['plugin_data_10'];
        $existingPluginData['plugin_data_11'] = $param['plugin_data_11'];
        $existingPluginData['plugin_data_12'] = $param['plugin_data_12'];

        // Save the updated data
        $this->save($existingPluginData);

        return true;
    }
}

