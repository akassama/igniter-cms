<?php

namespace App\Models;

use CodeIgniter\Model;

class PluginsModel extends Model
{
    protected $table            = 'plugins';
    protected $primaryKey       = 'plugin_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'plugin_id', 
        'plugin_key', 
        'status',
        'update_available',
        'load',
        'created_by',
        'updated_by',
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
    protected $validationRules = [
        'plugin_key' => 'required|is_unique[plugins.plugin_key]',
    ];
    protected $validationMessages   = [
        'plugin_key' => 'Plugin key is required',
    ];
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

    public function createPlugin($param = array())
    {
        $pluginId = getGUID();
        $data = [
            'plugin_id' => $pluginId,
            'plugin_key' => $param['plugin_key'],
            'status' => $param['status'] ?? 0,
            'update_available' => $param['update_available'] ?? 0,
            'load' => $param['load'] ?? "",
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }
}
