<?php

namespace App\Models;

use CodeIgniter\Model;

class PluginConfigModel extends Model
{
    protected $table            = 'plugin_configs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'plugin_slug',
        'config_key',
        'config_value',
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

    public function createPluginConfig($param = array())
    {
        $data = [
            'plugin_slug' => $param['plugin_slug'],
            'config_key' => $param['config_key'],
            'config_value' => $param['config_value'],
        ];
        $this->save($data);

        return true;
    }
    
    public function updatePluginConfig($configId, $param = [])
    {
        // Check if record exists
        $existingPluginConfig = $this->find($configId);
        if (!$existingPluginConfig) {
            return false; // not found
        }

        // Update the fields
        $existingPluginConfig['plugin_slug'] = $param['plugin_slug'];
        $existingPluginConfig['config_key'] = $param['config_key'];
        $existingPluginConfig['config_value'] = $param['config_value'];

        // Save the updated data
        $this->save($existingPluginConfig);

        return true;
    }
}
