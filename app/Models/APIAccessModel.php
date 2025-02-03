<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * APIAccessModel class
 * 
 * Represents the model for the api_accesses table in the database.
 */
class APIAccessModel extends Model
{
    protected $table            = 'api_accesses';
    protected $primaryKey       = 'api_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'api_id',
        'api_key',
        'assigned_to',
        'status',
        'created_by', 
        'updated_by'
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
        'api_key' => 'required|is_unique[api_accesses.api_key]',
        'assigned_to' => 'required|is_unique[api_accesses.assigned_to]',
        'status' => 'required|max_length[1]',
    ];
    protected $validationMessages   = [
        'api_key' => 'api_key is required',
        'assigned_to' => 'assigned_to is required',
        'status' => 'status is required',
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

    public function createApiAccessKey($param = array())
    {
        $data = [
            'api_id' => getGUID(),
            'api_key' => $param['api_key'],
            'assigned_to' => $param['assigned_to'],
            'status' => $param['status'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateApiAccessKey($apiId, $param = [])
    {
        // Check if record exists
        $existingApiKey = $this->find($apiId);
        if (!$existingApiKey) {
            return false; // not found
        }

        // Update the fields
        $existingApiKey['api_key'] = $param['api_key'];
        $existingApiKey['assigned_to'] = $param['assigned_to'];
        $existingApiKey['status'] = $param['status'];
        $existingApiKey['created_by'] = $param['created_by'];
        $existingApiKey['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingApiKey);

        return true;
    }
}
