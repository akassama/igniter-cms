<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * DataGroups Model class
 *
 * Represents the model for the data groups table in the database.
 */
class DataGroupsModel extends Model
{
    protected $table            = 'data_groups';
    protected $primaryKey       = 'data_group_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'data_group_id', 
        'data_group_for', 
        'data_group_list',
        'deletable',
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
        'data_group_for' => 'required|is_unique[data_groups.data_group_for]',
        'data_group_list' => 'required',
    ];
    protected $validationMessages   = [
        'data_group_for' => 'data_group_for is required',
        'data_group_list' => 'data_group_list is required',
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

    public function createDataGroup($param = array())
    {
        $data = [
            'data_group_id' => getGUID(),
            'data_group_for' => $param['data_group_for'],
            'data_group_list' => $param['data_group_list'],
            'deletable' => $param['deletable'],
            'created_by' => $param['created_by'],
            'updated_by' => $param['updated_by']
        ];
        $this->save($data);

        return true;
    }

    public function updateDataGroup($dataGroupId, $param = [])
    {
        // Check if record exists
        $existingDataGroup = $this->find($dataGroupId);
        if (!$existingDataGroup) {
            return false; // not found
        }

        // Update the fields
        $existingDataGroup['data_group_for'] = $param['data_group_for'];
        $existingDataGroup['data_group_list'] = $param['data_group_list'];
        $existingDataGroup['deletable'] = $param['deletable'];
        $existingDataGroup['created_by'] = $param['created_by'];
        $existingDataGroup['updated_by'] = $param['updated_by'];

        // Save the updated data
        $this->save($existingDataGroup);

        return true;
    }
}
